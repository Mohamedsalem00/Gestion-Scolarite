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
    use HasFactory;
}
