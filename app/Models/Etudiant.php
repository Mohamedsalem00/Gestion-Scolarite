<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model
{
    protected $primaryKey = 'id_etudiant';
    protected $fillable = ['nom', 'prenom', 'telephone', 'date_naissance', 'genre', 'adresse', 'id_classe'];
    public function classe()
    {
        return $this->belongsTo(Classe::class, 'id_classe');
    }
    use HasFactory;
}
