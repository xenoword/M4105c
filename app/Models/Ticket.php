<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $table = "tickets";
    protected $primaryKey = "id";
    public $timestamps = true;

    protected $fillable = [
        'id',
        'description',
        'computer',
        'link_attached_file',
        'urgency',
        'redirection',
        'comment',
        'date_start',
        'date_end',
        'probleme_id'
    ];

    public function probleme(){
        return $this->hasOne(Probleme::class, "probleme_id", 'id');
    }
    public function user(){
        return $this->hasOne(User::class, "user_id", 'id');
    }

    public function isurgent($urg){
        return $this->urgency == $urg;
    }

    public function hasDateEnd($stat){
        if(isset($this->date_end))
            return true;
        else
            return false;
    }
}
