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
     * The paths where the assets will be searched in, relative to the project.
     */
    'search_paths' => [
        '/vendor',
        '/resources/assets',
    ],

    /*
     * The directory, relative to "public" where the assets will be published to.
     */
    'public_dir' => 'assets',

    /*
     * Turn on/off assets minification.
     */
    'minify' => false,

    /*
     * The patterns for minified assets.
     *
     * If an asset filename contains one of these patterns, then it will be
     * considered already minified and skip the minification process.
     */
    'minify_patterns' => ['-min.', '.min.'],

    /*
     * Turn on/off assets caching.
     */
    'use_cache' => true,

];
