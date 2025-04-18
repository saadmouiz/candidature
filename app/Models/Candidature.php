<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidature extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom', 
        'prenom', 
        'cin', 
        'date_naissance',  // au lieu de 'date'
        'email',
        'tel',             // tel (comme dans la migration) et non 'telephone' 
        'niveau_scolaire', 
        'baccalaureat_path',  // au lieu de 'baccalaureat'
        'cin_path',           // au lieu de 'cin_doc'
        'acte_path',          // au lieu de 'acte_doc'
        'releve_notes_path',  // au lieu de 'releve_notes'
        'photo_path',         // au lieu de 'photo'
        'status'
    ];
    public function beneficiaire()
    {
        return $this->hasOne(Beneficiaire::class);
    }
    public function admin()
{
    return $this->belongsTo(User::class, 'admin_id');
}
}