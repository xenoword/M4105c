<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrecisionProbleme extends Model
{
    use HasFactory;

    protected $table = "precision_problemes";
    protected $primaryKey = "id";
    public $timestamps = true;

    protected $fillable = [
        'id',
        'libelle',
        'probleme_id'
    ];
}
