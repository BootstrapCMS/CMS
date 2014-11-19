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

namespace GrahamCampbell\BootstrapCMS\Exceptions;

/**
 * This is the exception info trait.
 *
 * @author    Graham Campbell <graham@mineuk.com>
 * @copyright 2013-2014 Graham Campbell
 * @license   <https://github.com/GrahamCampbell/Bootstrap-CMS/blob/master/LICENSE.md> AGPL 3.0
 */
trait InfoTrait
{
    /**
     * Get the exception information.
     *
     * @param int    $code
     * @param string $msg
     *
     * @return array
     */
    protected function info($code, $msg)
    {
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
        }

        $extra = (!$msg || strlen($msg) > 35 || strlen($msg) < 5) ? 'Houston, We Have A Problem' : $msg;

        return compact('code', 'name', 'message', 'extra');
    }
}
