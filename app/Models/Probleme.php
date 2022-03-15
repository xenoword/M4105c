<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Probleme extends Model
{
    use HasFactory;

    protected $table = "problemes";
    protected $primaryKey = "id";
    public $timestamps = true;

    protected $fillable = [
        'libelle',
    ];
    
}
