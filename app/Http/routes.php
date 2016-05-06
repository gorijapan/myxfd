<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', function () use ($app) {
    return $app->version();
});

$app->get('/ci/{flag}', function ($flag) use ($app) {
    $message = sprintf('posted: @%s@', time());
    $level   = $flag === 'failure' ? 'warning' : 'info';

    return app('log')->{$level}($message) ? $message : 0;
});

$app->post('/ci/{flag}', function ($flag) use ($app) {
    $message = sprintf('posted: @%s@', time());
    $level   = $flag === 'failure' ? 'warning' : 'info';

    return app('log')->{$level}($message) ? $message : 0;
});

$app->get('/xfd', function () use ($app) {
    $last = '';
    $fp   = fopen(storage_path('logs/lumen.log'), 'r');
    while($row = fgets($fp)) {
        $last = $row;
    }
    fclose($fp);

    return strpos($last, 'WARNING') !== false ? 1 : 2;
});

