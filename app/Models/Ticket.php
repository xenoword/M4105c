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
        'date_end_guess',
        'solved',
        'probleme_id',
        "precision_probleme_id",
        "user_id"
    ];

    protected $with = [
      "probleme",
      "user",
      "problemePrecision"
    ];

    public function probleme(){
        return $this->belongsTo(Probleme::class);
    }

    public function problemePrecision(){
        return $this->belongsTo(PrecisionProbleme::class,"precision_probleme_id", "id");
    }

    public function user(){
        return $this->belongsTo(User::class, "user_id", 'id');
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
