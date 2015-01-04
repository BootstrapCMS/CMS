<?php

/*
 * This file is part of Bootstrap CMS.
 *
 * (c) Graham Campbell <graham@mineuk.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\BootstrapCMS\Repositories;

use GrahamCampbell\Credentials\Repositories\AbstractRepository;
use GrahamCampbell\Credentials\Repositories\PaginateRepositoryTrait;

/**
 * This is the post repository class.
 *
 * @author Graham Campbell <graham@mineuk.com>
 */
class PostRepository extends AbstractRepository
{
    use PaginateRepositoryTrait;
}
