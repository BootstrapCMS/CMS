<?php

/*
 * This file is part of Bootstrap CMS.
 *
 * (c) Graham Campbell <graham@mineuk.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\BootstrapCMS\Subscribers;

use Illuminate\Config\Repository;
use Illuminate\Events\Dispatcher;
use Illuminate\Log\Writer;

/**
 * This is the core subscriber class.
 *
 * @author Graham Campbell <graham@mineuk.com>
 */
class CoreSubscriber
{
    /**
     * The config instance.
     *
     * @var \Illuminate\Config\Repository
     */
    protected $config;

    /**
     * The log instance.
     *
     * @var \Illuminate\Log\Writer
     */
    protected $log;

    /**
     * Create a new instance.
     *
     * @param \Illuminate\Config\Repository $config
     * @param \Illuminate\Log\Writer        $log
     *
     * @return void
     */
    public function __construct(Repository $config, Writer $log)
    {
        $this->config = $config;
        $this->log = $log;
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     *
     * @return void
     */
    public function subscribe(Dispatcher $events)
    {
        $events->listen(
            'page.load',
            'GrahamCampbell\BootstrapCMS\Subscribers\CoreSubscriber@onPageLoad',
            5
        );
        $events->listen(
            'artisan.start',
            'GrahamCampbell\BootstrapCMS\Subscribers\CoreSubscriber@onArtisanStart',
            5
        );
        $events->listen(
            'illuminate.query',
            'GrahamCampbell\BootstrapCMS\Subscribers\CoreSubscriber@onIlluminateQuery',
            5
        );
        $events->listen(
            'locale.changed',
            'GrahamCampbell\BootstrapCMS\Subscribers\CoreSubscriber@onLocaleChanged',
            5
        );
    }

    /**
     * Handle a page.load event.
     *
     * @param mixed $event
     *
     * @return void
     */
    public function onPageLoad($event = [])
    {
        if ($this->config->get('log.pageload') == true) {
            if (!is_array($event)) {
                $event = [$event];
            }
            $this->log->debug('Page Loading', $event);
        }
    }

    /**
     * Handle an artisan.start event.
     *
     * @param mixed $event
     *
     * @return void
     */
    public function onArtisanStart($event = [])
    {
        if ($this->config->get('log.artisanstart') == true) {
            if (!is_array($event)) {
                $event = [$event];
            }
            $this->log->debug('Artisan Starting', $event);
        }
    }

    /**
     * Handle a illuminate.query event.
     *
     * @param mixed $event
     *
     * @return void
     */
    public function onIlluminateQuery($event = [])
    {
        if ($this->config->get('log.illuminatequery') == true) {
            if (!is_array($event)) {
                $event = [$event];
            }
            $this->log->debug('Query Executed', $event);
        }
    }

    /**
     * Handle a locale.changed event.
     *
     * @param mixed $event
     *
     * @return void
     */
    public function onLocaleChanged($event = [])
    {
        if ($this->config->get('log.localechanged') == true) {
            if (!is_array($event)) {
                $event = [$event];
            }
            $this->log->debug('Locale Changed', $event);
        }
    }

    /**
     * Get the config instance.
     *
     * @return \Illuminate\Config\Repository
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Get the log instance.
     *
     * @return \Illuminate\Log\Writer
     */
    public function getLog()
    {
        return $this->log;
    }
}
