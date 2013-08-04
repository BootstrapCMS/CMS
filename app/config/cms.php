<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Site Name
    |--------------------------------------------------------------------------
    |
    | This is the name of your site. It will appear in the title head element
    | of every page and on the navigation bar. Additionally, it will appear on
    | all error pages and in emails.
    |
    */

    'name' => 'Bootstrap CMS',

    /*
    |--------------------------------------------------------------------------
    | Enable Public Registration
    |--------------------------------------------------------------------------
    |
    | This defines if public registration is allowed.
    |
    | Requires mail.php to be configured.
    | Default to true. 
    |
    */

    'regallowed' => true,

    /*
    |--------------------------------------------------------------------------
    | Require Email Verification On Registration
    |--------------------------------------------------------------------------
    |
    | This defines if public registration requires email activation.
    |
    | Requires mail.php to be configured.
    | Default to true. 
    |
    */

    'regemail' => true,

    /*
    |--------------------------------------------------------------------------
    | Use In Memory Caching
    |--------------------------------------------------------------------------
    |
    | This defines if we can cache some of our pages and SQL data in memory.
    |
    | Requires a caching server like Redis and cache.php to be configured.
    | Default to true.
    |
    */

    'cache' => true,

    /*
    |--------------------------------------------------------------------------
    | CSS Theme
    |--------------------------------------------------------------------------
    |
    | This defines what theme of Bootstrap to use from bootswatch.com.
    |
    | Supported: "amelia", "cerulean", "cosmo", "cyborg", "default", "flatly",
    |            "journal", "readable", "simplex", "slate", "spacelab", "spruce",
    |            "superhero", "united"
    |
    | Default to "default".
    |
    */

    'theme' => 'default',

);
