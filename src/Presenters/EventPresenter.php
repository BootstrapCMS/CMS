<?php

/*
 * This file is part of Bootstrap CMS.
 *
 * (c) Graham Campbell <graham@mineuk.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\BootstrapCMS\Presenters;

use GrahamCampbell\BootstrapCMS\Models\Event;
use McCool\LaravelAutoPresenter\BasePresenter;

/**
 * This is the event presenter class.
 *
 * @author Graham Campbell <graham@mineuk.com>
 */
class EventPresenter extends BasePresenter
{
    use OwnerPresenterTrait;

    /**
     * Create a new instance.
     *
     * @param \GrahamCampbell\BootstrapCMS\Models\Event $event
     *
     * @return void
     */
    public function __construct(Event $event)
    {
        $this->resource = $event;
    }
}
