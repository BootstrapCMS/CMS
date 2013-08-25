<?php namespace GrahamCampbell\BootstrapCMS\Controllers;

use Event;
use Log;
use Redirect;
use Session;
use URL;
use Validator;

use Binput;
use Sentry;

use GrahamCampbell\BootstrapCMS\Models\Page;

class LoginController extends BaseController {

    /**
     * Constructor (setup access permissions).
     *
     * @return void
     */
    public function __construct() {
        $this->setPermissions(array(
            'getLogout' => 'user',
        ));

        parent::__construct();
    }

    /**
     * Display the login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogin() {
        return $this->viewMake('account.login');
    }

    /**
     * Attempt to login the specified user.
     *
     * @return \Illuminate\Http\Response
     */
    public function postLogin() {
        $remember = Binput::get('rememberMe');

        $input = array(
            'email'    => Binput::get('email'),
            'password' => Binput::get('password'),
        );

        $rules = array(
            'email'    => 'required|min:4|max:32|email',
            'password' => 'required|min:6',
        );

        $val = Validator::make($input, $rules);
        if ($val->fails()) {
            Event::fire('user.loginfailed', array('Email' => $input['email'], 'Messages' => $val->messages()->all()));
            return Redirect::route('account.login')->withInput()->withErrors($val);
        }

        try {
            $throttle = Sentry::getThrottleProvider()->findByUserLogin($input['email']);
            $throttle->check();

            Sentry::authenticate($input, $remember);
        } catch (\Cartalyst\Sentry\Users\UserNotFoundException $e) {
            Log::notice($e);
            Event::fire('user.loginfailed', array('Email' => $input['email']));
            Session::flash('error', 'Your details were incorrect.');
            return Redirect::route('account.login')->withErrors($val)->withInput();
        } catch (\Cartalyst\Sentry\Users\WrongPasswordException $e) {
            Log::notice($e);
            Event::fire('user.loginfailed', array('Email' => $input['email']));
            Session::flash('error', 'Your password was incorrect.');
            return Redirect::route('account.login')->withErrors($val)->withInput();
        } catch (\Cartalyst\Sentry\Users\UserNotActivatedException $e) {
            Log::notice($e);
            Event::fire('user.loginfailed', array('Email' => $input['email']));
            Session::flash('error', 'You have not yet activated this account.');
            return Redirect::route('account.login')->withErrors($val)->withInput();
        } catch (\Cartalyst\Sentry\Throttling\UserSuspendedException $e) {
            Log::notice($e);
            Event::fire('user.loginfailed', array('Email' => $input['email']));
            $time = $throttle->getSuspensionTime();
            Session::flash('error', "Your account has been suspended for $time minutes.");
            return Redirect::route('account.login')->withErrors($val)->withInput();
        } catch (\Cartalyst\Sentry\Throttling\UserBannedException $e) {
            Log::notice($e);
            Event::fire('user.loginfailed', array('Email' => $input['email']));
            Session::flash('error', 'You have been banned. Please contact support.');
            return Redirect::route('account.login')->withErrors($val)->withInput();
        }

        Event::fire('user.loginsuccessful', array('Email' => $input['email']));
        return Redirect::intended(URL::route('pages.show', array('pages' => 'home')));
    }

    /**
     * Logout the specified user.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogout() {
        Event::fire('user.logout', array('Email' => Sentry::getUser()->email));
        Sentry::logout();
        return Redirect::route('pages.show', array('pages' => 'home'));
    }
}
