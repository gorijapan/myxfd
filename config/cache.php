<?php

return [

    'default' => env('CACHE_DRIVER', 'redis'),

    'stores' => [

        'redis' => [
            'driver' => 'redis',
            'connection' => env('CACHE_REDIS_CONNECTION', 'default'),
        ],

    ],

    'prefix' => env('CACHE_PREFIX', 'laravel'),

];
