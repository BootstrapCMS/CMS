<?php

class LoginController extends BaseController {

    protected $user;

    /**
     * Load the injected models.
     * Setup access permissions.
     */
    public function __construct(Page $page) {
        $this->page = $page;

        $this->setPermissions(array(
            'getLogout' => 'user',
        ));

        parent::__construct();
    }

    /**
     * Display the login page.
     *
     * @return Response
     */
    public function getLogin() {
        return $this->viewMake('account.login');
    }

    /**
     * Try to log the user in.
     *
     * @return Response
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
            Log::info('Login failed because validation failed', array('Email' => $input['email'], 'Messages' => $val->messages()->all()));
            return Redirect::route('account.login')->withErrors($val)->withInput();
        }

        try {
            $throttle = Sentry::getThrottleProvider()->findByUserLogin($input['email']);
            $throttle->check();

            Sentry::authenticate($input, $remember);
        } catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
            Log::notice($e);
            Session::flash('error', 'Your details were incorrect.');
            return Redirect::route('account.login')->withErrors($val)->withInput();
        } catch (Cartalyst\Sentry\Users\WrongPasswordException $e) {
            Log::notice($e);
            Session::flash('error', 'Your password was incorrect.');
            return Redirect::route('account.login')->withErrors($val)->withInput();
        } catch (Cartalyst\Sentry\Users\UserNotActivatedException $e) {
            Log::notice($e);
            Session::flash('error', 'You have not yet activated this account.');
            return Redirect::route('account.login')->withErrors($val)->withInput();
        } catch (Cartalyst\Sentry\Throttling\UserSuspendedException $e) {
            Log::notice($e);
            $time = $throttle->getSuspensionTime();
            Session::flash('error', "Your account has been suspended for $time minutes.");
            return Redirect::route('account.login')->withErrors($val)->withInput();
        } catch (Cartalyst\Sentry\Throttling\UserBannedException $e) {
            Log::notice($e);
            Session::flash('error', 'You have been banned. Please contact support.');
            return Redirect::route('account.login')->withErrors($val)->withInput();
        }

        Log::info('Login successful', array('Email' => $input['email']));
        return Redirect::intended(URL::route('pages.show', array('pages' => 'home')));
    }

    /**
     * Log the user out.
     *
     * @return Response
     */
    public function getLogout() {
        Log::info('User logged out', array('Email' => Sentry::getUser()->email));
        Sentry::logout();
        return Redirect::route('pages.show', array('pages' => 'home'));
    }
}
