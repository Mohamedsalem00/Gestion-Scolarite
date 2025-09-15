<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnseignPaiement extends Model
{
    protected $table = 'enseignpaiements';
    protected $primaryKey ='id_paiements';
    protected $fillable =['user_id','typepaiement','montant','statut','date_paiement'];
    
    protected $dates = ['date_paiement'];
    
    public function enseignant()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    use HasFactory;
}
