<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matiere extends Model
{
    use HasFactory;
    
    protected $table = 'matieres';
    protected $primaryKey = 'id_matiere';
    
    protected $fillable = [
        'nom_matiere',
        'code_matiere',
        'description',
        'coefficient',
        'active'
    ];
    
    protected $casts = [
        'active' => 'boolean',
        'coefficient' => 'integer',
    ];
    
    // Relationships
    public function evaluations()
    {
        return $this->hasMany(Evaluation::class, 'id_matiere');
    }
    
    public function enseignants()
    {
        return $this->belongsToMany(Enseignant::class, 'enseignant_matiere_classe', 'id_matiere', 'id_enseignant')
                    ->withPivot('id_classe', 'active')
                    ->withTimestamps();
    }
    
    public function classes()
    {
        return $this->belongsToMany(Classe::class, 'enseignant_matiere_classe', 'id_matiere', 'id_classe')
                    ->withPivot('id_enseignant', 'active')
                    ->withTimestamps();
    }
    
    // Scopes
    public function scopeActive($query)
    {
        return $query->where('active', true);
    }
    
    // Helper methods
    public function getFullNameAttribute()
    {
        return $this->code_matiere . ' - ' . $this->nom_matiere;
    }
}
