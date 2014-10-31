<?php

/**
 * This file is part of Laravel Credentials by Graham Campbell.
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
    | Enable Public Registration
    |--------------------------------------------------------------------------
    |
    | This defines if public registration is allowed.
    |
    | Default to true.
    |
    */

    'regallowed' => true,

    /*
    |--------------------------------------------------------------------------
    | Require Account Activation
    |--------------------------------------------------------------------------
    |
    | This defines if public registration requires email activation.
    |
    | Default to true.
    |
    */

    'activation' => true,

    /*
    |--------------------------------------------------------------------------
    | Revision Model
    |--------------------------------------------------------------------------
    |
    | This defines the revision model to be used.
    |
    | Default: 'GrahamCampbell\Credentials\Models\Revision'
    |
    */

    'revision' => 'GrahamCampbell\Credentials\Models\Revision',

];
