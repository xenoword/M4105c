<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CommunController;
use App\Http\Controllers\OperateurController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\UtilisateurController;
use App\Models\TypeUser;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Models\Ticket;
use PHPUnit\TextUI\XmlConfiguration\CodeCoverage\Report\Php;

use function PHPUnit\Framework\isNull;

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


Route::get('login', [LoginController::class, "displayLogin"])->name("login.view");
Route::post('login', [LoginController::class, "login"])->name("login");

Route::middleware("auth")->group(function () {
    $typeUserList = TypeUser::all();

    //CONNECTION
    Route::get('disconnect', [LoginController::class, "disconnect"])->name("disconnect");

    //COMMUNE
    Route::get('/', [CommunController::class, "DefaultRoute"])->name("index");

    //Tous les utilisateurs
    Route::get('detailTicketOperateur/{id}', [OperateurController::class, "DisplayDetailTicketOperateur"])->name("detailTicketOperateur");


    //UTILISATEUR
    Route::middleware("typeUser:1,4")->group(function () {
        Route::get('ticket', [UserController::class, "displayUserTicket"])->name("userTicket");
        Route::get('detailTicket', [UserController::class, 'displayTicket'])->name("detailUserTicket");
        Route::get('ticketSaisiUser', [UserController::class, 'displayAddTicket'])->name("ticketSaisiUser");
        Route::post('addTicket', [UserController::class, 'addTicket'])->name("addTicket");
        Route::get('ticketSaisiUser/{id}', [UserController::class, "displayEditTicket"])->name("displayEditTicket");
        Route::post('editTicket', [UserController::class, 'editTicket'])->name("editTicket");
    });
    //OPERATEUR
    Route::middleware("typeUser:2,3,4")->group(function () {
        Route::get('ticketOperateur', [OperateurController::class, "DisplayTicketOperateur"])->name("ticketOperateur");


        Route::get('abortTicket/{id}', [OperateurController::class, "AbortTicket"])->name("abortTicket");

        Route::post('closeTicket/{id}', [OperateurController::class, "CloseTicketOperator"])->name("closeTicket");

        Route::post('addCommentOperator/{comment}/{id}', [
            OperateurController::class,
            "AddComment"
        ])->name("addCommentOperator");

        Route::get('ticketReallocationOperator/{id}', [OperateurController::class, "DisplayOperators"])->name("ticketReallocationOperator");

        Route::get('relocateTicketOperator/{ticket}/{operatorId}', [OperateurController::class, "ChangeTicketOperator"])->name("relocateTicketOperator");

        Route::post('addIntervention/{ticketId}/{description}/{date}', [OperateurController::class, "AddIntervention"])->name("addIntervention");

        Route::post('takeOverTicket/{ticket}', [OperateurController::class, "TakeOverTicket"])->name("takeOverTicket");

        Route::post('modifyTicketOperator/{problemId}/{precisionProblemId}/{ticketUrgency}/{date_end_guess}/{ticketId}', [OperateurController::class, "modifyTicketOperator"])->name("modifyTicketOperator");
    });
    //RESPONSABLE SERVICE
    Route::middleware("typeUser:3,4")->group(function () {
        Route::get('listOperateur', [OperateurController::class, "DisplayListeOperateur"])->name("listOperateur");
        Route::get('ticketUnassigned', [ManagerController::class, "DisplayTicketUnassigned"])->name("listTicketUnassigned");
        Route::get('stats', [ManagerController::class, "DisplayStats"])->name("stats");
    });

    //A modifier en addIntervention
    Route::get('ticketClose', [OperateurController::class, "CloseTicket"])->name("ticketClose");
});
