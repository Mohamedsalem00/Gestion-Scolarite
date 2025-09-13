<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enseignant extends Model
{
    protected $primaryKey ='id_enseignant';
    protected $fillable =['nom','prenom','email','telephone','matiere','id_classe'];
    
    public function classe()
    {
        return $this->belongsTo(Classe::class, 'id_classe');
    }
    
    public function cours()
    {
        return $this->hasMany(Cours::class, 'id_enseignant');
    }
    
    public function paiements()
    {
        return $this->hasMany(EnseignPaiement::class, 'id_enseignant');
    }
    
    // Helper method to get full name
    public function getFullNameAttribute()
    {
        return $this->prenom . ' ' . $this->nom;
    }
    
    use HasFactory;
}
