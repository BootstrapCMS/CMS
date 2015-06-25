<?php

/*
 * This file is part of Bootstrap CMS.
 *
 * (c) Graham Campbell <graham@alt-three.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
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

$styles = [];
if (Config::get('theme.name') == 'default') {
    $styles[] = 'css/bootstrap.min.css';
} elseif (Config::get('theme.name') == 'legacy') {
    $styles[] = 'css/bootstrap.min.css';
    $styles[] = 'css/bootstrap-theme.min.css';
} else {
    $styles[] = 'css/bootstrap.'.Config::get('theme.name').'.min.css';
}
$styles[] = 'css/cms-main.css';
if (Config::get('laravel-debugbar::enabled')) {
    $styles[] = 'maximebf\debugbar\src\DebugBar\Resources\vendor\highlightjs\styles\github.css';
}

Asset::registerStyles($styles, '', 'main');

$scripts = [
    'js/cms-timeago.js',
    'js/cms-restfulizer.js',
    'js/cms-carousel.js',
    'js/cms-alerts.js',
];
if (Config::get('laravel-debugbar::enabled')) {
    $scripts[] = 'maximebf\debugbar\src\DebugBar\Resources\vendor\highlightjs\highlight.pack.js';
}

Asset::registerScripts($scripts, '', 'main');

Asset::registerScripts([
    'js/cms-picker.js',
], '', 'picker');

Asset::registerScripts([
    'js/cms-comment-core.js',
    'js/cms-comment-edit.js',
    'js/cms-comment-delete.js',
    'js/cms-comment-create.js',
    'js/cms-comment-fetch.js',
    'js/cms-comment-main.js',
], '', 'comment');
