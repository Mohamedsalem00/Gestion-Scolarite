<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $primaryKey = 'id_note';
    protected $fillable = ['note','type','matiere','id_etudiant','id_classe'];
    public function etudiants()
    {
        return $this->belongsTo(Etudiant::class, 'id_etudiant');
    }
    public function classe()
    {
        return $this->belongsTo(Classe::class, 'id_classe');
    }
    use HasFactory;
}
