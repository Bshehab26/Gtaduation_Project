<?php


use App\Http\Controllers\dashboard\{
    HomeController,
    CategoryController,
    UserController,
    VenueController as DashboardVenueController,
    EventController as DashboardEventController,
    SubcategoryController as DashboardSubcategoryController,
    TicketController as DashboardTicketController,
};

use App\Http\Controllers\{
    BookingController,
    EventController,
    TicketController,
    VenueController,
    UserController as WebUserController,
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
], function () {
    Route::prefix('dashboard')->group(function () {
        Route::get('/', [HomeController::class, 'index'])->name('dashboard-home');
        Route::resource('/categories', CategoryController::class)->except(['show']);
        Route::get('/categories/{name}', [CategoryController::class, 'show'])->name('categories.show');
    });
});

// Users Routes
Route::resource('dashboard/users', UserController::class);
Route::get('/user/customers', [UserController::class, 'customersIndex'])->name('users.customers');
Route::get('/user/organizers', [UserController::class, 'organizersIndex'])->name('users.organizers');
Route::get('/user/moderators', [UserController::class, 'moderatorsIndex'])->name('users.moderators');
Route::get('/user/admins', [UserController::class, 'adminsIndex'])->name('users.admins');
//Users Profile Routes
//Show User Profile
Route::get('/profiles/{id}', [WebUserController::class, 'show'])->name('webusers.show');
//Update User Profile
Route::put('/profiles/{id}', [WebUserController::class, 'update'])->name('webusers.update');

//edit User Profile
Route::get('/profiles/{id}/edit', [WebUserController::class, 'edit'])->name('webusers.edit');
Route::redirect('/', '/home');

Route::get('/home', [HomeController::class, 'index'])
    ->name('home');


Route::group(['middleware' => ['auth', 'dashboard']], function () {

    Route::prefix('dashboard')->group(function () {

        Route::get('/', [HomeController::class, 'dashboard'])
            ->name('dashboard-home');

        Route::resource('/categories', CategoryController::class)
            ->except(['show']);

        Route::get('/categories/{name}', [CategoryController::class, 'show'])
            ->name('categories.show');

        Route::get('/category/trash', [CategoryController::class, 'trash'])
            ->name('categories.trash');

        Route::get('/category/restore/{id}', [CategoryController::class, 'restore'])
            ->name('categories.restore');

        Route::delete('/category/forceDelete/{id}', [CategoryController::class, 'forceDelete'])
            ->name('categories.forceDelete');

        Route::delete('/categories/delete', [CategoryController::class, 'destroyAll'])
            ->name('categories.destroyAll');
    });
});

// Tickets Routes Dashboard
Route::group(['middleware' => ['auth', 'dashboard']], function(){
    Route::prefix('dashboard')->group(function() {
        Route::resource("/tickets", DashboardTicketController::class)->except("create");
        Route::get('/ticket/create/{id}', [DashboardTicketController::class, 'createTicket'])->name('ticket.create');
        Route::get('/ticket/status/{id}', [DashboardTicketController::class, 'ticketStatus'])->name('ticket-status.index');
        Route::resource('/venues', DashboardVenueController::class);
    });
});
// Tickets Routes Website
Route::group(['middleware' => ['auth', 'NoCustomer']], function(){
        Route::resource("/ticketss", TicketController::class)->except("create", "index");
        Route::get('/ticket/create/{id}', [TicketController::class, 'createTicket'])->name('ticket-organizer.create');
        Route::get('/ticket/status/{id}', [TicketController::class, 'ticketStatus'])->name('ticket-status-organizer.index');
});



// Venues Routes
Route::resource('/venues-user', VenueController::class); //->except(['store','edit','update','destory','create']);

Route::get('/search/venue', [VenueController::class, 'searchVenues'])->name('search.venue');

Route::resource('/bookings', BookingController::class, ['middleware' => 'auth']);


//************************************************* */


Route::controller(EventController::class)->group(function () {

    Route::resource('/events', EventController::class)
        ->only(['index']);

    Route::group(['middleware' => 'auth', 'dashboard', 'organizer'], function () {

        Route::get('/events/create', 'create')
            ->name('events.create');

        Route::get('/events/{event:slug}/edit', 'edit')
            ->name('events.edit');
    });

    Route::get('/events/{event:slug}', 'show')
        ->name('events.show');
});

//dashboard for EVENTS
Route::name('dashboard.')
    ->middleware(['auth', 'dashboard'])
    ->group(function () {
        Route::prefix('/dashboard')->group(
            function () {
                Route::get('/events/trashed', [DashboardEventController::class, 'trash'])
                    ->name('events.trash');

                Route::resource('/events', DashboardEventController::class)
                    ->except(['edit', 'destroy', 'show']);

                Route::get('/events/{event:slug}', [DashboardEventController::class, 'show'])
                    ->name('events.show');

                Route::get('/events/{event:slug}/edit', [DashboardEventController::class, 'edit'])
                    ->middleware(['admin'])
                    ->name('events.edit');

                Route::delete('/events/{event:slug}', [DashboardEventController::class, 'destroy'])
                    ->middleware(['admin'])
                    ->name('events.destroy');

                Route::post('/events/{id}/restore', [DashboardEventController::class, 'restore'])
                    ->middleware(['admin'])
                    ->name('events.restore');

                Route::delete('/events/{id}/force', [DashboardEventController::class, 'forceDelete'])
                    ->middleware(['admin'])
                    ->name('events.forceDelete');
            }
        );
    });

// dashboard for SUBCATEGORIES
Route::name('dashboard.')
    ->middleware(['auth', 'dashboard'])
    ->group(function () {
        Route::prefix('/dashboard')->group(
            function () {
                Route::get('/subcategories/trashed', [DashboardSubcategoryController::class, 'trash'])
                    ->name('subcategories.trash');

                Route::resource('/subcategories', DashboardSubcategoryController::class)
                    ->except(['edit', 'destroy', 'show']);

                Route::get('/subcategories/{name}', [DashboardSubcategoryController::class, 'show'])
                    ->name('subcategories.show');

                Route::get('/subcategories/{name}/edit', [DashboardSubcategoryController::class, 'edit'])
                    ->middleware(['admin'])
                    ->name('subcategories.edit');

                Route::delete('/subcategories/{name}', [DashboardSubcategoryController::class, 'destroy'])
                    ->middleware(['admin'])
                    ->name('subcategories.destroy');

                Route::post('/subcategories/{id}/restore', [DashboardSubcategoryController::class, 'restore'])
                    ->middleware(['admin'])
                    ->name('subcategories.restore');

                Route::delete('/subcategories/{id}/force', [DashboardSubcategoryController::class, 'forceDelete'])
                    ->middleware(['admin'])
                    ->name('subcategories.forceDelete');
            }
        );
    });
