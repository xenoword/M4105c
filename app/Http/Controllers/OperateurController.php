<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Models\Ticket;
use Hamcrest\Core\IsNot;
use Illuminate\Support\Facades\DB;

class OperateurController extends Controller
{
    public function DisplayTicketOperateur(Request $request){

        $ticketList = Ticket::where(function($query) use ($request){

            if(isset($request->resolved)){

                if($request->resolved == 'Résolus')
                    $query->whereNotNull('date_end');
                else if ($request->resolved == 'Non résolus')
                    $query->whereNull('date_end');
            }
            if(isset($request->urgence)){
    
                if($request->urgence == 1)
                    $query->where('urgency','=',1);
                if($request->urgence == 2)
                    $query->where('urgency','=',2);
                if($request->urgence == 3)
                    $query->where('urgency','=',3);
                if($request->urgence == 4)
                    $query->where('urgency','=',4);
                if($request->urgence == 5)
                    $query->where('urgency','=',5);
            }
        })->get();

        return Inertia::render("ticketOperateur", ['ticketList' => $ticketList]);
    }
}