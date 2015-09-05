<?php

/*
 * This file is part of Bootstrap CMS.
 *
 * (c) Graham Campbell <graham@alt-three.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Path To The Form
    |--------------------------------------------------------------------------
    |
    | This defines the path to the contact form. This is the page where your
    | contact form should be.
    |
    | Default to 'pages/contact'.
    |
    */

    'path' => 'pages/contact',

    /*
    |--------------------------------------------------------------------------
    | Contact Form Email
    |--------------------------------------------------------------------------
    |
    | This defines the email address to send contact form messages to. It can
    | be a single address, or an array of email addresses.
    |
    | Default to 'admin@example.com'.
    |
    */

    'email' => env('CONTACT_EMAIL', 'admin@example.com'),

    /*
    |--------------------------------------------------------------------------
    | Email Layout
    |--------------------------------------------------------------------------
    |
    | This defines the layout to extend when building email views.
    |
    | Default to 'layouts.email'.
    |
    */

    'layout' => 'layouts.email',

];
