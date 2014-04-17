<?php

/**
 * This file is part of Laravel Credentials by Graham Campbell.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

return array(

    /*
    |--------------------------------------------------------------------------
    | Enable Public Registration
    |--------------------------------------------------------------------------
    |
    | This defines if public registration is allowed.
    |
    | Default to true.
    |
    */

    'regallowed' => true,

    /*
    |--------------------------------------------------------------------------
    | Email Verification On Registration
    |--------------------------------------------------------------------------
    |
    | This defines if public registration requires email activation.
    |
    | Default to true.
    |
    */

    'regemail' => true,

    /*
    |--------------------------------------------------------------------------
    | Login Page
    |--------------------------------------------------------------------------
    |
    | This defines the view that is used for the login page.
    |
    */

    'login' => 'graham-campbell/credentials::account.login',

    /*
    |--------------------------------------------------------------------------
    | Registration Page
    |--------------------------------------------------------------------------
    |
    | This defines the view that is used for the registration page.
    |
    */

    'registration' => 'graham-campbell/credentials::account.register',

    /*
    |--------------------------------------------------------------------------
    | Forgot Password Page
    |--------------------------------------------------------------------------
    |
    | This defines the view that is used for the forgot password page.
    |
    */

    'reset' => 'graham-campbell/credentials::account.reset',

    /*
    |--------------------------------------------------------------------------
    | Resend Activation Page
    |--------------------------------------------------------------------------
    |
    | This defines the view that is used for the resend activation page.
    |
    */

    'resend' => 'graham-campbell/credentials::account.resend',

    /*
    |--------------------------------------------------------------------------
    | Profile Password Page
    |--------------------------------------------------------------------------
    |
    | This defines the view that is used for the profile page.
    |
    */

    'profile' => 'graham-campbell/credentials::account.profile'

);
