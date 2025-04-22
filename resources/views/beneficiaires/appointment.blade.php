@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<style>
    .appointment-container {
        max-width: 800px;
        margin: 0 auto;
        padding: 2rem;
    }
    
    .card {
        background: white;
        border-radius: 0.75rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }
    
    .card-header {
        background-color: #ef4444;
        color: white;
        padding: 1.25rem;
        font-size: 1.25rem;
        font-weight: 600;
    }
    
    .card-body {
        padding: 2rem;
    }
    
    .form-group {
        margin-bottom: 1.5rem;
    }
    
    .form-label {
        display: block;
        font-weight: 500;
        margin-bottom: 0.5rem;
        color: #374151;
    }
    
    .form-control {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #d1d5db;
        border-radius: 0.375rem;
        font-size: 1rem;
    }
    
    .form-text {
        display: block;
        margin-top: 0.5rem;
        font-size: 0.875rem;
        color: #6b7280;
    }
    
    .btn {
        display: inline-block;
        padding: 0.75rem 1.5rem;
        border-radius: 0.375rem;
        font-weight: 500;
        text-align: center;
        cursor: pointer;
        transition: all 0.2s;
        border: none;
        font-size: 1rem;
    }
    
    .btn-primary {
        background-color: #ef4444;
        color: white;
    }
    
    .btn-primary:hover {
        background-color: #dc2626;
    }
    
    .btn-secondary {
        background-color: #9ca3af;
        color: white;
    }
    
    .btn-secondary:hover {
        background-color: #6b7280;
    }
    
    .beneficiary-info {
        background-color: #f9fafb;
        padding: 1rem;
        border-radius: 0.5rem;
        margin-bottom: 1.5rem;
    }
    
    .beneficiary-info p {
        margin: 0.5rem 0;
    }
    
    .beneficiary-name {
        font-weight: 600;
        color: #111827;
    }
    
    .action-buttons {
        display: flex;
        justify-content: space-between;
        margin-top: 2rem;
    }
</style>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        flatpickr("#appointment_date", {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
            minDate: "today",
            time_24hr: true,
            minTime: "09:00",
            maxTime: "18:00",
            disable: [
                function(date) {
                    // Disable weekends
                    return (date.getDay() === 0 || date.getDay() === 6);
                }
            ]
        });
    });
</script>
@endsection

@section('content')
<div class="appointment-container">
    <div class="card">
        <div class="card-header">
            Programmer un rendez-vous
        </div>
        <div class="card-body">
            <div class="beneficiary-info">
                <p class="beneficiary-name">{{ $beneficiaire->prenom }} {{ $beneficiaire->nom }}</p>
                <p>CIN: {{ $beneficiaire->cin }}</p>
                <p>Email: {{ $beneficiaire->email }}</p>
                <p>Téléphone: {{ $beneficiaire->tel }}</p>
            </div>
            
            <form action="{{ route('beneficiaire.appointment.store', $beneficiaire) }}" method="POST">
                @csrf
                
                <div class="form-group">
                    <label for="appointment_date" class="form-label">Date et heure du rendez-vous</label>
                    <input type="text" id="appointment_date" name="appointment_date" class="form-control @error('appointment_date') is-invalid @enderror" placeholder="Sélectionner une date et heure" required>
                    <small class="form-text">Choisissez une date et une heure en semaine entre 9h et 18h.</small>
                    
                    @error('appointment_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="action-buttons">
                    <a href="{{ route('beneficiaire.show', $beneficiaire) }}" class="btn btn-secondary">Annuler</a>
                    <button type="submit" class="btn btn-primary">Programmer et envoyer l'e-mail</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 