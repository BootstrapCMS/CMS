<?php

class RegistrationController extends BaseController {

    protected $user;

    /**
     * Load the injected models.
     * Setup access permissions.
     */
    public function __construct(Page $page) {
        $this->page = $page;

        parent::__construct();
    }

    /**
     * Display the registration page.
     *
     * @return Response
     */
    public function getRegister() {
        if (!Config::get('cms.regallowed')) {
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
        if (!Config::get('cms.regallowed')) {
            Log::notice('Registration disabled');
            Session::flash('error', 'Registration is currently disabled.');
            return Redirect::route('pages.show', array('pages' => 'home'));
        }

        $input = array(
            'first_name'            => Binput::get('first_name'),
            'last_name'             => Binput::get('last_name'),
            'email'                 => Binput::get('email'),
            'password'              => Binput::get('password'),
            'password_confirmation' => Binput::get('password_confirmation'),
        );

        $rules = array (
            'first_name'            => 'required|min:2|max:32',
            'last_name'             => 'required|min:2|max:32',
            'email'                 => 'required|min:4|max:32|email',
            'password'              => 'required|min:6|confirmed',
            'password_confirmation' => 'required',
        );

        $val = Validator::make($input, $rules);
        if ($val->fails()) {
            Log::info('Registration failed because validation failed', array('Email' => $input['email'], 'Messages' => $val->messages()->all()));
            return Redirect::route('account.register')->withErrors($val)->withInput();
        }

        try {
            unset($input['password_confirmation']);

            $user = Sentry::register($input);

            if (!Config::get('cms.regemail')) {
                $user->attemptActivation($user->GetActivationCode());
                $user->addGroup(Sentry::getGroupProvider()->findByName('Users'));

                Log::info('Registration successful, activation not required', array('Email' => $input['email']));
                Session::flash('success', 'Your account has been created successfully.');
                return Redirect::route('pages.show', array('pages' => 'home'));
            }

            try {
                $data = array(
                    'view'    => 'emails.welcome',
                    'url'     => URL::route('pages.show', array('pages' => 'home')),
                    'link'    => URL::route('account.activate', array('id' => $user->getId(), 'code' => $user->GetActivationCode())),
                    'email'   => $user->getLogin(),
                    'subject' => Config::get('cms.name').' - Welcome',
                );

                Queue::push('MailHandler', $data);
            } catch (Exception $e) {
                Log::alert($e);
                $user->delete();
                Session::flash('error', 'We were unable to create your account. Please contact support.');
                return Redirect::route('account.register');
            }

            Log::info('Registration successful, activation required', array('Email' => $input['email']));
            Session::flash('success', 'Your account has been created. Check your email for the confirmation link.');
            return Redirect::route('pages.show', array('pages' => 'home'));
        } catch (Cartalyst\Sentry\Users\UserExistsException $e) {
            Log::notice($e);
            Session::flash('error', 'User already exists.');
            return Redirect::route('account.register')->withErrors($val)->withInput();
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

            if (!$user->attemptActivation($code)) {
                Session::flash('error', 'There was a problem activating this account. Please contact support.');
                return Redirect::route('pages.show', array('pages' => 'home'));
            }

            $user->addGroup(Sentry::getGroupProvider()->findByName('Users'));

            Log::info('Activation successful', array('Email' => $user->email));
            Session::flash('success', 'Your account has been activated successfully. You may now login.');
            return Redirect::route('account.login', array('pages' => 'home'));
        } catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
            Log::error($e);
            Session::flash('error', 'There was a problem activating this account. Please contact support.');
            return Redirect::route('pages.show', array('pages' => 'home'));
        } catch (Cartalyst\SEntry\Users\UserAlreadyActivatedException $e) {
            Log::notice($e);
            Session::flash('warning', 'You have already activated this account. You may want to login.');
            return Redirect::route('account.login', array('pages' => 'home'));
        }
    }
}
