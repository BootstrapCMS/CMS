<?php namespace GrahamCampbell\BootstrapCMS\Controllers;

use App;
use Event;
use Redirect;
use Session;
use Validator;

use Sentry;
use Binput;

use GrahamCampbell\BootstrapCMS\Models\Page;

class AccountController extends BaseController {

    /**
     * Constructor (setup access permissions).
     *
     * @return void
     */
    public function __construct() {
        $this->setPermissions(array(
            'getProfile'    => 'user',
            'deleteProfile' => 'user',
            'patchDetails'  => 'user',
            'patchPassword' => 'user',
        ));

        parent::__construct();
    }

    /**
     * Display the user's profile.
     *
     * @return \Illuminate\Http\Response
     */
    public function getProfile() {
        return $this->viewMake('account.profile');
    }

    /**
     * Delete the user's profile.
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteProfile() {
        $user = Sentry::getUser();
        $this->checkUser($user);

        Event::fire('user.logout', array('Email' => $user->email));
        Sentry::logout();

        $user->delete();

        Session::flash('success', 'Your account has been deleted successfully.');
        return Redirect::route('pages.show', array('pages' => 'home'));
    }

    /**
     * Update the user's details.
     *
     * @return \Illuminate\Http\Response
     */
    public function patchDetails() {
        $input = array(
            'first_name' => Binput::get('first_name'),
            'last_name'  => Binput::get('last_name'),
            'email'      => Binput::get('email'),
        );

        $rules = array (
            'first_name' => 'required|min:2|max:32',
            'last_name'  => 'required|min:2|max:32',
            'email'      => 'required|min:4|max:32|email',
        );

        $val = Validator::make($input, $rules);

        $val = Validator::make($input, $rules);
        if ($val->fails()) {
            return Redirect::route('account.profile')->withInput()->withErrors($val->errors());
        }

        $user = Sentry::getUser();
        $this->checkUser($user);

        $user->update($input);
        
        Session::flash('success', 'Your details have been updated successfully.');
        return Redirect::route('account.profile');
    }

    /**
     * Update the user's password.
     *
     * @return \Illuminate\Http\Response
     */
    public function patchPassword() {
        $input = array(
            'password'              => Binput::get('password'),
            'password_confirmation' => Binput::get('password_confirmation'),
        );

        $rules = array (
            'password'              => 'required|min:6|confirmed',
            'password_confirmation' => 'required',
        );

        $val = Validator::make($input, $rules);
        if ($val->fails()) {
            return Redirect::route('account.profile')->withInput()->withErrors($val->errors());
        }

        unset($input['password_confirmation']);

        $user = Sentry::getUser();
        $this->checkUser($user);

        $user->update($input);
        
        Session::flash('success', 'Your password has been updated successfully.');
        return Redirect::route('account.profile');
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
