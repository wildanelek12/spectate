<?php

use App\Http\Controllers\AdminApi\BuyerController;
use App\Http\Controllers\AdminApi\ItemController;
use App\Http\Controllers\AdminApi\QrCodeController;
use App\Http\Controllers\AdminApi\TicketController;
use App\Http\Controllers\AdminApi\TicketTypeController;
use App\Http\Controllers\AdminApi\TransactionController;
use App\Http\Controllers\AdminApi\TypeController;
use App\Models\PaymentMethod;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group([
    'prefix'     => 'v1',
    'middleware' => ['api.key'], // nanti tambahkan auth:api
], function() {
    Route::resource('buyer', BuyerController::class)->only(['index', 'show']);
    
    Route::resource('item', ItemController::class)->except('create', 'edit', 'update');
    Route::post('item/{item}', [ItemController::class, 'update'])->name('item.update');
    Route::post('item/quick-update/{item}', [ItemController::class, 'quick_update']);

    Route::resource('ticket', TicketController::class)->except('create', 'edit', 'update');
    Route::post('ticket/{ticket}', [TicketController::class, 'update'])->name('ticket.update');

    Route::resource('ticket-type', TicketTypeController::class)->except('create', 'edit', 'update');
    Route::post('ticket-type/{ticket_type}', [TicketTypeController::class, 'update'])->name('ticket-type.update');

    Route::resource('transaction', TransactionController::class)->only(['index', 'show']);

    Route::resource('type', TypeController::class)->except('create', 'edit', 'update');
    Route::post('type/{type}', [TypeController::class, 'update'])->name('type.update');

    Route::resource('payment-method', PaymentMethod::class)->except('create', 'edit', 'update');
    Route::post('payment-method/{payment_method}', [PaymentMethod::class, 'update'])->name('payment-method.update');

    Route::get('qr-code', [QrCodeController::class, 'index']);
    Route::post('qr-code/confirmation', [QrCodeController::class, 'confirmation']);
});
