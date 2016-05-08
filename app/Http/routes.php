<?php

use Illuminate\Support\Arr;
use Illuminate\Http\Request;

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
define('CI_SUCCESS', 'success');
define('CI_FAILURE', 'failure');

$app->get('/xfd/{param}', function ($param) use ($app) {
    $client = new \Predis\Client(config('database.redis'));
    $result = $client->get('ci_result');
    $result === CI_FAILURE and $client->set('ci_result', CI_SUCCESS);

    return response()->json(['result' => $result, 'time' => time()]);
});

$app->get('/status-check', function () use ($app) {
    $client = new \Predis\Client(config('database.redis'));
    $result = $client->get('ci_result');

    return response()->json(['result' => $result, 'time' => time()]);
});

$app->get('/ci/{flag}', function ($flag) use ($app) {
    if ($flag !== CI_SUCCESS && $flag !== CI_FAILURE) {
        return response()->json();
    }

    $client = new \Predis\Client(config('database.redis'));
    $client->set('ci_result', $flag);

    return response()->json(['result' => $client->get('ci_result'), 'time' => time()]);
});

$app->post('/ci', function (Request $request) use ($app) {
    $flag = Arr::get($request->toArray(), 'flag', null);
    if ($flag !== CI_SUCCESS && $flag !== CI_FAILURE) {
        return response()->json();
    }

    $client = new \Predis\Client(config('database.redis'));
    $client->set('ci_result', $flag);

    return response()->json(['result' => $client->get('ci_result'), 'time' => time()]);
});

