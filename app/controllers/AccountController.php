<?php

class AccountController extends BaseController {

    protected $user;

    /**
     * Load the injected models.
     * Setup access permissions.
     */
    public function __construct(Page $page, User $user) {
        $this->page = $page;
        $this->user = $user;

        $this->users[] = 'getProfile';
        $this->users[] = 'putProfile';
        $this->users[] = 'getLogout';

        parent::__construct();
    }

    /**
     * Redirect to the profile page.
     *
     * @return Response
     */
    public function getIndex() {
        Session::flash('', ''); // work around laravel bug
        Session::reflash();
        Log::info('Redirecting from account to the profile page');
        return Redirect::route('account.profile');
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
        $input = array(
            'email' => Binput::get('email'),
            'password' => Binput::get('password'),
            'rememberMe' => Binput::get('rememberMe'),
            );

        $rules = array(
            'email' => 'required|min:4|max:32|email',
            'password' => 'required|min:6',
            );

        $v = Validator::make($input, $rules);
        if ($v->fails()) {
            Log::info('Login failed because validation failed', array('Email' => $input['email'], 'Messages' => $v->messages()->all()));
            return Redirect::route('account.login')->withErrors($v)->withInput();
        } else {
            try {
                $user = Sentry::getUserProvider()->findByLogin($input['email']);

                $throttle = Sentry::getThrottleProvider()->findByUserId($user->id);
                $throttle->check();

                $credentials = array(
                    'email'    => $input['email'],
                    'password' => $input['password'],
                );

                $user = Sentry::authenticate($credentials, $input['rememberMe']);
            } catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
                Log::notice($e);
                Session::flash('error', 'Your details were invalid.');
                return Redirect::route('account.login')->withErrors($v)->withInput();
            } catch (Cartalyst\Sentry\Users\UserNotActivatedException $e) {
                Log::notice($e);
                Session::flash('error', 'You have not yet activated this account.');
                return Redirect::route('account.login')->withErrors($v)->withInput();
            } catch (Cartalyst\Sentry\Throttling\UserSuspendedException $e) {
                Log::notice($e);
                $time = $throttle->getSuspensionTime();
                Session::flash('error', "Your account has been suspended for $time minutes.");
                return Redirect::route('account.login')->withErrors($v)->withInput();
            } catch (Cartalyst\Sentry\Throttling\UserBannedException $e) {
                Log::notice($e);
                Session::flash('error', 'You have been banned.');
                return Redirect::route('account.login')->withErrors($v)->withInput();
            }

            Log::info('Login successful', array('Email' => $input['email']));
            return Redirect::intended(URL::route('pages.show', array('pages' => 'home')));
        }
    }

    /**
     * Display the registration page.
     *
     * @return Response
     */
    public function getRegister() {
        if (Config::get('cms.regallowed') === false) {
            Log::notice('Registration disabled');
            Session::flash('error', 'Registration is currently disabled.');
            return Redirect::route('pages.show', array('pages' => 'home'));
        }
        return $this->viewMake('account.register');
    }

    /**
     * Try to register the user.
     *
     * @return Response
     */
    public function postRegister() {
        if (Config::get('cms.regallowed') === false) {
            Log::notice('Registration disabled');
            Session::flash('error', 'Registration is currently disabled.');
            return Redirect::route('pages.show', array('pages' => 'home'));
        }
        $input = array(
            'email' => Binput::get('email'),
            'password' => Binput::get('password'),
            'password_confirmation' => Binput::get('password_confirmation'),
        );

        $rules = array (
            'email' => 'required|min:4|max:32|email',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required',
        );

        $v = Validator::make($input, $rules);
        if ($v->fails()) {
            Log::info('Registration failed because validation failed', array('Email' => $input['email'], 'Messages' => $v->messages()->all()));
            return Redirect::route('account.register')->withErrors($v)->withInput();
        } else {
            try {
                $userdata = array(
                    'email' => $input['email'],
                    'password' => $input['password'],
                );

                $user = Sentry::register($userdata);

                if (Config::get('cms.regemail') === false) {
                    $user->attemptActivation($user->GetActivationCode());
                    $user->addGroup(Sentry::getGroupProvider()->findByName('Users'));

                    Log::info('Registration successful, activation not required', array('Email' => $input['email']));
                    Session::flash('success', 'Your account has been created successfully.');
                    return Redirect::route('pages.show', array('pages' => 'home'));
                } else {
                    $data = array(
                        'view' => 'emails.welcome',
                        'link' => URL::route('account.activate', array('id' => $user->getId(), 'code' => $user->GetActivationCode())),
                        'email' => $user->getLogin(),
                        'subject' => Config::get('cms.name').' - Welcome',
                    );

                    try {
                        Queue::push('MailHandler', $data);
                    } catch (Exception $e) {
                        Log::error($e);
                        $user->delete();
                        Session::flash('error', 'We were unable to create your account. Please contact support.');
                        return Redirect::route('account.register');
                    }

                    Log::info('Registration successful, activation required', array('Email' => $input['email']));
                    Session::flash('success', 'Your account has been created. Check your email for the confirmation link.');
                    return Redirect::route('pages.show', array('pages' => 'home'));
                }
            } catch (Cartalyst\Sentry\Users\LoginRequiredException $e) {
                Log::notice($e);
                Session::flash('error', 'Login field required.');
                return Redirect::route('account.register')->withErrors($v)->withInput();
            } catch (Cartalyst\Sentry\Users\UserExistsException $e) {
                Log::notice($e);
                Session::flash('error', 'User already exists.');
                return Redirect::route('account.register')->withErrors($v)->withInput();
            }
        }
    }

    /**
     * Display the user's profile.
     *
     * @return Response
     */
    public function getProfile() {
        return $this->viewMake('account.profile');
    }

    /**
     * Update the user's profile.
     *
     * @return Response
     */
    public function putProfile() {
        // TODO
        // this should be multiple functions to allow different properties to be updated separately
        return 'The is the profile PUT!';
    }

    /**
     * Display the password reset page.
     *
     * @return Response
     */
    public function getReset() {
        return $this->viewMake('account.reset');
    }

    /**
     * Queue the sending of the password reset email.
     *
     * @return Response
     */
    public function postReset() {
        $input = array(
            'email' => Binput::get('email'),
            );

        $rules = array (
            'email' => 'required|min:4|max:32|email',
            );

        $v = Validator::make($input, $rules);
        if ($v->fails()) {
            return Redirect::route('account.reset')->withErrors($v)->withInput();
        } else {
            try {
                $user = Sentry::getUserProvider()->findByLogin($input['email']);

                $data = array(
                    'view' => 'emails.reset',
                    'link' => URL::route('account.password', array('id' => $user->getId(), 'code' => $user->getResetPasswordCode())),
                    'email' => $user->getLogin(),
                    'subject' => Config::get('cms.name').' - Password Reset Confirmation',
                );

                try {
                    Queue::push('MailHandler', $data);
                } catch (Exception $e) {
                    Log::critical($e);
                    Session::flash('error', 'We were unable to reset your password. Please contact support.');
                    return Redirect::route('account.reset');
                }

                Log::info('Reset email sent', array('Email' => $input['email']));
                Session::flash('success', 'Check your email for password reset information.');
                return Redirect::route('account.reset');
            } catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
                Log::notice($e);
                Session::flash('error', 'That user does not exist.');
                return Redirect::route('account.reset');
            }
        }
    }

    /**
     * Reset the user's passowrd.
     *
     * @return Response
     */
    public function getPassword($id = null, $code = null) {
        if ($id === null || $code === null) {
            App::abort(400);
        }

        try {
            $user = Sentry::getUserProvider()->findById($id);

            $password = $this->_generatePassword(12,8);

            if ($user->attemptResetPassword($code, $password)) {

                $data = array(
                    'view' => 'emails.password',
                    'password' => $password,
                    'email' => $user->getLogin(),
                    'subject' => Config::get('cms.name').' - New Password Information',
                );

                Log::info('Password reset successfully', array('Email' => $input['email']));
                Session::flash('success', 'Your password has been changed. Check your email for the new password.');
                return Redirect::route('pages.show', array('pages' => 'home'));
            }
            else {
                Log::error(''); // TODO!
                Session::flash('error', 'There was a problem resetting your password. Please contact support.');
                return Redirect::route('base');
            }
        }
        catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
            Log::notice($e);
            Session::flash('error', 'There was a problem resetting your password. Please contact support.');
            return Redirect::route('pages.show', array('pages' => 'home'));
        }
    }

    /**
     * Activate the user.
     *
     * @return Response
     */
    public function getActivate($id = null, $code = null) {
        if ($id === null || $code === null) {
            App::abort(400);
        }

        try {
            $user = Sentry::getUserProvider()->findById($id);

            if ($user->attemptActivation($code)) {
                $user->addGroup(Sentry::getGroupProvider()->findByName('Users'));

                Log::info('Activation successful', array('Email' => $input['email']));
                Session::flash('success', 'Your account has been activated successfully.');
                return Redirect::route('pages.show', array('pages' => 'home'));
            } else {
                Session::flash('error', 'There was a problem activating this account. Please contact support.');
                return Redirect::route('pages.show', array('pages' => 'home'));
            }
        } catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
            Log::error($e);
            Session::flash('error', 'There was a problem activating this account. Please contact support.');
            return Redirect::route('pages.show', array('pages' => 'home'));
        } catch (Cartalyst\SEntry\Users\UserAlreadyActivatedException $e) {
            Log::notice($e);
            Session::flash('error', 'You have already activated this account.');
            return Redirect::route('pages.show', array('pages' => 'home'));
        }
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

    /**
     * Generate a random password.
     *
     * @return String
     */
    protected function _generatePassword($length=9, $strength=4) {
        $vowels = 'aeiouy';
        $consonants = 'bcdfghjklmnpqrstvwxz';
        if ($strength & 1) {
            $consonants .= 'BCDFGHJKLMNPQRSTVWXZ';
        }
        if ($strength & 2) {
            $vowels .= "AEIOUY";
        }
        if ($strength & 4) {
            $consonants .= '23456789';
        }
        if ($strength & 8) {
            $consonants .= '@#$%';
        }

        $password = '';
        $alt = time() % 2;
        for ($i = 0; $i < $length; $i++) {
            if ($alt == 1) {
                $password .= $consonants[(rand() % strlen($consonants))];
                $alt = 0;
            } else {
                $password .= $vowels[(rand() % strlen($vowels))];
                $alt = 1;
            }
        }
        return $password;
    }
}
