<?php

/*
|--------------------------------------------------------------------------
| Application Event Listeners
|--------------------------------------------------------------------------
|
| Here is where you can register all of the listeners for an application.
|
*/

Event::listen('page.load', function($pram1, $pram2 = null, $pram3 = null) {
    if (Config::get('log.pageload') == true) {
        Log::debug('Page Loading', array($pram1), array($pram2));
    }
});

Event::listen('artisan.start', function($pram1, $pram2 = null) {
    if (Config::get('log.artisanstart') == true) {
        Log::debug('Artisan Starting', array($pram1), array($pram2));
    }
});

Event::listen('illuminate.query', function($pram1, $pram2 = null) {
    if (Config::get('log.illuminatequery') == true) {
        Log::debug('Query Executed', array($pram1), array($pram2));
    }
});

Event::listen('eloquent.updating', function($pram1, $pram2 = null) {
    if (Config::get('log.eloquentupdating') == true) {
        Log::debug('Eloquent Updating', array($pram1), array($pram2));
    }
});

Event::listen('eloquent.updated', function($pram1, $pram2 = null) {
    if (Config::get('log.eloquentupdated') == true) {
        Log::debug('Eloquent Updated', array($pram1), array($pram2));
    }
});

Event::listen('eloquent.creating', function($pram1, $pram2 = null) {
    if (Config::get('log.eloquentcreating') == true) {
        Log::debug('Eloquent Creating', array($pram1), array($pram2));
    }
});

Event::listen('eloquent.created', function($pram1, $pram2 = null) {
    if (Config::get('log.eloquentcreated') == true) {
        Log::debug('Eloquent Created', array($pram1), array($pram2));
    }
});

Event::listen('locale.changed', function($pram1, $pram2 = null) {
    if (Config::get('log.localechanged') == true) {
        Log::debug('Locale Changed', array($pram1), array($pram2));
    }
});
