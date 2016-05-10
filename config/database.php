<?php

return [

    'redis' => getenv('REDIS_URL') ? [

        'cluster' => env('REDIS_CLUSTER', false),

        'default' => [
            'host'     => parse_url(getenv('REDIS_URL'), PHP_URL_HOST),
            'port'     => parse_url(getenv('REDIS_URL'), PHP_URL_PORT),
            'database' => env('REDIS_DATABASE', 0),
            'password' => parse_url(getenv('REDIS_URL'), PHP_URL_PASS),
        ],

    ] : [

        'cluster' => env('REDIS_CLUSTER', false),

        'default' => [
            'host'     => env('REDIS_HOST', '127.0.0.1'),
            'port'     => env('REDIS_PORT', 6379),
            'database' => env('REDIS_DATABASE', 0),
            'password' => env('REDIS_PASSWORD', null),
        ],

    ],

];

