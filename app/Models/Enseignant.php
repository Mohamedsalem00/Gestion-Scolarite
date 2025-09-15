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
    
    // New matiere relationships
    public function matieres()
    {
        return $this->belongsToMany(Matiere::class, 'enseignant_matiere_classe', 'id_enseignant', 'id_matiere')
                    ->withPivot('id_classe', 'active')
                    ->withTimestamps();
    }
    
    public function classes()
    {
        return $this->belongsToMany(Classe::class, 'enseignant_matiere_classe', 'id_enseignant', 'id_classe')
                    ->withPivot('id_matiere', 'active')
                    ->withTimestamps();
    }
    
    // Helper method to get full name
    public function getFullNameAttribute()
    {
        return $this->prenom . ' ' . $this->nom;
    }
    
    use HasFactory;
}
