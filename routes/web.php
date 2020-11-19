<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\FavouriteController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SiteController::class, 'index'])
    ->name('index');

Route::middleware('auth')
    ->group(
        function () {
            Route::resource('posts', PostController::class)
                ->except('index', 'show');

            Route::prefix('posts/{post}')
                ->group(
                    function () {
                        Route::resource('comments', CommentController::class)
                            ->only('store');

                        Route::put('favourite', FavouriteController::class);

                    }
                );
            Route::get('favourites', [FavouriteController::class, 'index'])
            ->name('user.favourites');

            Route::resource('comments', CommentController::class)
                ->only('destroy');
        }
    );


Route::resource('posts', PostController::class)
    ->only('index', 'show');
