<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ManagerController extends Controller
{
    public function DisplayTicketUnassigned(){

        $listTicketUnassigned = Ticket::whereNull("operateur_id")->whereNull("date_end")->get();


        return Inertia::render("listTicketUnassigned", ['listTicketUnassigned' => $listTicketUnassigned]);
        
    }
}
