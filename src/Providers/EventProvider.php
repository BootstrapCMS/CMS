<?php

/*
 * This file is part of Bootstrap CMS.
 *
 * (c) Graham Campbell <graham@mineuk.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\BootstrapCMS\Providers;

use GrahamCampbell\Database\Providers\AbstractProvider;
use GrahamCampbell\Database\Providers\Common\PaginateProviderTrait;
use GrahamCampbell\Database\Providers\Interfaces\PaginateProviderInterface;

/**
 * This is the event provider class.
 *
 * @author Graham Campbell <graham@mineuk.com>
 */
class EventProvider extends AbstractProvider implements PaginateProviderInterface
{
    use PaginateProviderTrait;
}
