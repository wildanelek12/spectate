<?php

use App\Http\Controllers\Api\InvoiceController;
use App\Http\Controllers\Api\ItemController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

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
    'middleware' => 'api.key',
], function() {
    Route::resource('invoice', InvoiceController::class)->only(['index', 'store', 'show']);
    Route::get('invoice/check', [InvoiceController::class, 'check_invoice']);

    Route::resource('item', ItemController::class)->only('index', 'show');
});

Route::post('v1/invoice/callback', [InvoiceController::class, 'callBackInvoice']);
