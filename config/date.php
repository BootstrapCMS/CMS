<?php

/*
 * This file is part of Bootstrap CMS.
 *
 * (c) Graham Campbell <graham@cachethq.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [

    /*
    |--------------------------------------------------------------------------
    | PHP Format: NOTE this must be compatiable with the javascript date
    |--------------------------------------------------------------------------
    |
    | Take a look at http://php.net/manual/en/function.date.php
    |
    */

    'php_format' => 'd/m/Y H:i',

    /*
    |--------------------------------------------------------------------------
    | Javascript Format: NOTE this must be compatiable with the php date
    |--------------------------------------------------------------------------
    |
    | This is the format that the javascript datepicker needs
    |
    | D: Day without leading 0
    | DD: Day with leading 0
    | M: Month without leading 0
    | MM: Month with leading 0
    | YY: Year - 2 digits
    | YYYY: Year - 4 digits
    |
    | HH: 24 hour with leading 0
    | hh: 12 hour with leading 0
    | H: 24 hour without leading 0
    | h: 12 hour without leading 0
    | mm: minute with leading 0
    | m: minute with leading 0
    | A: AM/PM
    | a: am/pm
    |
    */

    'js_format' => 'D/M/YYYY HH:mm',

    /*
    |--------------------------------------------------------------------------
    | PHP Display Format
    |--------------------------------------------------------------------------
    |
    | Take a look at http://php.net/manual/en/function.date.php
    |
    */

    'php_display_format' => 'l jS F Y H:i',

];
