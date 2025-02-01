<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\supportTicketController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('store-data', [HomeController::class, 'store']);
Route::post('search-ref', [HomeController::class, 'searchByRef']);

Route::get('/dashboard', [supportTicketController::class, 'allTickets'])->middleware('auth')->name('dashboard');
Route::post('/ticketList', [SupportTicketController::class, 'allTicketDetails']);
Route::post('/ticketSearchByCustomer', [supportTicketController::class, 'ticketSearchByCustomer']);
Route::get('/view/{ticket_id}', [supportTicketController::class, "view"])->name('ticket.view');
Route::delete('/ticket/delete/{id}', [SupportTicketController::class, 'deleteTicket'])->name('ticket.delete');

// Reply
Route::post('view/store-reply', [SupportTicketController::class, 'storeReply'])->name('store.reply');

