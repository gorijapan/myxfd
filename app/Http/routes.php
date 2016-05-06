<?php

use Illuminate\Support\Arr;

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
    $client = new \Predis\Client();
    return $client->get('ci_result');
});

$app->get('/ci/{flag}', function ($flag) use ($app) {
    if (!($flag === 'success' || $flag === 'failure')) {
        return;
    }

    $client = new \Predis\Client();
    $client->set('ci_result', $flag);

    return $client->get('ci_result');
});

$app->post('/ci/{flag}', function ($flag) use ($app) {

    $flag = Arr::get($request->toArray(), 'flag', null);
    if (!($flag === 'success' || $flag === 'failure')) {
        return;
    }

    $client = new \Predis\Client();
    $client->set('ci_result', $flag);

    return $client->get('ci_result');
});

