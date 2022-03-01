<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\OperateurController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UtilisateurController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Models\Ticket;

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

Route::get('/', function () {
    return redirect("ticket");
})->name("index");

Route::get('login', [LoginController::class, "displayLogin"])->name("login.view");
Route::post('login', [LoginController::class, "login"])->name("login");

Route::middleware("auth")->group(function () {
    Route::get('ticket', [UserController::class, "displayUserTicket"])->name("userTicket");
    Route::get('detailTicket', [UserController::class, 'displayTicket'])->name("detailUserTicket");

    Route::get('ticketOperateur', [OperateurController::class, "DisplayTicketOperateur"])->name("ticketOperateur");

    Route::get('ticketSaisiUser', function () {
        return Inertia::render("ticketSaisiUser");
    })->name("ticketSaisiUser");
    Route::post('addTicket', [UserController::class, 'addTicket'])->name("addTicket");
});
