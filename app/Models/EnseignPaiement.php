<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnseignPaiement extends Model
{
    protected $table = 'enseignpaiements';
    protected $primaryKey ='id_paiements';
    protected $fillable =['id_enseignant','typepaiement','montant','statut','date_paiement'];
    
    protected $dates = ['date_paiement'];
    
    public function enseignant()
    {
        return $this->belongsTo(Enseignant::class, 'id_enseignant');
    }
    
    use HasFactory;
}
