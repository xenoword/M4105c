<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CanResolve extends Model
{
    use HasFactory;
    protected $table = "can_resolve";
    protected $primaryKey = "precision_probleme_id";
    public $timestamps = false;
}
