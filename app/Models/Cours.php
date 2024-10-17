<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cours extends Model
{
    protected $primaryKey = 'id_cours';
    protected $fillable = ['jour','hDebut','hFine','matiere','id_classe'];
    public function classe()
    {
        return $this->belongsTo(Classe::class,'id_classe');
    }
    public function enseignants()
    {
        return $this->hasMany(Enseignant::class,'id_enseignant');
    }
    use HasFactory;
}
