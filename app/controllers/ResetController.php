<?php

class ResetController extends BaseController {

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

        $val = Validator::make($input, $rules);
        if ($val->fails()) {
            return Redirect::route('account.reset')->withErrors($val)->withInput();
        }

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
                Log::alert($e);
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

            $password = $this->generatePassword(12,8);

            if (!$user->attemptResetPassword($code, $password)) {
                Log::error('There was a problem resetting a password', array('Id' => $id));
                Session::flash('error', 'There was a problem resetting your password. Please contact support.');
                return Redirect::route('base');
            }

            $data = array(
                'view' => 'emails.password',
                'password' => $password,
                'email' => $user->getLogin(),
                'subject' => Config::get('cms.name').' - New Password Information',
            );

            Log::info('Password reset successfully', array('Email' => $data['email']));
            Session::flash('success', 'Your password has been changed. Check your email for the new password.');
            return Redirect::route('pages.show', array('pages' => 'home'));
        } catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
            Log::error($e);
            Session::flash('error', 'There was a problem resetting your password. Please contact support.');
            return Redirect::route('pages.show', array('pages' => 'home'));
        }
    }

    /**
     * Generate a random password.
     *
     * @return String
     */
    protected function generatePassword($length = 9, $strength = 4) {
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
