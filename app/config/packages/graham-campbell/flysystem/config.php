<?php

/**
 * This file is part of Laravel Flysystem by Graham Campbell.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

return array(

    /*
    |--------------------------------------------------------------------------
    | Default Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the connections below you wish to use as
    | your default connection for all work. Of course, you may use many
    | connections at once using the manager class.
    |
    */

    'default' => 'local',

    /*
    |--------------------------------------------------------------------------
    | Database Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the connections setup for your application. Examples of
    | configuring each supported driver is shown below. You can of course have
    | multiple connections per driver.
    |
    */

    'connections' => array(

        'local' => array(
            'driver' => 'local',
            'path'   => storage_path('files')
        ),

        'zip' => array(
            'driver' => 'zip',
            'path'   => storage_path('files.zip')
        ),

        'awss3' => array(
            'driver' => 'awss3',
            'key'    => 'your-key',
            'secret' => 'your-secret',
            'bucket' => 'your-bucket',
            // 'region' => 'your-region',
            // 'prefix' => 'your-prefix'
        ),

        'dropbox' => array(
            'driver' => 'dropbox',
            'token'  => 'your-token',
            'app'    => 'your-app',
            // 'prefix' => 'your-prefix'
        ),

        'ftp' => array(
            'driver' => 'ftp',
            'host' => 'ftp.example.com',
            'port' => 21,
            'username' => 'your-username',
            'password' => 'your-password',
            // 'root' => '/path/to/root',
            // 'passive' => true,
            // 'ssl' => true,
            // 'timeout' => 20
        ),

        'sftp' => array(
            'driver' => 'sftp',
            'host' => 'sftp.example.com',
            'port' => 22,
            'username' => 'your-username',
            'password' => 'your-password',
            // 'privateKey' => 'path/to/or/contents/of/privatekey',
            // 'root' => '/path/to/root',
            // 'timeout' => 20
        ),

        'webdav' => array(
            'driver' => 'webdav',
            'baseUri' => 'http://example.org/dav/',
            'userName' => 'your-username',
            'password' => 'your-password'
        )

    )

);
