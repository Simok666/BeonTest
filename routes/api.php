<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Api\Penghuni\PenghuniController;
use App\Http\Controllers\Backend\Api\Rumah\RumahController;
use App\Http\Controllers\Backend\Api\PenghuniRumah\PenghuniRumahController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('V1')->group(function () {
    Route::apiResource('penghuni', PenghuniController::class);
    Route::apiResource('rumah', RumahController::class);
    Route::apiResource('penghuniRumah', PenghuniRumahController::class);
});