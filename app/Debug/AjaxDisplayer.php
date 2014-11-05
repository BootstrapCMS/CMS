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

/**
 * This is the ajax displayer class.
 *
 * @author    Graham Campbell <graham@mineuk.com>
 * @copyright 2013-2014 Graham Campbell
 * @license   <https://github.com/GrahamCampbell/Bootstrap-CMS/blob/master/LICENSE.md> AGPL 3.0
 */
class AjaxDisplayer implements DisplayerInterface
{
    use InfoTrait;

    /**
     * Get the HTML content associated with the given exception.
     *
     * @param \Exception $exception
     * @param int        $code
     *
     * @return array
     */
    public function display(Exception $exception, $code)
    {
        $info = $this->info($code, $exception->getMessage());

        return ['success' => false, 'code' => $info['code'], 'msg' => $info['extra']];
    }
}
