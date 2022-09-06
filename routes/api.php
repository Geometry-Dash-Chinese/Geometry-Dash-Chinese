<?php

use App\Http\Controllers\NGProxy\SongController;
use Illuminate\Support\Facades\Route;
use Tightenco\Ziggy\Ziggy;

Route::group([
    'as' => 'api.',
], static function () {
    Route::get('/routes', [Ziggy::class, 'toArray'])->name('ziggy.routes');

    Route::group([
        'domain' => 'ng.geometrydashchinese.com',
        'as' => 'ngproxy.',
    ], static function () {
        Route::get('/{id}/info', [SongController::class, 'info'])
            ->where('id', '\d+')
            ->name('info');

        Route::get('/{id}/object', [SongController::class, 'object'])
            ->where('id', '\d+')
            ->name('object');

        Route::get('/{id}/download', [SongController::class, 'download'])
            ->where('id', '\d+')
            ->name('download');
    });
});
