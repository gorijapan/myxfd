<?php

use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

define('CI_KEY',     'ci_result');
define('CI_SUCCESS', 'success');
define('CI_FAILURE', 'failure');


$app->put('/xfd', function () use ($app) {

    $flag = CI_SUCCESS;
    if (Redis::get(CI_KEY) === CI_FAILURE) {
        $flag = CI_FAILURE;
        Redis::set(CI_KEY, CI_SUCCESS);
    }

    return response()->json(['result' => $flag]);

});


$app->get('/ci', function () use ($app) {

    $flag = (Redis::get(CI_KEY) === CI_FAILURE) ? CI_FAILURE : CI_SUCCESS;

    return response()->json(['result' => $flag]);

});


$app->get('/ci/{flag}', function ($flag) use ($app) {

    if ($flag !== CI_SUCCESS && $flag !== CI_FAILURE) {
        return response()->json();
    }

    //Cache::forever(CI_KEY, $flag);
    Redis::set(CI_KEY, $flag);

    return response()->json(['result' => $flag]);

});


$app->put('/ci', function (Request $request) use ($app) {

    $flag = Arr::get($request->toArray(), 'flag', null);

    if ($flag !== CI_SUCCESS && $flag !== CI_FAILURE) {
        return response()->json();
    }

    Redis::set(CI_KEY, $flag);

    return response()->json(['result' => $flag]);

});

