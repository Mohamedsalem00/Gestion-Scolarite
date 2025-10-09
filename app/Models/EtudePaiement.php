<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EtudePaiement extends Model
{
    protected $table = 'etudepaiements';
    protected $primaryKey ='id_paiements';
    protected $fillable =['id_etudiant','typepaye','montant','statut','date_paiement'];
    
    protected $dates = ['date_paiement'];
    
    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class, 'id_etudiant');
    }
    
    use HasFactory;
}
