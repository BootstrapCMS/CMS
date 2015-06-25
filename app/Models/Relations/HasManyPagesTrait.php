<?php

/*
 * This file is part of Bootstrap CMS.
 *
 * (c) Graham Campbell <graham@alt-three.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\BootstrapCMS\Models\Relations;

/**
 * This is the has many pages trait.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
trait HasManyPagesTrait
{
    /**
     * Get the page relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOneOrMany
     */
    public function pages()
    {
        return $this->hasMany('GrahamCampbell\BootstrapCMS\Models\Page');
    }

    /**
     * Delete all pages.
     *
     * @return void
     */
    public function deletePages()
    {
        foreach ($this->pages()->get(['id', 'slug']) as $page) {
            $page->delete();
        }
    }
}
