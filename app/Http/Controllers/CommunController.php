<?php

namespace App\Http\Controllers;

use App\Models\TypeUser;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class CommunController extends Controller
{
    public function DefaultRoute(){
        if(in_array(session('user')->type_user_id, [1,4])){
            return redirect("ticket");
        }
        if(in_array(session('user')->type_user_id, [2])){
            return redirect("ticketOperateur");
        };
        if(in_array(session('user')->type_user_id, [3])){
            return redirect("ticketUnassigned");
        };
    }
}
