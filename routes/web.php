<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;


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

Route::get('/payment',[WebController::class,'createPayment']);
Route::get('/admin/event', function () {
    return view('admin_page.pages.ticket');
})->name('ticket');

Route::get('/admin/tipe-tiket', function () {
    return view('admin_page.pages.ticket_types');
})->name('ticket_type');
Route::get('/admin/tiket', function () {
    return view('admin_page.pages.item');
})->name('item');
Route::get('/admin/buyer', function () {
    return view('admin_page.pages.buyer');
})->name('buyer');
Route::get('/admin/transaksi', function () {
    return view('admin_page.pages.invoice');
})->name('invoice');
Route::get('/admin/payment-method', function () {
    return view('admin_page.pages.payment_method');
})->name('payment_method');
Route::get('/admin', function () {
    return view('admin_page.pages.dashboard');
})->name('dashboard');

Route::get('/', function () {
    return view('index');
})->name('dashboardUser');

Route::get('/ticket', function () {
    return view('ticket_user');
})->name('ticketUser');

Route::get('/pending-payment', function () {
    return view('mail.pending_transaction');
})->name('pendingTransaction');
Route::get('/succes-payment', function () {
    return view('mail.succes_transaction');
})->name('succesTransaction');
