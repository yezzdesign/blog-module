<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::name('blog.')->group(function () {
    Route::group(['middleware' => ['auth'], 'prefix' => 'blog'], function () {

        Route::get('/',                 [\Modules\Blog\Http\Controllers\BlogController::class, 'index'])                ->name('backend.index');
        Route::get('/create',           [\Modules\Blog\Http\Controllers\BlogController::class, 'create'])               ->name('backend.create');
        Route::post('/create',          [\Modules\Blog\Http\Controllers\BlogController::class, 'store'])                ->name('backend.store');
        Route::get('/edit/{post}',      [\Modules\Blog\Http\Controllers\BlogController::class, 'edit' ])                ->name('backend.edit');
        Route::get('/update_status/{post}', [\Modules\Blog\Http\Controllers\BlogController::class, 'changeStatus'])     ->name('backend.status.update');
        Route::put('/update/{post}',    [\Modules\Blog\Http\Controllers\BlogController::class, 'update'])               ->name('backend.update');
        Route::delete('/delete/{post}', [\Modules\Blog\Http\Controllers\BlogController::class, 'destroy'])              ->name('backend.post.delete');

    });
});
