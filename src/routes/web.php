<?php

use Illuminate\Support\Facades\Route;
use BachVendor\BachPackage\Http\Controllers\BachController;

Route::group(['middleware' => 'logs.crud'], function () {
    Route::get('/bach', [BachController::class,"index"]);
});
