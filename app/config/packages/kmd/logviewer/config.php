<?php

return array(
    
    'base_url' => 'logviewer',
    'filters'  => array(
        'global' => array(),
        'view'   => array(),
        'delete' => array(),
    ),
    'log_dirs' => array('app' => storage_path().'/logs'),
    'log_order' => 'desc',
    'per_page' => 20,
    'view'     => 'log',
    
);
