<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    protected $primaryKey = 'id_classe';
    protected $fillable = ['nom_classe', 'niveau'];
    public function etudiants()
    {
        return $this->hasMany(Etudiant::class, 'id_classe');
    }
    public function enseignants()
    {
        return $this->hasMany(Enseignant::class, 'id_classe');
    }
    use HasFactory;
}
