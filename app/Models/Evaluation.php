<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    protected $table = 'evaluations';
    protected $primaryKey = 'id_evaluation';
    protected $fillable = ['id_matiere','matiere','date','type','date_debut','date_fin','id_classe','note_max'];
    
    protected $casts = [
        'date' => 'date',
        'date_debut' => 'date',
        'date_fin' => 'date',
    ];
    
    public function classe()
    {
        return $this->belongsTo(Classe::class,'id_classe');
    }
    
    public function notes()
    {
        return $this->hasMany(Note::class, 'id_evaluation');
    }
    
    public function matiere()
    {
        return $this->belongsTo(Matiere::class, 'id_matiere');
    }
    
    // Helper method to get matiere name (supports both old and new structure)
    public function getMatiereNameAttribute()
    {
        if ($this->matiere_relation) {
            return $this->matiere_relation->nom_matiere;
        }
        return $this->matiere; // fallback to old string field
    }
    
    // Alias for the relationship to avoid conflict with the string attribute
    public function matiere_relation()
    {
        return $this->belongsTo(Matiere::class, 'id_matiere');
    }
    
    use HasFactory;
}
