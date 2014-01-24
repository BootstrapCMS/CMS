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

/*
|--------------------------------------------------------------------------
| Application Assets
|--------------------------------------------------------------------------
|
| Here is where you can register all of the assets for an application.
| This leverages the power of lightgear/asset.
|
*/


$styles = array();
if (Config::get('theme.name') == 'default') {
    $styles[] = 'css/bootstrap.min.css';
} elseif (Config::get('theme.name') == 'legacy') {
    $styles[] = 'css/bootstrap.min.css';
    $styles[] = 'css/bootstrap-theme.min.css';
} else {
    $styles[] = 'css/bootstrap.'.Config::get('theme.name').'.min.css';
}
$styles[] = 'css/cms-main.css';

Asset::registerStyles($styles, '', 'main');

Asset::registerScripts(array(
    'js/cms-timeago.js',
    'js/cms-restfulizer.js',
    'js/cms-carousel.js'
), '', 'main');


Asset::registerStyles(array(
    'css/bootstrap-switch.css',
    'css/bootstrap-markdown.min.css'
), '', 'form');


Asset::registerScripts(array(
    'js/bootstrap-switch.js',
    'js/bootstrap-markdown.js'
), '', 'form');


Asset::registerStyles(array(
    'css/bootstrap-datetimepicker.min.css'
), '', 'picker');


Asset::registerScripts(array(
    'js/bootstrap-datetimepicker.min.js',
    'js/cms-picker.js'
), '', 'picker');


Asset::registerScripts(array(
    'js/cms-comment-core.js',
    'js/cms-comment-edit.js',
    'js/cms-comment-delete.js',
    'js/cms-comment-create.js',
    'js/cms-comment-fetch.js',
    'js/cms-comment-main.js'
), '', 'comment');
