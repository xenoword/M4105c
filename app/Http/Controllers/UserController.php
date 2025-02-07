<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\Probleme;
use App\Models\PrecisionProbleme;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Inertia\Inertia;

class UserController extends Controller
{
    public function displayUtilisateurController(Request $request)
    {
        return Inertia::render('ticketSaisiUser'); 
    }

    public function displayAddTicket(Request $request){
        $problemeList = Probleme::all();
        $materialList = PrecisionProbleme::Where(function($query) use ($problemeList){
            $query->where('probleme_id',$problemeList[0]->id);
        })->get();
        $softList = PrecisionProbleme::Where(function($query) use ($problemeList){
            $query->where('probleme_id',$problemeList[1]->id);
        })->get();
        $userList = PrecisionProbleme::Where(function($query) use ($problemeList){
            $query->where('probleme_id',$problemeList[2]->id);
        })->get();
        return Inertia::render("ticketSaisiUser",
            [
                "problemeList" => $problemeList,
                "materialList" => $materialList,
                "softList" => $softList,
                "userList" => $userList
            ]
        );
    }

    public function displayEditTicket(Request $request, int $id) {
        $ticket = Ticket::findOrFail($id);
        $problemeList = Probleme::all();
        $materialList = PrecisionProbleme::Where(function($query) use ($problemeList){
            $query->where('probleme_id',$problemeList[0]->id);
        })->get();
        $softList = PrecisionProbleme::Where(function($query) use ($problemeList){
            $query->where('probleme_id',$problemeList[1]->id);
        })->get();
        $userList = PrecisionProbleme::Where(function($query) use ($problemeList){
            $query->where('probleme_id',$problemeList[2]->id);
        })->get();

        return Inertia::render("ticketSaisiUser",
            [
                "ticket" => $ticket,
                "problemeList" => $problemeList,
                "materialList" => $materialList,
                "softList" => $softList,
                "userList" => $userList
            ]
        );
    }

    public function displayUserTicket(Request $request){
        $ticketList = Ticket::where(function($query) use ($request){
            if (isset($request->resolved)) {
                if ($request->resolved == 'resolu') {
                    $query->whereNotNull('date_end');
                }else if ($request->resolved == 'nonResolu') {
                    $query->whereNull('date_end');
                }
            }
            $query->where("user_id", session("user")->id);
        })->orderByDesc('updated_at')->get();
        
        return Inertia::render("ticket", ['ticketList' => $ticketList]);
    }

    public function addTicket(Request $request){
        $ope = null;
        $allOperateur =User::where("type_user_id", 2)->get();
        foreach($allOperateur as $operateur){
            foreach($operateur->canResolve as $canResolve){
                if($request->input("precision_probleme_id") == $canResolve->id){
                    $ope = $operateur->id;
                    break;
                }
            }
        }

        $ticket = new Ticket();
        $ticket->description = $request->input("description");
        $ticket->computer = $request->input("computer");
        $ticket->link_attached_file = null;
        $ticket->urgency = $request->input("urgency");
        $ticket->redirection = 0;
        $ticket->comment = null;
        $ticket->date_start = Date::now();
        $ticket->date_end = null;
        $ticket->probleme_id = $request->input("probleme_id");
        $ticket->precision_probleme_id = $request->input("precision_probleme_id");
        $ticket->user_id = session("user")->id;
        $ticket->operateur_id = $ope;

        $ticket->save();
        return redirect("ticket");
    }

    public function editTicket(Request $request){
        $ticket = Ticket::find($request->id);
        $ticket->description = $request->input("description");
        $ticket->computer = $request->input("computer");
        //$ticket->link_attached_file = null;
        $ticket->urgency = $request->input("urgency");
        $ticket->probleme_id = $request->input("probleme_id");
        $ticket->precision_probleme_id = $request->input("precision_probleme_id");

        $ticket->save();
        
        return redirect("ticket");
    }
}