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

namespace GrahamCampbell\BootstrapCMS\Debug;

use Exception;
use Illuminate\Contracts\Config\Repository as Config;
use Illuminate\Contracts\Container\Container;
use Illuminate\Foundation\Debug\ExceptionHandler as BaseHandler;
use Psr\Log\LoggerInterface as Log;
use Symfony\Component\Debug\Exception\FlattenException;
use Symfony\Component\HttpFoundation\Response;

/**
 * This is the exception hander class.
 *
 * @author    Graham Campbell <graham@mineuk.com>
 * @copyright 2013-2014 Graham Campbell
 * @license   <https://github.com/GrahamCampbell/Bootstrap-CMS/blob/master/LICENSE.md> AGPL 3.0
 */
class ExceptionHandler extends BaseHandler
{
    /**
     * The container instance.
     *
     * @var \Illuminate\Contracts\Container\Container
     */
    protected $container;

    /**
     * Create a new exception handler instance.
     *
     * @param \Illuminate\Contracts\Config\Repository   $config
     * @param \Psr\Log\LoggerInterface                  $log
     * @param \Illuminate\Contracts\Container\Container $container
     *
     * @return void
     */
    public function __construct(Config $config, Log $log, Container $container)
    {
        $this->container = $container;

        parent::__construct($config, $log);
    }

    /**
     * Render an exception into a response.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Exception               $e
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function render($request, Exception $e)
    {
        $flattened = FlattenException::create($e);

        $code = $flattened->getStatusCode();
        $headers = $flattened->getHeaders();

        $content = $this->getContent($e, $code);

        return new Response($content, $code, $headers);
    }

    /**
     * Get the HTML content associated with the given exception.
     *
     * @param \Exception $exception
     * @param int        $code
     *
     * @return string
     */
    protected function getContent(Exception $exception, $code)
    {
        if ($this->config->get('app.debug')) {
            return $this->container->make(DebugDisplayer::class)->display($exception, $code);
        }

        return $this->container->make(PlainDisplayer::class)->display($exception, $code);
    }
}
