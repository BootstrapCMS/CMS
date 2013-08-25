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
use Passwd;
use Sentry;

class ResetController extends BaseController {

    /**
     * Constructor (setup access permissions).
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Display the password reset form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getReset() {
        return $this->viewMake('account.reset');
    }

    /**
     * Queue the sending of the password reset email.
     *
     * @return \Illuminate\Http\Response
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
                Queue::push('GrahamCampbell\BootstrapCMS\Handlers\MailHandler', $data, Config::get('mail.queue'));
            } catch (\Exception $e) {
                Log::alert($e);
                Session::flash('error', 'We were unable to reset your password. Please contact support.');
                return Redirect::route('account.reset')->withInput();
            }

            Log::info('Reset email sent', array('Email' => $input['email']));
            Session::flash('success', 'Check your email for password reset information.');
            return Redirect::route('account.reset');
        } catch (\Cartalyst\Sentry\Users\UserNotFoundException $e) {
            Log::notice($e);
            Session::flash('error', 'That user does not exist.');
            return Redirect::route('account.reset');
        }
    }

    /**
     * Reset the user's password.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPassword($id = null, $code = null) {
        if ($id === null || $code === null) {
            App::abort(400);
        }

        try {
            $user = Sentry::getUserProvider()->findById($id);

            $password = Passwd::generate(12,8);

            if (!$user->attemptResetPassword($code, $password)) {
                Log::error('There was a problem resetting a password', array('Id' => $id));
                Session::flash('error', 'There was a problem resetting your password. Please contact support.');
                return Redirect::route('pages.show', array('pages' => 'home'));
            }

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
                Session::flash('error', 'We were unable to send you your password. Please contact support.');
                return Redirect::route('pages.show', array('pages' => 'home'));
            }

            Log::info('Password reset successfully', array('Email' => $data['email']));
            Session::flash('success', 'Your password has been changed. Check your email for the new password.');
            return Redirect::route('pages.show', array('pages' => 'home'));
        } catch (\Cartalyst\Sentry\Users\UserNotFoundException $e) {
            Log::error($e);
            Session::flash('error', 'There was a problem resetting your password. Please contact support.');
            return Redirect::route('pages.show', array('pages' => 'home'));
        }
    }
}
