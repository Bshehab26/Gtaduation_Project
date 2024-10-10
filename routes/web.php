<?php

use App\Http\Controllers\dashboard\{HomeController,
    CategoryController,UserController};
use App\Http\Controllers\EventController;
use App\Models\Event;
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

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group([ 'middleware' => ['auth', 'dashboard'] ], function(){ Route::prefix('dashboard')->group(function(){ Route::get('/', [HomeController::class, 'index'])->name('dashboard-home'); Route::resource('/categories', CategoryController::class)->except(['show']); Route::get('/categories/{name}', [CategoryController::class, 'show'])->name('categories.show'); }); });

    // Users Routes
    Route::resource('dashboard/users', UserController::class);
    Route::get('/user/customers', [UserController::class, 'customersIndex'])->name('users.customers');
    Route::get('/user/orginzers', [UserController::class, 'orginzersIndex'])->name('users.orginzers');
    Route::get('/user/moderators', [UserController::class, 'moderatorsIndex'])->name('users.moderators');
    Route::get('/user/admins', [UserController::class, 'adminsIndex'])->name('users.admins');
Route::get('/home', [HomeController::class, 'index'])
    ->name('home');

Route::redirect('/', '/home');

Route::group(['middleware' => ['auth', 'dashboard']], function(){

    Route::prefix('dashboard')->group(function() {

        Route::get('/', [HomeController::class, 'dashboard'])
            ->name('dashboard-home');
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




































Route::get('/events/create', function ($id) {
    return view('events.create');
});

Route::controller(EventController::class)->group(function () {

    Route::resource('/events', EventController::class)
        ->only(['index']);


    Route::get('/events/{event:slug}', 'show')
        ->name('events.show');

        //todo add admin and orgnizer middleware
    Route::group(['middleware' => 'auth'], function() {
        Route::resource('/events', EventController::class)->only(['create', 'store']);
    });

    Route::group(['middleware' => 'auth'], function() {
        Route::resource('/events', EventController::class)->only(['update']);
        Route::get('/events/{event:slug}/edit', 'edit')
            ->name('events.edit');
    });

});
