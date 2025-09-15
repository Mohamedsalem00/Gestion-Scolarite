<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cours extends Model
{
    protected $primaryKey = 'id_cours';
    protected $fillable = ['jour','date_debut','date_fin','id_matiere','id_classe','id_enseignant','description'];
    
    // Cast time fields properly
    protected $casts = [
        'date_debut' => 'datetime:H:i',
        'date_fin' => 'datetime:H:i',
    ];
    
    public function classe()
    {
        return $this->belongsTo(Classe::class,'id_classe');
    }
    
    public function enseignant()
    {
        return $this->belongsTo(Enseignant::class,'id_enseignant');
    }
    
    public function matiere()
    {
        return $this->belongsTo(Matiere::class,'id_matiere','id_matiere');
    }
    
    use HasFactory;
}
