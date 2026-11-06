<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KitchenController;
use App\Http\Controllers\CashController;

/*
|--------------------------------------------------------------------------
| Auth
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

/*
|--------------------------------------------------------------------------
| Application (requires login)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // ---- Read pages: all roles ----
    Route::get('/', [PageController::class, 'dashboard']);
    Route::get('/reservation', [PageController::class, 'reservation']);
    Route::get('/housekeeping', [PageController::class, 'housekeeping']);
    Route::get('/inventory', [PageController::class, 'inventory']);
    Route::get('/calendar', [PageController::class, 'calendar']);
    Route::get('/guest-profile', [PageController::class, 'guestProfile']);

    // ---- Kitchen: everyone can see the page and ring up an order ----
    Route::get('/kitchen', [KitchenController::class, 'index']);
    Route::post('/kitchen', [KitchenController::class, 'store']);

    // Keeps the session fresh for open tabs and hands back the current CSRF token.
    Route::get('/session/ping', fn () => response()->json(['token' => csrf_token()]));

    // ---- Own account: all roles ----
    Route::post('/profile', [ProfileController::class, 'update']);
    Route::post('/profile/password', [ProfileController::class, 'password']);

    // ---- Operational actions: all roles ----
    Route::post('/bookings/{id}/confirm', [PageController::class, 'bookingConfirm']);
    Route::post('/bookings/{id}/status/{status}', [PageController::class, 'bookingStatus']);
    Route::post('/housekeeping/{id}', [PageController::class, 'hkUpdate']);
    Route::post('/inventory/{id}/add-stock', [PageController::class, 'invAddStock']);
    Route::post('/inventory/{id}/use-stock', [PageController::class, 'invUseStock']);
    Route::post('/tasks/{id}/toggle', [PageController::class, 'taskToggle']);

    // ---- Admin + Manager: restricted pages + create/edit ----
    Route::middleware('role:admin,manager')->group(function () {
        Route::get('/rooms', [PageController::class, 'rooms']);
        Route::get('/invoice', [PageController::class, 'invoice']);
        Route::get('/expenses', [PageController::class, 'expenses']);
        Route::get('/reviews', [PageController::class, 'reviews']);
        Route::get('/concierge', [PageController::class, 'concierge']);

        Route::post('/bookings', [PageController::class, 'bookingStore']);
        Route::put('/bookings/{id}', [PageController::class, 'bookingUpdate']);
        Route::put('/expenses/{id}', [PageController::class, 'expenseUpdate']);
        Route::put('/concierge/{id}', [PageController::class, 'conciergeUpdate']);
        Route::put('/inventory/{id}', [PageController::class, 'invUpdate']);
        Route::put('/schedules/{id}', [PageController::class, 'scheduleUpdate']);
        Route::put('/housekeeping/{id}', [PageController::class, 'hkEdit']);
        Route::post('/rooms', [PageController::class, 'roomStore']);
        Route::put('/rooms/{id}', [PageController::class, 'roomUpdate']);
        Route::post('/rooms/{id}/units', [PageController::class, 'unitStore']);
        Route::post('/room-units/{id}/status', [PageController::class, 'unitStatus']);
        Route::post('/inventory/{id}/settings', [PageController::class, 'invSettings']);
        Route::post('/expenses', [PageController::class, 'expenseStore']);
        Route::get('/expenses/export/pdf', [PageController::class, 'expenseReportPdf']);
        Route::get('/expenses/{id}/download', [PageController::class, 'expenseDownload']);
        Route::post('/concierge', [PageController::class, 'conciergeStore']);
        Route::post('/housekeeping', [PageController::class, 'hkStore']);
        Route::post('/inventory', [PageController::class, 'invStore']);
        Route::post('/schedules', [PageController::class, 'scheduleStore']);
        Route::post('/tasks', [PageController::class, 'taskStore']);
        Route::post('/reviews', [PageController::class, 'reviewStore']);
        Route::post('/invoices/{id}/toggle', [PageController::class, 'invoiceToggle']);
        Route::get('/invoices/{id}/download', [PageController::class, 'invoiceDownload']);
        Route::put('/kitchen/{id}', [KitchenController::class, 'update']);
        // ---- Cash wallets: petty top-ups, transfers, cash out, and re-filing expenses ----
        Route::post('/cash', [CashController::class, 'store']);
        Route::get('/cash/report', [CashController::class, 'report']);
        Route::post('/expenses/paid-from', [CashController::class, 'reassign']);
        Route::post('/kitchen/{id}/paid', [KitchenController::class, 'togglePaid']);
    });

    // ---- Admin only: deletes ----
    Route::middleware('role:admin')->group(function () {
        Route::delete('/bookings/{id}', [PageController::class, 'bookingDestroy']);
        Route::delete('/rooms/{id}', [PageController::class, 'roomDestroy']);
        Route::delete('/expenses/{id}', [PageController::class, 'expenseDestroy']);
        Route::delete('/concierge/{id}', [PageController::class, 'conciergeDestroy']);
        Route::delete('/housekeeping/{id}', [PageController::class, 'hkDestroy']);
        Route::delete('/schedules/{id}', [PageController::class, 'scheduleDestroy']);
        Route::delete('/reviews/{id}', [PageController::class, 'reviewDestroy']);
        Route::delete('/inventory/{id}', [PageController::class, 'invDestroy']);
        Route::delete('/room-units/{id}', [PageController::class, 'unitDestroy']);
        Route::delete('/kitchen/{id}', [KitchenController::class, 'destroy']);
        Route::delete('/cash/{id}', [CashController::class, 'destroy']);

        // ---- Team accounts ----
        Route::get('/users', [UserController::class, 'index']);
        Route::post('/users', [UserController::class, 'store']);
        Route::put('/users/{id}', [UserController::class, 'update']);
        Route::post('/users/{id}/password', [UserController::class, 'password']);
        Route::delete('/users/{id}', [UserController::class, 'destroy']);
    });
});
