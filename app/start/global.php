<?php

/*
|--------------------------------------------------------------------------
| Register The Laravel Class Loader
|--------------------------------------------------------------------------
|
| In addition to using Composer, you may use the Laravel class loader to
| load your controllers and models. This is useful for keeping all of
| your classes in the "global" namespace without Composer updating.
|
*/

ClassLoader::addDirectories(array(
    // it is better to autoload in composer.json
));

/*
|--------------------------------------------------------------------------
| Application Error Logger
|--------------------------------------------------------------------------
|
| Here we will configure the error logger setup for the application which
| is built on top of the wonderful Monolog library. By default we will
| build a rotating log file setup which creates a new file each day.
|
*/

$logFile = 'log-'.php_sapi_name().'.txt';

Log::useDailyFiles(storage_path().'/logs/'.$logFile);

/*
|--------------------------------------------------------------------------
| Application Error Handler
|--------------------------------------------------------------------------
|
| Here you may handle any errors that occur in your application, including
| logging them or displaying custom views for specific errors. You may
| even register several error handlers to handle different types of
| exceptions. If nothing is returned, the default error view is
| shown, which includes a detailed stack trace during debug.
|
*/

App::fatal(function($exception) {
    try {
        Log::alert($exception);
    } catch (Exception $e) {
        // life's a bitch...
    }
    try {
        $details = array(
            'exception' => $exception,
            'code' => 500,
            'name' => 'Internal Server Error',
            'message' => 'An error has occurred and this page cannot be displayed.',
            'extra' => 'Fatal Error',
        );
        return Response::view('error', $details, 500);
    } catch (Exception $e) {
        echo 'Fatal Error';
    }
});

App::error(function(Exception $exception, $code) {
    switch ($code) {
        case 404:
            Log::warning($exception);
            break;
        case 500:
            Log::critical($exception);
            break;
        default:
            Log::error($exception);
    }

    if (Config::get('app.debug') === false) {
        try {
            switch ($code) {
                case 400:
                    $details = array(
                        'exception' => $exception,
                        'code' => $code,
                        'name' => 'Bad Request',
                        'message' => 'The request cannot be fulfilled due to bad syntax.',
                        'extra' => $exception->getMessage(),
                    );
                    return Response::view('error', $details, $code);
                case 401:
                    $details = array(
                        'exception' => $exception,
                        'code' => $code,
                        'name' => 'Unauthorized',
                        'message' => 'Authentication is required and has failed or has not yet been provided.',
                        'extra' => $exception->getMessage(),
                    );
                    return Response::view('error', $details, $code);
                case 403:
                    $details = array(
                        'exception' => $exception,
                        'code' => $code,
                        'name' => 'Forbidden',
                        'message' => 'The request was a valid request, but the server is refusing to respond to it.',
                        'extra' => $exception->getMessage(),
                    );
                    return Response::view('error', $details, $code);
                case 404:
                    $details = array(
                        'exception' => $exception,
                        'code' => $code,
                        'name' => 'Not Found',
                        'message' => 'The requested resource could not be found but may be available again in the future.',
                        'extra' => $exception->getMessage(),
                    );
                    return Response::view('error', $details, $code);
                case 405:
                    $details = array(
                        'exception' => $exception,
                        'code' => $code,
                        'name' => 'Method Not Allowed',
                        'message' => 'A request was made of a resource using a request method not supported by that resource.',
                        'extra' => $exception->getMessage(),
                    );
                    return Response::view('error', $details, $code);
                case 500:
                    $details = array(
                        'exception' => $exception,
                        'code' => $code,
                        'name' => 'Internal Server Error',
                        'message' => 'An error has occurred and this page cannot be displayed.',
                        'extra' => $exception->getMessage(),
                    );
                    return Response::view('error', $details, $code);
                case 501:
                    $details = array(
                        'exception' => $exception,
                        'code' => $code,
                        'name' => 'Not Implemented',
                        'message' => 'The server either does not recognize the request method, or it lacks the ability to fulfill the request.',
                        'extra' => $exception->getMessage(),
                    );
                    return Response::view('error', $details, $code);
                case 502:
                    $details = array(
                        'exception' => $exception,
                        'code' => $code,
                        'name' => 'Bad Gateway',
                        'message' => 'The server was acting as a gateway or proxy and received an invalid response from the upstream server.',
                        'extra' => $exception->getMessage(),
                    );
                    return Response::view('error', $details, $code);
                case 503:
                    $details = array(
                        'exception' => $exception,
                        'code' => $code,
                        'name' => 'Service Unavailable',
                        'message' => 'The server is currently unavailable. It may be overloaded or down for maintenance.',
                        'extra' => $exception->getMessage(),
                    );
                    return Response::view('error', $details, $code);
                case 504:
                    $details = array(
                        'exception' => $exception,
                        'code' => $code,
                        'name' => 'Gateway Timeout',
                        'message' => 'The server was acting as a gateway or proxy and did not receive a timely response from the upstream server.',
                        'extra' => $exception->getMessage(),
                    );
                    return Response::view('error', $details, $code);
                case 505:
                    $details = array(
                        'exception' => $exception,
                        'code' => $code,
                        'name' => 'HTTP Version Not Supported',
                        'message' => 'The server does not support the HTTP protocol version used in the request.',
                        'extra' => $exception->getMessage(),
                    );
                    return Response::view('error', $details, $code);
                default:
                    $details = array(
                        'exception' => $exception,
                        'code' => $code,
                        'name' => 'Unknown Error',
                        'message' => 'An unknown error has occurred and this page cannot be displayed.',
                        'extra' => $exception->getMessage(),
                    );
                    return Response::view('error', $details, 500);
            }
        } catch (Exception $e) {
            try {
                $details = array(
                    'exception' => $exception,
                    'code' => 500,
                    'name' => 'Internal Server Error',
                    'message' => 'An error has occurred and this page cannot be displayed.',
                    'extra' => 'Fatal Error',
                );
                return Response::view('error', $details, 500);
            } catch (Exception $e) {
                echo 'Fatal Error';
            }
        }
    }
});

/*
|--------------------------------------------------------------------------
| Maintenance Mode Handler
|--------------------------------------------------------------------------
|
| The "down" Artisan command gives you the ability to put an application
| into maintenance mode. Here, you will define what is displayed back
| to the user if maintenance mode is in effect for this application.
|
*/

App::down(function() {
    return Response::view('maintenance', array(), 503);
});

/*
|--------------------------------------------------------------------------
| Require The Filters File
|--------------------------------------------------------------------------
|
| Next we will load the filters file for the application. This gives us
| a nice separate location to store our route and application filter
| definitions instead of putting them all in the main routes file.
|
*/

require app_path().'/filters.php';
require app_path().'/listeners.php';
