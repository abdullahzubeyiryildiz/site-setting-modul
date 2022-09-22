<?php

use Illuminate\Support\Facades\Route;
use SettingModul\Controllers\SettingController;

Route::group([
    'prefix' => 'site/setting',
    'as' => 'setting.'
], function () {
    Route::get('/', [SettingController::class, 'index'])->name('index');

    Route::get('/{id}/edit', [SettingController::class, 'edit'])->name('edit');

    Route::post('/{id}/update', [SettingController::class, 'update'])->name('update');


    Route::get('/cerez/clear', [SettingController::class, 'index'])->name('cerez.clear');
});
