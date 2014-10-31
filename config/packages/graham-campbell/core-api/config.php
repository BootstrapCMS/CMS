<?php

/**
 * This file is part of Laravel Core API by Graham Campbell.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at http://bit.ly/UWsjkb.
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Cache Time
    |--------------------------------------------------------------------------
    |
    | This option defines the time in minutes to cache API requests.
    | Setting it to 0 will disable caching. Normally, only GET requests are
    | cached, however as a last parameter in requests, you may override this
    | and ask other methods to be cached too. You may of course override a GET
    | call with a custom cache time of your choosing. If the force no cache
    | setting is enabled, this setting will be ignored.
    |
    | If you which to take advantage of caching, you should set this to to a
    | value above 2. 15 minutes might be a good value.
    |
    | Default: 0
    |
    */

    'cache' => 0,

    /*
    |--------------------------------------------------------------------------
    | Force No Cache
    |--------------------------------------------------------------------------
    |
    | This option defines if the caching should be forced off when the cache
    | time is set to 0. This will ignore all overrides that would work before.
    |
    | If you which to take advantage of caching, you MUST set this to false.
    |
    | Default: true
    |
    */

    'force' => true,

];
