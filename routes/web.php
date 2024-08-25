<?php

use App\Http\Controllers\GeneralFormController;
use Illuminate\Support\Facades\Route;


Route::get('/', [GeneralFormController::class, 'index'])->name('home');

Route::group(['as' => 'api.generalInformation.', 'prefix' => '/api/general-information'], function () {
    Route::controller(GeneralFormController::class)->group(function () {
        Route::post('/create', 'create')->name('create');
        Route::post('/{id}/update', 'update')->name('update');
        Route::delete('/{id}/delete', 'delete')->name('delete');
    });
});
