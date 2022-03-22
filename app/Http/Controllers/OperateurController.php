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
use App\Models\Intervention;
use DateTime;
use Hamcrest\Core\IsNot;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Support\Facades\DB;
use App\Models\Probleme;
use App\Models\PrecisionProbleme;
use phpDocumentor\Reflection\Types\Boolean;

class OperateurController extends Controller
{
    public function DisplayTicketOperateur(Request $request)
    {

        $trie = 'asc';

        if (isset($request->dateSort)) {
            if ($request->dateSort == 'Plus ancients')
                $trie = 'asc';
            else
                $trie = 'desc';
        }

        $ticketList = Ticket::where(function ($query) use ($request) {

            $query->where("operateur_id", session("user")->id);

            if (isset($request->resolved)) {

                if ($request->resolved == 'Résolus')
                    $query->whereNotNull('date_end');
                else if ($request->resolved == 'Non résolus')
                    $query->whereNull('date_end');
            }
            if (isset($request->urgence)) {

                if ($request->urgence == 1)
                    $query->where('urgency', '=', 1);
                if ($request->urgence == 2)
                    $query->where('urgency', '=', 2);
                if ($request->urgence == 3)
                    $query->where('urgency', '=', 3);
                if ($request->urgence == 4)
                    $query->where('urgency', '=', 4);
                if ($request->urgence == 5)
                    $query->where('urgency', '=', 5);
            }
            if (isset($request->emeteur)) {
                if ($request->emeteur != 0) {
                    $query->where('user_id', $request->emeteur);
                }
            }
        })
            ->orderBy('date_start', $trie)
            ->get();

        $userList = User::where(function ($query) use ($ticketList) {
            $query->where('type_user_id', 1);
        })->get();

        return Inertia::render("ticketOperateur", ['ticketList' => $ticketList, 'optionsEmeteur' => $userList]);
    }

    public function DisplayListeOperateur(Request $request)
    {
        $listOperateur = User::where('type_user_id', 2)->get();
        $ticket = Ticket::findOrFail($request->input("id"));

        $countTicket = [];
        foreach ($listOperateur as $ope) {
            $countTicket[$ope->id] = Ticket::where("operateur_id", $ope->id)->get()->count();
        }

        return Inertia::render("listOperateur", ['listOperateur' => $listOperateur, 'ticket' => $ticket]);
    }


    public function DisplayDetailTicketOperateur(Request $request)
    {

        if (isset($request->id)) {
            $ticket = Ticket::findOrFail($request->id);
        }

        $problemeList = Probleme::all();

        $materialList = PrecisionProbleme::Where(function ($query) use ($problemeList) {
            $query->where('probleme_id', $problemeList[0]->id);
        })->get();

        $softList = PrecisionProbleme::Where(function ($query) use ($problemeList) {
            $query->where('probleme_id', $problemeList[1]->id);
        })->get();

        $userList = PrecisionProbleme::Where(function ($query) use ($problemeList) {
            $query->where('probleme_id', $problemeList[2]->id);
        })->get();

        return Inertia::render("detailTicketOperateur", [
            "ticket" => $ticket,
            "problemeList" => $problemeList,
            "materialList" => $materialList,
            "softList" => $softList,
            "userList" => $userList
        ]);
    }


    public function AbortTicket(int $id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->operateur_id = null;
        if ($ticket->redirection >= 3) {
            $resp = User::Where('type_user_id', 3)->get()->first();
            $ticket->operateur_id = $resp->id;
        }
        
        $ticket->save();

        return redirect("ticketOperateur");
    }

    public function CloseTicket()
    {

        return Inertia::render("ticketClose");
    }

    public function SaveIntervention()
    {
    }

    public function CloseTicketOperator(Request $request, string $id)
    {

        $ticket = Ticket::findOrFail((int) $id);

        $today = Date::now();

        $ticket->date_end = $today;
        $ticket->solved = $request->solved;

        $ticket->save();

        return redirect("/");
    }

    public function AddComment(Request $request, string $comment, string $id)
    {

        $ticket = Ticket::findOrFail((int) $id);

        $ticket->comment = $comment;

        $ticket->save();

        return redirect("detailTicketOperateur/" . $ticket->id);
    }

    public function DisplayOperators(string $id)
    {

        $ticket = Ticket::findOrFail((int) $id);

        $listOperateur = User::where(function ($query) {

            $query->where('type_user_id', 2);
            $query->where('id', '<>', session("user")->id);
        })->get();

        return Inertia::render("ticketRealocationOperator", ['ticket' => $ticket, 'listOperateur' => $listOperateur]);
    }

    public function ChangeTicketOperator(Ticket $ticket, string $operatorId)
    {
        $ticket->operateur_id = $operatorId;
        $ticket->redirection += 1; 

        $ticket->save();

        return redirect("/");
    }

    public function AddIntervention(Request $request)
    {

        if (isset($request->ticketId) && isset($request->description) && isset($request->date)) {

            $intervention = new Intervention();

            $intervention->user_id = session("user")->id;
            $intervention->ticket_id = $request->ticketId;
            $intervention->date_intervention = $request->date;
            $intervention->description_intervention = $request->description;

            $intervention->save();
        }

        return redirect('detailTicketOperateur/' . $request->ticketId);
    }

    public function TakeOverTicket(Request $request, Ticket $ticket)
    {
        $ticket->date_end_guess = $request->dateEndGuess;
        $ticket->save();

        return redirect('/');
    }

    public function ModifyTicketOperator(Request $request)
    {

        if (isset($request->problemId) && isset($request->precisionProblemId) && isset($request->ticketUrgency) && isset($request->ticketId) && isset($request->date_end_guess)) {

            $ticket = Ticket::findOrFail($request->ticketId);

            $ticket->probleme_id = $request->problemId;
            $ticket->precision_probleme_id = $request->precisionProblemId;
            $ticket->urgency = $request->ticketUrgency;
            $ticket->date_end_guess = $request->date_end_guess;

            $ticket->save();

            return redirect('detailTicketOperateur/' . $request->ticketId);
        }
    }
}
