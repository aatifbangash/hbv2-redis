<?php

use App\Http\Controllers\Hbv2RedisController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::group(['prefix' => '/redis'], function () {
        Route::get('/set', [Hbv2RedisController::class, 'setData']);
        Route::get('/get', [Hbv2RedisController::class, 'getData']);
    });
});

Route::get('/health-check', function () {
    return response()->json([
        'status' => 'ok',
        'message' => 'Application is healthy',
    ]);
});
