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

$app->get('/ci/success', function () use ($app) {
    $msg = sprintf('posted: @%s@', time());
    return app('log')->info($msg) ? $msg : $app->version();
});

$app->post('/ci/success', function () use ($app) {
    $msg = sprintf('posted: @%s@', time());
    return app('log')->info($msg) ? $msg : $app->version();
});

$app->get('/ci/failure', function () use ($app) {
    $msg = sprintf('posted: @%s@', time());
    return app('log')->warning($msg) ? $msg : $app->version();
});

$app->post('/ci/failure', function () use ($app) {
    $msg = sprintf('posted: @%s@', time());
    return app('log')->warning($msg) ? $msg : $app->version();
});

$app->get('/xfd', function () use ($app) {
    $data = '';
    $fp   = fopen(storage_path('logs/lumen.log'), 'r');
    while($row = fgets($fp)) {
        $data = $row;
    }
    fclose($fp);

    return strpos($data, 'WARNING') !== false ? 1 : 2;
});

