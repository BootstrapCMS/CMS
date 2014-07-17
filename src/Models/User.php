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

namespace GrahamCampbell\BootstrapCMS\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use GrahamCampbell\Credentials\Models\User as CredentialsUser;
use GrahamCampbell\BootstrapCMS\Models\Relations\Interfaces\HasManyPagesInterface;
use GrahamCampbell\BootstrapCMS\Models\Relations\Common\HasManyPagesTrait;
use GrahamCampbell\BootstrapCMS\Models\Relations\Interfaces\HasManyPostsInterface;
use GrahamCampbell\BootstrapCMS\Models\Relations\Common\HasManyPostsTrait;
use GrahamCampbell\BootstrapCMS\Models\Relations\Interfaces\HasManyEventsInterface;
use GrahamCampbell\BootstrapCMS\Models\Relations\Common\HasManyEventsTrait;
use GrahamCampbell\BootstrapCMS\Models\Relations\Interfaces\HasManyCommentsInterface;
use GrahamCampbell\BootstrapCMS\Models\Relations\Common\HasManyCommentsTrait;

/**
 * This is the user model class.
 *
 * @package    Bootstrap-CMS
 * @author     Graham Campbell
 * @copyright  Copyright (C) 2013-2014  Graham Campbell
 * @license    https://github.com/GrahamCampbell/Bootstrap-CMS/blob/master/LICENSE.md
 * @link       https://github.com/GrahamCampbell/Bootstrap-CMS
 */
class User extends CredentialsUser implements HasManyPagesInterface, HasManyPostsInterface, HasManyEventsInterface, HasManyCommentsInterface
{
    use HasManyPagesTrait, HasManyPostsTrait, HasManyEventsTrait, HasManyCommentsTrait;

    /**
     * Before deleting an existing model.
     *
     * @return mixed
     */
    public function beforeDelete()
    {
        $this->deletePages();
        $this->deletePosts();
        $this->deleteEvents();
        $this->deleteComments();
    }

    /**
     * Get the recent action history for the user.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function actionHistory()
    {
        // create the carbon object now to save cpu cycles
        // from creating the same object over and over again
        $carbon = Carbon::now()->subWeek();

        // iterate over the recently updated relations and get the combined history
        $history = new Collection();
        $this->getRecentlyModified($carbon)->each(function ($a) use ($history, $carbon) {
            $history->merge($a->revisionHistory()->where('updated_at', '>=', $carbon)->getResults());
        });

        // return the first 20 items
        if ($count = $this->sortCollection($history)->count() > 20) {
            return $history->slice(0, 19);
        }

        // return less than 20 items
        return $history;
    }

    /**
     * Get the recently modified relations.
     *
     * @param  \Carbon\Carbon  $carbon
     * @return \Illuminate\Database\Eloquent\Collection
     */
    protected function getRecentlyModified(Carbon $carbon)
    {
        // combine the recently modified relations
        $collection = new Collection();
        foreach (array('pages', 'posts', 'events', 'comments') as $model) {
            $collection->merge($this->$model()->where('updated_at', '>=', $carbon)->getResults());
        }

        return $collection;
    }

    /**
     * Get the recent action history for the user.
     *
     * @param  \Illuminate\Database\Eloquent\Collection  $collection
     * @return \Illuminate\Database\Eloquent\Collection
     */
    protected function sortCollection(Collection $collection)
    {
        // sort the collection by last updated
        $collection->sort(function ($a, $b) {
            if ($a = $a->updated_at->timestamp === $b = $b->updated_at->timestamp) {
                return 0;
            }
            return ($a < $b) ? 1 : -1;
        });

        return $collection;
    }
}
