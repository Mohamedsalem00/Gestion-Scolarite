<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    protected $table = 'evaluations';
    protected $primaryKey = 'id_evaluation';
    protected $fillable = ['matiere','date','type','date_debut','date_fin','id_classe'];
    
    protected $dates = ['date', 'date_debut', 'date_fin'];
    
    public function classe()
    {
        return $this->belongsTo(Classe::class,'id_classe');
    }
    
    public function notes()
    {
        return $this->hasMany(Note::class, 'id_evaluation');
    }
    
    use HasFactory;
}
