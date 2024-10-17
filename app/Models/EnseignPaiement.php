<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnseignPaiement extends Model
{
    protected $table = 'enseignpaiements';
    protected $primaryKey ='id_paiements';
    protected $fillable =['id_enseignant','typepaiement','updated_at'];
    public function enseignants()
    {
        return $this->hasMany(Enseignant::class, 'id_enseignant');
    }
    use HasFactory;
}
