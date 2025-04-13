<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beneficiaire extends Model
{
    use HasFactory;

    protected $fillable = [
        'candidature_id',
        'nom',
        'prenom',
        'cin',
        'date_naissance',
        'email',
        'tel',
        'niveau_scolaire',
        'baccalaureat_path',
        'cin_path',
        'acte_path',
        'releve_notes_path',
        'photo_path'
    ];

    public function candidature()
    {
        return $this->belongsTo(Candidature::class);
    }
}