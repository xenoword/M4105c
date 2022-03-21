<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ManagerController extends Controller
{
    public function DisplayTicketUnassigned()
    {

        $listTicketUnassigned = Ticket::whereNull("operateur_id")->whereNull("date_end")->get();


        return Inertia::render("listTicketUnassigned", ['listTicketUnassigned' => $listTicketUnassigned]);
    }
    public function DisplayStats()
    {
        $ticket = Ticket::all();
        $operateur = User::where("type_user_id", 2)->get();
        $user = User::where("type_user_id", 1)->get();
        return Inertia::render("chart", ["ticket" => $ticket, "operateur" => $operateur, "user" => $user]);
    }
}
