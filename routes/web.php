<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'setting',
    'as' => 'setting.'
], function () {
    Route::get('/', [\Digitalcake\SystemSetting\Controllers\HolidayController::class, 'index'])->name('index');

    Route::post('/setting', [\pratikyazilimci\SystemSetting\Controllers\HolidayController::class, 'store'])->name('store');
});
