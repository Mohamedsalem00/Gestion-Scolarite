<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $primaryKey = 'id_note';
    protected $fillable = ['note','type','id_matiere','id_etudiant','id_evaluation','id_classe','commentaire'];
    
    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName()
    {
        return 'id_note';
    }
    
    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class, 'id_etudiant');
    }
    
    public function evaluation()
    {
        return $this->belongsTo(Evaluation::class, 'id_evaluation');
    }
    
    public function classe()
    {
        return $this->belongsTo(Classe::class, 'id_classe');
    }
    
    public function matiere()
    {
        return $this->belongsTo(Matiere::class, 'id_matiere', 'id_matiere');
    }
    
    use HasFactory;
}
