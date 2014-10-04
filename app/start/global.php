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

App::fatal(function ($exception) {
    try {
        Log::alert($exception);
    } catch (Exception $e) {
        // life's a bitch...
    }
    try {
        $code = 500;
        $name = 'Internal Server Error';
        $message = 'An error has occurred and this resource cannot be displayed.';
        if (Request::ajax()) {
            $details = array(
                'success' => false,
                'code' => $code,
                'msg' => $message,
            );
            return Response::json($details, $code);
        }
        if (Config::get('app.debug') === false) {
            $details = array(
                'code' => $code,
                'name' => $name,
                'message' => $message,
                'extra' => 'Fatal Error',
            );
            return Response::view(Config::get('views.error', 'error'), $details, $code);
        }
    } catch (Exception $e) {
        echo 'Fatal Error';
    }
});

App::error(function (Exception $exception, $code) {
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

    $headers = array();

    try {
        if ($exception instanceof Symfony\Component\HttpKernel\Exception\HttpExceptionInterface) {
            $headers = (array) $exception->getHeaders();
        }
    } catch (Exception $e) {
        $headers = array();
    }

    try {
        switch ($code) {
            case 400:
                $name = 'Bad Request';
                $message = 'The request cannot be fulfilled due to bad syntax.';
                break;
            case 401:
                $name = 'Unauthorized';
                $message = 'Authentication is required and has failed or has not yet been provided.';
                break;
            case 403:
                $name = 'Forbidden';
                $message = 'The request was a valid request, but the server is refusing to respond to it.';
                break;
            case 404:
                $name = 'Not Found';
                $message = 'The requested resource could not be found but may be available again in the future.';
                break;
            case 405:
                $name = 'Method Not Allowed';
                $message = 'A request was made of a resource using a request method not supported by that resource.';
                break;
            case 406:
                $name = 'Not Acceptable';
                $message = 'The requested resource is only capable of generating content not acceptable.';
                break;
            case 409:
                $name = 'Conflict';
                $message = 'The request could not be processed because of conflict in the request.';
                break;
            case 410:
                $name = 'Gone';
                $message = 'The requested resource is no longer available and will not be available again.';
                break;
            case 411:
                $name = 'Length Required';
                $message = 'The request did not specify the length of its content, which is required by the requested resource.';
                break;
            case 412:
                $name = 'Precondition Failed';
                $message = 'The server does not meet one of the preconditions that the requester put on the request.';
                break;
            case 415:
                $name = 'Unsupported Media Type';
                $message = 'The request entity has a media type which the server or resource does not support.';
                break;
            case 422:
                $name = 'Unprocessable Entity';
                $message = 'The request was well-formed but was unable to be followed due to semantic errors.';
                break;
            case 428:
                $name = 'Precondition Required';
                $message = 'The origin server requires the request to be conditional.';
                break;
            case 429:
                $name = 'Too Many Requests';
                $message = 'The user has sent too many requests in a given amount of time.';
                break;
            case 500:
                $name = 'Internal Server Error';
                $message = 'An error has occurred and this resource cannot be displayed.';
                break;
            case 501:
                $name = 'Not Implemented';
                $message = 'The server either does not recognize the request method, or it lacks the ability to fulfil the request.';
                break;
            case 502:
                $name = 'Bad Gateway';
                $message = 'The server was acting as a gateway or proxy and received an invalid response from the upstream server.';
                break;
            case 503:
                $name = 'Service Unavailable';
                $message = 'The server is currently unavailable. It may be overloaded or down for maintenance.';
                break;
            case 504:
                $name = 'Gateway Timeout';
                $message = 'The server was acting as a gateway or proxy and did not receive a timely response from the upstream server.';
                break;
            case 505:
                $name = 'HTTP Version Not Supported';
                $message = 'The server does not support the HTTP protocol version used in the request.';
                break;
            default:
                $code = 500;
                $name = 'Internal Server Error';
                $message = 'An error has occurred and this resource cannot be displayed.';
                if (Request::ajax()) {
                    $details = array(
                        'success' => false,
                        'code' => $code,
                        'msg' => $message,
                    );
                    return Response::json($details, $code, $headers);
                }
                if (Config::get('app.debug') === false) {
                    $details = array(
                        'code' => $code,
                        'name' => $name,
                        'message' => $message,
                        'extra' => 'Fatal Error',
                    );
                    return Response::view(Config::get('views.error', 'error'), $details, $code, $headers);
                }
        }
        if (Request::ajax()) {
            $details = array(
                'success' => false,
                'code' => $code,
                'msg' => (!$exception->getMessage() || strlen($exception->getMessage()) > 100 || strlen($exception->getMessage()) < 5) ? $message : $exception->getMessage(),
            );
            return Response::json($details, $code, $headers);
        }
        if (Config::get('app.debug') === false) {
            $details = array(
                'code' => $code,
                'name' => $name,
                'message' => $message,
                'extra' => (!$exception->getMessage() || strlen($exception->getMessage()) > 35 || strlen($exception->getMessage()) < 5) ? 'Houston, We Have A Problem' : $exception->getMessage(),
            );
            return Response::view(Config::get('views.error', 'error'), $details, $code, $headers);
        }
    } catch (Exception $e) {
        Log::critical($e);
        try {
            $code = 500;
            $name = 'Internal Server Error';
            $message = 'An error has occurred and this resource cannot be displayed.';
            if (Request::ajax()) {
                $details = array(
                    'success' => false,
                    'code' => $code,
                    'msg' => $message,
                );
                return Response::json($details, $code);
            }
            if (Config::get('app.debug') === false) {
                $details = array(
                    'code' => $code,
                    'name' => $name,
                    'message' => $message,
                    'extra' => 'Fatal Error',
                );
                return Response::view(Config::get('views.error', 'error'), $details, $code);
            }
        } catch (Exception $e) {
            echo 'Fatal Error';
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

App::down(function () {
    return Response::view(Config::get('views.maintenance', 'maintenance'), array(), 503);
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
require app_path().'/assets.php';
