<?php namespace GrahamCampbell\BootstrapCMS\Controllers;

use App;
use Config;
use Log;
use Queue;
use Redirect;
use Session;
use URL;
use Validator;

use Binput;
use DateTime;
use Passwd;
use Sentry;

use UserProvider;
use GroupProvider;

class UserController extends BaseController {

    /**
     * Constructor (setup access permissions).
     *
     * @return void
     */
    public function __construct() {
        $this->setPermissions(array(
            'index'   => 'mod',
            'create'  => 'admin',
            'store'   => 'admin',
            'show'    => 'mod',
            'edit'    => 'admin',
            'update'  => 'admin',
            'suspend' => 'mod',
            'destroy' => 'admin',
        ));

        parent::__construct();
    }

    /**
     * Display a listing of the users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $users = UserProvider::paginate();
        $links = UserProvider::links();

        return $this->viewMake('users.index', array('users' => $users, 'links' => $links));
    }

    /**
     * Show the form for creating a new user.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $groups = GroupProvider::index();

        return $this->viewMake('users.create', array('groups' => $groups));
    }

    /**
     * Store a new user.
     *
     * @return \Illuminate\Http\Response
     */
    public function store() {
        $password = Passwd::generate(12,8);

        $input = array(
            'first_name'      => Binput::get('first_name'),
            'last_name'       => Binput::get('last_name'),
            'email'           => Binput::get('email'),
            'password'        => $password,
            'activated'       => true,
            'activated_at'    => new DateTime,
        );

        $rules = array(
            'first_name'   => 'required|min:2|max:32',
            'last_name'    => 'required|min:2|max:32',
            'email'        => 'required|min:4|max:32|email',
            'password'     => 'required|min:6',
            'activated'    => 'required',
            'activated_at' => 'required',
        );

        $val = Validator::make($input, $rules);
        if ($val->fails()) {
            return Redirect::route('users.create')->withInput()->withErrors($val->errors());
        }

        $user = UserProvider::create($input);

        $groups = GroupProvider::index();

        foreach($groups as $group) {
            if (Binput::get('group_'.$group->id) === 'on') {
                $user->addGroup($group);
            }
        }

        try {
            $data = array(
                'view'     => 'emails.newuser',
                'url'      => URL::route('pages.show', array('pages' => 'home')),
                'password' => $password,
                'email'    => $user->getLogin(),
                'subject'  => Config::get('cms.name').' - New Account Information',
            );

            Queue::push('GrahamCampbell\BootstrapCMS\Handlers\MailHandler', $data, Config::get('mail.queue'));
        } catch (\Exception $e) {
            Log::alert($e);
            $user->delete();
            Session::flash('error', 'We were unable to create the user. Please contact support.');
            return Redirect::route('users.create')->withInput();
        }

        Session::flash('success', 'The user has been created successfully. Their password has been emailed to them.');
        return Redirect::route('users.show', array('users' => $user->getId()));
    }

    /**
     * Show the specified user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $user = UserProvider::find($id);
        $this->checkUser($user);

        return $this->viewMake('users.show', array('user' => $user));
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $user = UserProvider::find($id);
        $this->checkUser($user);

        $groups = GroupProvider::index();

        return $this->viewMake('users.edit', array('user' => $user, 'groups' => $groups));
    }

    /**
     * Update an existing user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id) {
        $input = array(
            'first_name' => Binput::get('first_name'),
            'last_name'  => Binput::get('last_name'),
            'email'      => Binput::get('email'),
        );

        $rules = array(
            'first_name' => 'required|min:2|max:32',
            'last_name'  => 'required|min:2|max:32',
            'email'      => 'required|min:4|max:32|email',
        );

        $val = Validator::make($input, $rules);
        if ($val->fails()) {
            return Redirect::route('users.edit', array('users' => $id))->withInput()->withErrors($val->errors());
        }

        $user = UserProvider::find($id);
        $this->checkUser($user);

        $user->update($input);

        $groups = GroupProvider::index();

        foreach($groups as $group) {
            if ($user->inGroup($group)) {
                if (Binput::get('group_'.$group->id) !== 'on') {
                    $user->removeGroup($group);
                }
            } else {
                if (Binput::get('group_'.$group->id) === 'on') {
                    $user->addGroup($group);
                }
            }
        }

        Session::flash('success', 'The user has been updated successfully.');
        return Redirect::route('users.show', array('users' => $user->getId()));
    }

    /**
     * Suspend an existing user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function suspend($id) {
        try {
            $throttle = Sentry::getThrottleProvider()->findByUserId($id);
            $throttle->suspend();
        } catch (\Cartalyst\Sentry\Users\UserNotFoundException $e) {
            Log::notice($e);
            return App::abort(404, 'User Not Found');
        } catch (\Cartalyst\Sentry\Throttling\UserSuspendedException $e) {
            Log::notice($e);
            $time = $throttle->getSuspensionTime();
            Session::flash('error', "This user is already suspended for $time minutes.");
            return Redirect::route('users.suspend', array('users' => $user->getId()))->withErrors($val)->withInput();
        } catch (\Cartalyst\Sentry\Throttling\UserBannedException $e) {
            Log::notice($e);
            Session::flash('error', 'This user has already been banned.');
            return Redirect::route('users.suspend', array('users' => $user->getId()))->withErrors($val)->withInput();
        }

        Session::flash('success', 'The user has been suspended successfully.');
        return Redirect::route('users.show', array('users' => $id));
    }

    /**
     * Reset the password of an existing user.
     *
     * @return \Illuminate\Http\Response
     */
    public function reset($id) {
        $password = Passwd::generate(12,8);

        $input = array(
            'password' => $password,
        );

        $rules = array(
            'password' => 'required|min:6',
        );

        $val = Validator::make($input, $rules);
        if ($val->fails()) {
            return Redirect::route('users.show', array('users' => $id))->withErrors($val->errors());
        }

        $user = UserProvider::find($id);
        $this->checkUser($user);

        $user->update($input);

        try {
            $data = array(
                'view' => 'emails.password',
                'password' => $password,
                'email' => $user->getLogin(),
                'subject' => Config::get('cms.name').' - New Password Information',
            );

            Queue::push('GrahamCampbell\BootstrapCMS\Handlers\MailHandler', $data, Config::get('mail.queue'));
        } catch (\Exception $e) {
            Log::alert($e);
            Session::flash('error', 'We were unable to send the password to the user.');
            return Redirect::route('users.show', array('users' => $id));
        }

        Log::info('Password reset successfully', array('Email' => $data['email']));
        Session::flash('success', 'The user\'s password has been successfully reset. Their new password has been emailed to them.');
        return Redirect::route('users.show', array('users' => $id));
    }

    /**
     * Delete an existing user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $user = UserProvider::find($id);
        $this->checkUser($user);

        $user->delete();

        Session::flash('success', 'The user has been deleted successfully.');
        return Redirect::route('users.index');
    }

    /**
     * Check the user model.
     *
     * @return mixed
     */
    protected function checkUser($user) {
        if (!$user) {
            return App::abort(404, 'User Not Found');
        }
    }
}
