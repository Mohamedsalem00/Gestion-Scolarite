<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    protected $table = 'evaluations';
    protected $primaryKey = 'id_evaluation';
    protected $fillable = ['id_matiere','titre','date','type','date_debut','date_fin','id_classe','note_max'];
    
    protected $casts = [
        'date' => 'date',
        'note_max' => 'decimal:2',
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
    
    // Helper method to get matiere name
    public function getMatiereNameAttribute()
    {
        return $this->matiere ? $this->matiere->nom_matiere : 'N/A';
    }
    
    // Helper method to get full evaluation title
    public function getFullTitleAttribute()
    {
        return $this->titre ?: (ucfirst($this->type) . ' de ' . $this->matiere_name);
    }
    
    use HasFactory;
}
