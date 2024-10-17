<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EtudePaiement extends Model
{
    protected $table = 'etudepaiements';
    protected $primaryKey ='id_paiements';
    protected $fillable =['id_etudiant','typepaye','updated_at'];
    public function etudiant()
    {
        return $this->hasMany(Etudiant::class, 'id_etudiant');
    }
    use HasFactory;
}
