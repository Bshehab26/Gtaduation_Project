<?php

use App\Http\Controllers\dashboard\{HomeController,
    CategoryController,UserController};
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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/',[HomeController::class,'index'])->name('dashboard-home');
// Route::resource('/dahboard/categories', CategoryController::class);
Route::redirect('/','/dashboard');
Route::prefix('dashboard')->group(function(){
    // Route::get('/',[HomeController::class,'index'])->middleware(['dashboard','auth']) ->name('dashboard-home');
    Route::get('/',[HomeController::class,'index'])->name('dashboard-home');
    Route::resource('/categories', CategoryController::class)->except('show');
    Route::get('/categories/{id}/{name?}',[CategoryController::class,'show'])->name('categories.show');
    Route::get('/category/trash', [CategoryController::class,'trash'])->name('categories.trash');
    Route::get('/category/restore/{id}', [CategoryController::class,'restore'])->name('categories.restore');
    Route::delete('/category/forceDelete/{id}', [CategoryController::class,'forceDelete'])->name('categories.forceDelete');

});
Route::delete('/categories/delete', [CategoryController::class,'destroyAll'])->name('categories.destroyAll');

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group([ 'middleware' => ['auth', 'dashboard'] ], function(){ Route::prefix('dashboard')->group(function(){ Route::get('/', [HomeController::class, 'index'])->name('dashboard-home'); Route::resource('/categories', CategoryController::class)->except(['show']); Route::get('/categories/{name}', [CategoryController::class, 'show'])->name('categories.show'); }); });

    // Users Routes
    Route::resource('/users', UserController::class);
    Route::get('/user/customers', [UserController::class, 'customersIndex'])->name('users.customers');
    Route::get('/user/moderators', [UserController::class, 'moderatorsIndex'])->name('users.moderators');
    Route::get('/user/admins', [UserController::class, 'adminsIndex'])->name('users.admins');
