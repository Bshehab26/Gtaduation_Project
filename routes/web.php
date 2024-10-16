<?php


use App\Http\Controllers\dashboard\{
    HomeController,
    CategoryController,
    UserController,
    VenueController as DashboardVenueController,
    EventController as DashboardEventController,
    SubcategoryController as DashboardSubcategoryController,
};

use App\Http\Controllers\{
    EventController,
    TicketController,
    VenueController,
};
use App\Models\Venue;
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
Route::group([
     'middleware' => ['auth', 'dashboard']
], function(){
    Route::prefix('dashboard')->group(function(){
        Route::get('/', [HomeController::class, 'index'])->name('dashboard-home');
        Route::resource('/categories', CategoryController::class)->except(['show']);
        Route::get('/categories/{name}', [CategoryController::class, 'show'])->name('categories.show');
    });
});

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

        // Tickets Routes
        Route::resource('/tickets', TicketController::class)->except(['create']);
        Route::get('/ticket/create/{id}', [TicketController::class, 'createTicket'])->name('ticket.create');
        Route::post("/tickets", [TicketController::class, 'store'])->name("tickets.store");
        Route::get("/tickets/{id}", [TicketController::class, 'show'])->name("tickets.show");
        Route::get("/tickets/{id}/edit", [TicketController::class, 'edit'])->name("tickets.edit");
        Route::put("/tickets/{id}", [TicketController::class, 'update'])->name("tickets.update");
        Route::delete("/tickets/{id}", [TicketController::class, 'destroy'])->name("tickets.destroy");
        Route::get('/ticket/status/{id}', [TicketController::class, 'ticketStatus'])->name('ticket-status.index');
        Route::get('/ticket/{id}', [TicketController::class, 'ticketDecrease'])->name('decrease-no-ticket');
        });
});

// Route::get('/venues', [VenueController::class, 'index'])->name('venues-user.index');

Route::resource('/venues-user', VenueController::class);
Route::resource('/venues', DashboardVenueController::class);
































Route::controller(EventController::class)->group(function () {

    Route::resource('/events', EventController::class)
        ->only(['index']);

    Route::group(['middleware' => 'auth'], function() {
        Route::get('/events/create', 'create')
            ->name('events.create');
        Route::get('/events/{event:slug}/edit', 'edit')
            ->name('events.edit');
    });

    Route::get('/events/{event:slug}', 'show')
        ->name('events.show');

    Route::group(['middleware' => 'auth'], function() {
    });

});

Route::name('dashboard.')
    ->middleware(['auth', 'dashboard'])
    ->group(function() {
        Route::prefix('/dashboard')->group(function(){
            Route::get('/events/trashed', [DashboardEventController::class, 'trash'])
                ->name('events.trash');

            Route::resource('/events', DashboardEventController::class)
                ->except(['edit', 'destroy', 'show']);

            Route::get('/events/{event:slug}', [DashboardEventController::class, 'show'])
                ->name('events.show');

            Route::get('/events/{event:slug}/edit', [DashboardEventController::class, 'edit'])
                ->name('events.edit');

            Route::delete('/events/{event:slug}', [DashboardEventController::class, 'destroy'])
                ->name('events.destroy');

            Route::post('/events/{id}/restore', [DashboardEventController::class, 'restore'])
                ->name('events.restore');

            Route::delete('/events/{id}/force', [DashboardEventController::class, 'forceDelete'])
                ->name('events.forceDelete');

        }
    );
});

Route::name('dashboard.')
    ->middleware(['auth', 'dashboard'])
    ->group(function() {
        Route::prefix('/dashboard')->group(function(){
            Route::get('/subcategories/trashed', [DashboardSubcategoryController::class, 'trash'])
                ->name('subcategories.trash');

            Route::resource('/subcategories', DashboardSubcategoryController::class)
                ->except(['edit', 'destroy', 'show']);

            Route::get('/subcategories/{name}', [DashboardSubcategoryController::class, 'show'])
                ->name('subcategories.show');

            Route::get('/subcategories/{name}/edit', [DashboardSubcategoryController::class, 'edit'])
                ->name('subcategories.edit');

            Route::delete('/subcategories/{name}', [DashboardSubcategoryController::class, 'destroy'])
                ->name('subcategories.destroy');

            Route::post('/subcategories/{id}/restore', [DashboardSubcategoryController::class, 'restore'])
                ->name('subcategories.restore');

            Route::delete('/subcategories/{id}/force', [DashboardSubcategoryController::class, 'forceDelete'])
                ->name('subcategories.forceDelete');

        }
    );
});
