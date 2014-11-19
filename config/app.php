<?php

/**
 * This file is part of Bootstrap CMS by Graham Campbell.
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Application Debug Mode
    |--------------------------------------------------------------------------
    |
    | When your application is in debug mode, detailed error messages with
    | stack traces will be shown on every error that occurs within your
    | application. If disabled, a simple generic error page is shown.
    |
    */

    'debug' => false,

    /*
    |--------------------------------------------------------------------------
    | Application URL
    |--------------------------------------------------------------------------
    |
    | This URL is used by the console to properly generate URLs when using
    | the Artisan command line tool. You should set this to the root of
    | your application so that it is used when running Artisan tasks.
    |
    */

    'url' => 'http://localhost',

    /*
    |--------------------------------------------------------------------------
    | Application Timezone
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default timezone for your application, which
    | will be used by the PHP date and date-time functions. We have gone
    | ahead and set this to a sensible default for you out of the box.
    |
    */

    'timezone' => 'UTC',

    /*
    |--------------------------------------------------------------------------
    | Application Locale Configuration
    |--------------------------------------------------------------------------
    |
    | The application locale determines the default locale that will be used
    | by the translation service provider. You are free to set this value
    | to any of the locales which will be supported by the application.
    |
    */

    'locale' => 'en',

    /*
    |--------------------------------------------------------------------------
    | Application Fallback Locale
    |--------------------------------------------------------------------------
    |
    | The fallback locale determines the locale to use when the current one
    | is not available. You may change the value to correspond to any of
    | the language folders that are provided through your application.
    |
    */

    'fallback_locale' => 'en',

    /*
    |--------------------------------------------------------------------------
    | Encryption Key
    |--------------------------------------------------------------------------
    |
    | This key is used by the Illuminate encrypter service and should be set
    | to a random, 32 character string, otherwise these encrypted strings
    | will not be safe. Please do this before deploying an application!
    |
    */

    'key' => 'YourSecretKey!!!',

    'cipher' => MCRYPT_RIJNDAEL_128,

    /*
    |--------------------------------------------------------------------------
    | Logging Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure the log settings for your application. Out of
    | the box, Laravel uses the Monolog PHP logging library. This gives
    | you a variety of powerful log handlers / formatters to utilize.
    |
    | Available Settings: "single", "daily", "syslog"
    |
    */

    'log' => 'daily',

    /*
    |--------------------------------------------------------------------------
    | Autoloaded Service Providers
    |--------------------------------------------------------------------------
    |
    | The service providers listed here will be automatically loaded on the
    | request to your application. Feel free to add your own services to
    | this array to grant expanded functionality to your applications.
    |
    */

    'providers' => [

        /*
         * Application Service Providers...
         */
        'GrahamCampbell\Exceptions\ExceptionsServiceProvider',
        'GrahamCampbell\BootstrapCMS\Providers\EventServiceProvider',
        'GrahamCampbell\BootstrapCMS\Providers\RouteServiceProvider',

        /*
         * Laravel Framework Service Providers...
         */
        'Illuminate\Foundation\Providers\ArtisanServiceProvider',
        'Illuminate\Auth\AuthServiceProvider',
        'Illuminate\Cache\CacheServiceProvider',
        'Illuminate\Foundation\Providers\ConsoleSupportServiceProvider',
        'Illuminate\Routing\ControllerServiceProvider',
        'Illuminate\Cookie\CookieServiceProvider',
        'Illuminate\Database\DatabaseServiceProvider',
        'Illuminate\Encryption\EncryptionServiceProvider',
        'Illuminate\Filesystem\FilesystemServiceProvider',
        'Illuminate\Foundation\Providers\FoundationServiceProvider',
        'Illuminate\Hashing\HashServiceProvider',
        'Illuminate\Html\HtmlServiceProvider',
        'Illuminate\Mail\MailServiceProvider',
        'Illuminate\Pagination\PaginationServiceProvider',
        'Illuminate\Queue\QueueServiceProvider',
        'Illuminate\Redis\RedisServiceProvider',
        'Illuminate\Auth\Passwords\PasswordResetServiceProvider',
        'Illuminate\Session\SessionServiceProvider',
        'Illuminate\Translation\TranslationServiceProvider',
        'Illuminate\Validation\ValidationServiceProvider',
        'Illuminate\View\ViewServiceProvider',

        /*
         * Package Service Providers...
         */
        'Barryvdh\Queue\AsyncServiceProvider',
        'McCool\LaravelAutoPresenter\LaravelAutoPresenterServiceProvider',
        'Lightgear\Asset\AssetServiceProvider',
        'Fideloper\Proxy\ProxyServiceProvider',
        'Cartalyst\Sentry\SentryServiceProvider',
        'GrahamCampbell\Core\CoreServiceProvider',
        'GrahamCampbell\HTMLMin\HTMLMinServiceProvider',
        'GrahamCampbell\Markdown\MarkdownServiceProvider',
        'GrahamCampbell\Security\SecurityServiceProvider',
        'GrahamCampbell\Binput\BinputServiceProvider',
        'GrahamCampbell\Throttle\ThrottleServiceProvider',
        'GrahamCampbell\Credentials\CredentialsServiceProvider',
        'GrahamCampbell\Navigation\NavigationServiceProvider',
        'GrahamCampbell\Contact\ContactServiceProvider',
        'GrahamCampbell\LogViewer\LogViewerServiceProvider',

        /*
         * Bootstrap CMS Provider...
         */
        'GrahamCampbell\BootstrapCMS\BootstrapCMSServiceProvider',

        /*
         * Debugbar Provider...
         */
        'Barryvdh\Debugbar\ServiceProvider',

    ],

    /*
    |--------------------------------------------------------------------------
    | Service Provider Manifest
    |--------------------------------------------------------------------------
    |
    | The service provider manifest is used by Laravel to lazy load service
    | providers which are not needed for each request, as well to keep a
    | list of all of the services. Here, you may set its storage spot.
    |
    */

    'manifest' => storage_path().'/framework',

    /*
    |--------------------------------------------------------------------------
    | Class Aliases
    |--------------------------------------------------------------------------
    |
    | This array of class aliases will be registered when this application
    | is started. However, feel free to register as many as you wish as
    | the aliases are "lazy" loaded so they don't hinder performance.
    |
    */

    'aliases' => [

        'App'         => 'Illuminate\Support\Facades\App',
        'Artisan'     => 'Illuminate\Support\Facades\Artisan',
        'Auth'        => 'Illuminate\Support\Facades\Auth',
        'Blade'       => 'Illuminate\Support\Facades\Blade',
        'Cache'       => 'Illuminate\Support\Facades\Cache',
        'Config'      => 'Illuminate\Support\Facades\Config',
        'Cookie'      => 'Illuminate\Support\Facades\Cookie',
        'Credentials' => 'GrahamCampbell\Credentials\Facades\Credentials',
        'Crypt'       => 'Illuminate\Support\Facades\Crypt',
        'DB'          => 'Illuminate\Support\Facades\DB',
        'Event'       => 'Illuminate\Support\Facades\Event',
        'File'        => 'Illuminate\Support\Facades\File',
        'Form'        => 'Illuminate\Html\FormFacade',
        'Hash'        => 'Illuminate\Support\Facades\Hash',
        'HTML'        => 'Illuminate\Html\HtmlFacade',
        'Input'       => 'Illuminate\Support\Facades\Input',
        'Lang'        => 'Illuminate\Support\Facades\Lang',
        'Log'         => 'Illuminate\Support\Facades\Log',
        'Mail'        => 'Illuminate\Support\Facades\Mail',
        'Paginator'   => 'Illuminate\Support\Facades\Paginator',
        'Password'    => 'Illuminate\Support\Facades\Password',
        'Queue'       => 'Illuminate\Support\Facades\Queue',
        'Redirect'    => 'Illuminate\Support\Facades\Redirect',
        'Redis'       => 'Illuminate\Support\Facades\Redis',
        'Request'     => 'Illuminate\Support\Facades\Request',
        'Response'    => 'Illuminate\Support\Facades\Response',
        'Route'       => 'Illuminate\Support\Facades\Route',
        'Schema'      => 'Illuminate\Support\Facades\Schema',
        'Session'     => 'Illuminate\Support\Facades\Session',
        'URL'         => 'Illuminate\Support\Facades\URL',
        'Validator'   => 'Illuminate\Support\Facades\Validator',
        'View'        => 'Illuminate\Support\Facades\View',
        'Asset'       => 'Lightgear\Asset\Facades\Asset',

    ],

];
