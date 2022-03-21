<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use HasCompositePrimaryKeyTrait;

class Intervention extends Model
{
    use HasFactory;

    protected $table = "intervention";
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $incrementing = false;

    protected $fillable = [
        "user_id",
        "ticket_id",
        "date_intervention",
        "description_intervention",
        "id"
    ];
}
