<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Trusted Proxies
    |--------------------------------------------------------------------------
    |
    | Set an array of trusted proxies, so Laravel knows to grab the client's
    | IP address via the X-Forwarded-* headers. To trust all proxies, use the
    | value '*', or to trust only specific proxies (recommended), set an array
    | of those proxies' IP addresses.
    |
    | By default, we are trusting CloudFlare only.
    |
    */

    'proxies' => [

        '204.93.240.0',
        '204.93.177.0',
        '199.27.128.0',
        '173.245.48.0',
        '103.21.244.0',
        '103.22.200.0',
        '103.31.4.0',
        '141.101.64.0',
        '108.162.192.0',
        '190.93.240.0',
        '188.114.96.0',
        '197.234.240.0',
        '198.41.128.0',
        '162.158.0.0',
        '2400:cb00::',
        '2606:4700::',
        '2803:f800::',
        '2405:b500::',
        '2405:8100::',

    ],

];
