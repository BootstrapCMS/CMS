<?php

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
$styles[] = 'css/jasny-bootstrap.min.css';
$styles[] = 'css/font-awesome.min.css';
$styles[] = 'css/cms-main.css';

Asset::registerStyles($styles, '', 'main');

Asset::registerScripts(array(
    'js/jquery-1.10.2.min.js',
    'js/jquery.timeago.js',
    'js/cms-timeago.js',
    'js/cms-restfulizer.js',
    'js/bootstrap.min.js',
    'js/jasny-bootstrap.min.js',
    'js/cms-carousel.js'
), '', 'main');


Asset::registerStyles(array(
    'css/bootstrap-switch.css',
    'css/bootstrap-markdown.min.css'
), '', 'form');


Asset::registerScripts(array(
    'js/jquery.form.js',
    'js/bootstrap-switch.js',
    'js/bootstrap-markdown.js'
), '', 'form');


Asset::registerStyles(array(
    'css/bootstrap-datetimepicker.min.css'
), '', 'picker');


Asset::registerScripts(array(
    'js/moment.min.js',
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
