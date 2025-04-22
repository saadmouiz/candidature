<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;


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
        'photo_path',
        'admin_id',
        'has_appointment',
        'appointment_date',
        'appointment_sent_at',
        'attendance_confirmed',
        'attendance_confirmed_at',
    ];

    public function candidature()
    {
        return $this->belongsTo(Candidature::class);
    }
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

}