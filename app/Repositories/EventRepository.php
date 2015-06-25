<?php

/*
 * This file is part of Bootstrap CMS.
 *
 * (c) Graham Campbell <graham@alt-three.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\BootstrapCMS\Repositories;

use GrahamCampbell\Credentials\Repositories\AbstractRepository;
use GrahamCampbell\Credentials\Repositories\PaginateRepositoryTrait;

/**
 * This is the event repository class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class EventRepository extends AbstractRepository
{
    use PaginateRepositoryTrait;
}
