<?php

use Illuminate\Support\Facades\Route;
use WestmSchools\HelloWizardOfOz\Http\QuotesController;

Route::middleware(['web', 'auth', 'can:administration'])->prefix('administration/hello-wizard-of-oz')->name('hello-wizard-of-oz.')->group(function () {
    Route::post('/', [QuotesController::class, 'update'])->name('update');
    Route::post('/reset', [QuotesController::class, 'reset'])->name('reset');
});
