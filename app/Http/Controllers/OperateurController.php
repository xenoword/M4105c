<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Date;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Models\Ticket;
use App\Models\User;
use DateTime;
use Hamcrest\Core\IsNot;
use Illuminate\Support\Facades\DB;

class OperateurController extends Controller
{
    public function DisplayTicketOperateur(Request $request){

        $trie = 'asc';

        if(isset($request->dateSort)){
            if($request->dateSort == 'Plus ancients')
                $trie = 'desc';
            else
                $trie = 'asc';
        }

        $ticketList = Ticket::where(function($query) use ($request){

            $query->where("operateur_id", session("user")->id);

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


        })
        ->orderBy('date_start', $trie)
        ->get();

        return Inertia::render("ticketOperateur", ['ticketList' => $ticketList]);
    }

    public function DisplayListeOperateur(Request $request){
        $listOperateur = User::where('type_user_id', 2)->get();
        $ticket = Ticket::where('id', $request->input("id"))->get();

        return Inertia::render("listOperateur", ['listOperateur' => $listOperateur, 'ticket' => $ticket]); 
    }

    public function DisplayDetailTicketOperateur(Request $request,int $id){

        $ticket = Ticket::findOrFail($id);
        
        return Inertia::render("detailTicketOperateur",["ticket" => $ticket]);
    }

    public function CloseTicket(){

        return Inertia::render("ticketClose");
    }

    public function SaveIntervention(){
        
    }

    public function CloseTicketOperator(Request $request,string $id){

        $ticket = Ticket::findOrFail( (int) $id);

        $today = Date::now();

        $ticket->date_end = $today;

        $ticket->save();
        
        return redirect("detailTicketOperateur/".$ticket->id);
    }

    public function AddComment(Request $request, string $comment, string $id){

        $ticket = Ticket::findOrFail((int) $id);

        $ticket->comment = $comment;

        $ticket->save();

        return redirect("detailTicketOperateur/".$ticket->id);
    }

    public function DisplayOperators(Request $request,string $id){

        $ticket = Ticket::findOrFail((int) $id);

        $listOperateur = User::where('type_user_id', 2)->get();
        
        return Inertia::render("ticketRealocationOperator", ['ticket' => $ticket, 'listOperateur' => $listOperateur]);

    }

    public function ChangeTicketOperator(Request $request, string $ticketId, string $operatorId){

        $ticket = Ticket::findOrFail((int) $ticketId);

    


    }
}