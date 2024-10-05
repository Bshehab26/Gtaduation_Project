<?php

use App\Http\Controllers\dashboard\{
    HomeController,
    CategoryController
};
use App\Http\Controllers\{
    EventController,
};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Auth::routes();

Route::get('/home', [HomeController::class, 'index'])
    ->name('home');

Route::redirect('/', '/home');

Route::group(['middleware' => ['auth', 'dashboard']], function(){

    Route::prefix('dashboard')->group(function() {

        Route::get('/', [HomeController::class, 'dashboard'])
            ->name('dashboard-home');

        Route::resource('/categories', CategoryController::class)
            ->except(['show']);

        Route::get('/categories/{name}', [CategoryController::class, 'show'])
            ->name('categories.show');

        Route::get('/category/trash', [CategoryController::class,'trash'])
            ->name('categories.trash');

        Route::get('/category/restore/{id}', [CategoryController::class,'restore'])
            ->name('categories.restore');

        Route::delete('/category/forceDelete/{id}', [CategoryController::class,'forceDelete'])
            ->name('categories.forceDelete');

        Route::delete('/categories/delete', [CategoryController::class,'destroyAll'])
            ->name('categories.destroyAll');

    });
});










































// THIS LINE SHOULD BE AT EXACTLY 100, OTHERWISE IT MAY CAUSE A CONFLICT
Route::controller(EventController::class)->group(function () {

    Route::resource('/events', EventController::class)
        ->only(['index', 'show']);

    Route::get('/events/{event:slug}', 'show')
        ->name('events.show');

        //todo add admin and orgnizer middleware
    Route::middleware(['auth'])->group(fn() => Route::resource('/events', EventController::class)->only(['create', 'store']));

    Route::middleware(['auth'])->group(fn() => Route::resource('/events', EventController::class)->only(['edit', 'update']));

});
