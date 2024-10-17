<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evoluation extends Model
{
    protected $primaryKey = 'id_evoluation';
    protected $fillable = ['matiere','date','type','hDebut','hFine','id_classe'];
    public function classe()
    {
        return $this->belongsTo(Classe::class,'id_classe');
    }
    
    use HasFactory;
}
