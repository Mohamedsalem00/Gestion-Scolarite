<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Translatable;

class Classe extends Model
{
    protected $primaryKey = 'id_classe';
    protected $fillable = ['nom_classe', 'niveau', 'nom_classe_translations', 'niveau_translations'];
    
    protected $casts = [
        'nom_classe_translations' => 'array',
        'niveau_translations' => 'array',
    ];
    
    public function etudiants()
    {
        return $this->hasMany(Etudiant::class, 'id_classe');
    }
    
    public function enseignants()
    {
        return $this->belongsToMany(Enseignant::class, 'enseignant_matiere_classe', 'id_classe', 'id_enseignant')
                    ->withPivot('id_matiere', 'active')
                    ->withTimestamps();
    }
    
    public function cours()
    {
        return $this->hasMany(Cours::class, 'id_classe');
    }
    
    public function evaluations()
    {
        return $this->hasMany(Evaluation::class, 'id_classe');
    }
    
    public function notes()
    {
        return $this->hasMany(Note::class, 'id_classe');
    }
    
    // Helper methods for translations
    public function getTranslatedName($locale = 'fr')
    {
        if ($this->nom_classe_translations && isset($this->nom_classe_translations[$locale])) {
            return $this->nom_classe_translations[$locale];
        }
        return $this->nom_classe;
    }
    
    public function getTranslatedLevel($locale = 'fr')
    {
        if ($this->niveau_translations && isset($this->niveau_translations[$locale])) {
            return $this->niveau_translations[$locale];
        }
        return $this->niveau;
    }
    
    use HasFactory, Translatable;
}
