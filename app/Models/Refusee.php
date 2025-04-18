<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Refusee extends Model
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
        'photo_path',
        'admin_id',
        'raison_refus'
    ];

    /**
     * Obtenir la candidature associée
     */
    public function candidature()
    {
        return $this->belongsTo(Candidature::class);
    }

    /**
     * Obtenir l'administrateur qui a refusé la candidature
     */
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}