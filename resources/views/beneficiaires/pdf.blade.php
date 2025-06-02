<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Profil Bénéficiaire - {{ $beneficiaire->prenom }} {{ $beneficiaire->nom }}</title>
    <style>
        @page {
            margin: 2.5cm;
            size: A4;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 12px;
            line-height: 1.6;
            color: #000000;
            background: #ffffff;
        }
        
        /* Main Container */
        .document-container {
            max-width: 100%;
            margin: 0 auto;
        }
        
        /* Header Section */
        .document-header {
            text-align: center;
            margin-bottom: 40px;
            padding-bottom: 20px;
            border-bottom: 2px solid #000000;
        }
        
        .organization-name {
            font-size: 18px;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 5px;
        }
        
        .organization-subtitle {
            font-size: 14px;
            margin-bottom: 15px;
            color: #333333;
        }
        
        .document-title {
            font-size: 16px;
            font-weight: bold;
            text-transform: uppercase;
            margin-top: 10px;
        }
        
        /* Profile Section */
        .profile-section {
            margin-bottom: 35px;
        }
        
        .profile-container {
            display: table;
            width: 100%;
            margin-bottom: 25px;
        }
        
        .photo-section {
            display: table-cell;
            width: 130px;
            vertical-align: top;
            padding-right: 25px;
        }
        
        .photo-frame {
            width: 100px;
            height: 130px;
            border: 2px solid #000000;
            padding: 3px;
            background: #ffffff;
            margin: 0;
        }
        
        .beneficiary-photo {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }
        
        .photo-placeholder {
            width: 100%;
            height: 100%;
            background: #f5f5f5;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            color: #666666;
            text-align: center;
        }
        
        .info-section {
            display: table-cell;
            vertical-align: top;
            padding-top: 5px;
        }
        
        .beneficiary-name {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 8px;
            text-transform: uppercase;
            color: #000000;
        }
        
        .beneficiary-id {
            font-size: 12px;
            color: #666666;
            margin-bottom: 15px;
        }
        
        .status-line {
            font-size: 12px;
            margin-bottom: 6px;
            line-height: 1.4;
        }
        
        .status-line strong {
            font-weight: bold;
        }
        
        /* Information Section */
        .information-section {
            margin-bottom: 30px;
        }
        
        .section-title {
            font-size: 14px;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 15px;
            padding-bottom: 5px;
            border-bottom: 1px solid #000000;
            text-align: left;
        }
        
        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        
        .info-table td {
            padding: 10px 15px;
            border: 1px solid #cccccc;
            vertical-align: top;
        }
        
        .info-table .label {
            width: 40%;
            font-weight: bold;
            background-color: #f9f9f9;
            text-align: left;
        }
        
        .info-table .value {
            width: 60%;
            text-align: left;
        }
        
        /* Appointment Section */
        .appointment-section {
            margin-bottom: 25px;
            padding: 15px;
            border: 1px solid #cccccc;
            background-color: #f9f9f9;
        }
        
        .appointment-title {
            font-weight: bold;
            margin-bottom: 10px;
            font-size: 13px;
        }
        
        .appointment-details {
            font-size: 11px;
            line-height: 1.5;
        }
        
        .appointment-success {
            border-left: 4px solid #28a745;
        }
        
        .appointment-failed {
            border-left: 4px solid #dc3545;
        }
        
        .appointment-pending {
            border-left: 4px solid #ffc107;
        }
        
        /* Footer */
        .document-footer {
            margin-top: 50px;
            padding-top: 15px;
            border-top: 1px solid #cccccc;
            text-align: center;
            font-size: 10px;
            color: #666666;
            line-height: 1.4;
        }
        
        .footer-line {
            margin-bottom: 3px;
        }
        
        .generation-date {
            margin-top: 30px;
            margin-bottom: 20px;
            text-align: right;
            font-size: 10px;
            color: #666666;
            font-style: italic;
        }
        
        /* Print optimization */
        .page-break {
            page-break-before: always;
        }
        
        .no-break {
            page-break-inside: avoid;
        }
        
        /* Alignment helpers */
        .text-center {
            text-align: center;
        }
        
        .text-left {
            text-align: left;
        }
        
        .text-right {
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="document-container">
        <!-- Document Header -->
        <div class="document-header">
            <div class="organization-name">Système de Gestion des Candidatures</div>
            <div class="organization-subtitle">Gestion des Candidatures et Bénéficiaires</div>
            <div class="document-title">Profil du Bénéficiaire</div>
        </div>

        <!-- Profile Section -->
        <div class="profile-section no-break">
            <div class="profile-container">
                <div class="photo-section">
                    <div class="photo-frame">
                        @if($photoBase64)
                            <img src="{{ $photoBase64 }}" alt="Photo du bénéficiaire" class="beneficiary-photo">
                        @else
                            <div class="photo-placeholder">
                                Photo<br>non disponible
                            </div>
                        @endif
                    </div>
                </div>
                
                <div class="info-section">
                    <div class="beneficiary-name">{{ $beneficiaire->prenom }} {{ $beneficiaire->nom }}</div>
                    <div class="beneficiary-id">Bénéficiaire N° {{ $beneficiaire->id }}</div>
                    
                    <div class="status-line">
                        <strong>Statut :</strong> Candidature acceptée
                    </div>
                    <div class="status-line">
                        <strong>Date d'acceptation :</strong> {{ $beneficiaire->created_at->format('d/m/Y') }}
                    </div>
                    <div class="status-line">
                        <strong>Validé par :</strong> {{ $beneficiaire->admin ? $beneficiaire->admin->name : 'Non spécifié' }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Personal Information -->
        <div class="information-section no-break">
            <div class="section-title">Informations Personnelles</div>
            
            <table class="info-table">
                <tr>
                    <td class="label">Nom complet</td>
                    <td class="value">{{ $beneficiaire->prenom }} {{ $beneficiaire->nom }}</td>
                </tr>
                <tr>
                    <td class="label">Numéro de Carte d'Identité (CIN)</td>
                    <td class="value">{{ $beneficiaire->cin }}</td>
                </tr>
                <tr>
                    <td class="label">Date de naissance</td>
                    <td class="value">{{ \Carbon\Carbon::parse($beneficiaire->date_naissance)->format('d/m/Y') }}</td>
                </tr>
                <tr>
                    <td class="label">Âge</td>
                    <td class="value">{{ \Carbon\Carbon::parse($beneficiaire->date_naissance)->age }} ans</td>
                </tr>
                <tr>
                    <td class="label">Adresse email</td>
                    <td class="value">{{ $beneficiaire->email }}</td>
                </tr>
                <tr>
                    <td class="label">Numéro de téléphone</td>
                    <td class="value">{{ $beneficiaire->tel }}</td>
                </tr>
                <tr>
                    <td class="label">Niveau d'éducation</td>
                    <td class="value">{{ $beneficiaire->niveau_scolaire }}</td>
                </tr>
            </table>
        </div>

        <!-- Appointment Information (if exists) -->
        @if($beneficiaire->has_appointment)
        <div class="information-section no-break">
            <div class="section-title">Suivi de Rendez-vous</div>
            
            @if($beneficiaire->attendance_confirmed)
                <div class="appointment-section appointment-success">
                    <div class="appointment-title">✓ Rendez-vous effectué</div>
                    <div class="appointment-details">
                        <strong>Date du rendez-vous :</strong> {{ \Carbon\Carbon::parse($beneficiaire->appointment_date)->format('d/m/Y à H:i') }}<br>
                        <strong>Présence confirmée le :</strong> {{ \Carbon\Carbon::parse($beneficiaire->attendance_confirmed_at)->format('d/m/Y à H:i') }}<br>
                        <strong>Statut :</strong> Le bénéficiaire s'est présenté au rendez-vous.
                    </div>
                </div>
            @elseif($beneficiaire->did_not_attend)
                <div class="appointment-section appointment-failed">
                    <div class="appointment-title">✗ Rendez-vous manqué</div>
                    <div class="appointment-details">
                        <strong>Date du rendez-vous :</strong> {{ \Carbon\Carbon::parse($beneficiaire->appointment_date)->format('d/m/Y à H:i') }}<br>
                        <strong>Absence enregistrée le :</strong> {{ \Carbon\Carbon::parse($beneficiaire->absence_recorded_at)->format('d/m/Y à H:i') }}<br>
                        <strong>Statut :</strong> Le bénéficiaire ne s'est pas présenté au rendez-vous.
                    </div>
                </div>
            @else
                <div class="appointment-section appointment-pending">
                    <div class="appointment-title">⏳ Rendez-vous programmé</div>
                    <div class="appointment-details">
                        <strong>Date du rendez-vous :</strong> {{ \Carbon\Carbon::parse($beneficiaire->appointment_date)->format('d/m/Y à H:i') }}<br>
                        <strong>Notification envoyée le :</strong> {{ \Carbon\Carbon::parse($beneficiaire->appointment_sent_at)->format('d/m/Y à H:i') }}<br>
                        <strong>Statut :</strong> En attente de confirmation de présence.
                    </div>
                </div>
            @endif
        </div>
        @endif

        <!-- Generation Info -->
        <div class="generation-date">
            Document généré le {{ now()->format('d/m/Y à H:i') }}
        </div>

        <!-- Footer -->
        <div class="document-footer">
            <div class="footer-line">Ce document certifie que {{ $beneficiaire->prenom }} {{ $beneficiaire->nom }} est officiellement enregistré(e) comme bénéficiaire.</div>
            <div class="footer-line">Document à joindre aux pièces justificatives • Bénéficiaire N° {{ $beneficiaire->id }}</div>
        </div>
    </div>
</body>
</html> 