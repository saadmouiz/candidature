<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Rendez-vous de suivi</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            line-height: 1.6;
            color: #1f2937;
            margin: 0;
            padding: 0;
        }
        .container {
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .logo {
            width: 120px;
            margin-bottom: 15px;
        }
        .title {
            font-size: 24px;
            font-weight: bold;
            color: #ef4444;
            margin-bottom: 10px;
        }
        .subtitle {
            font-size: 18px;
            color: #4b5563;
            margin-bottom: 30px;
        }
        .section {
            margin-bottom: 25px;
        }
        .section-title {
            font-size: 16px;
            font-weight: bold;
            color: #ef4444;
            border-bottom: 1px solid #ef4444;
            padding-bottom: 5px;
            margin-bottom: 15px;
        }
        .appointment-details {
            background-color: #fff5f5;
            border-left: 4px solid #ef4444;
            padding: 15px;
            margin-bottom: 25px;
        }
        .detail-row {
            display: block;
            margin-bottom: 10px;
        }
        .detail-label {
            font-weight: bold;
            display: inline-block;
            width: 120px;
        }
        .documents-list {
            list-style-type: disc;
            padding-left: 20px;
        }
        .documents-list li {
            margin-bottom: 8px;
        }
        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 12px;
            color: #6b7280;
            border-top: 1px solid #e5e7eb;
            padding-top: 20px;
        }
        .note {
            background-color: #f9fafb;
            padding: 15px;
            border-radius: 4px;
            margin: 20px 0;
            font-size: 14px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th {
            background-color: #ef4444;
            color: white;
            font-weight: bold;
            text-align: left;
            padding: 8px;
        }
        td {
            border: 1px solid #e5e7eb;
            padding: 8px;
        }
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            @if(isset($includeImages) && $includeImages)
                <img src="{{ public_path('assets/logo_ico.png') }}" alt="Logo" class="logo">
            @else
                <div style="height: 50px; font-weight: bold; color: #ef4444; margin-bottom: 15px;">PROGRAMME DE BÉNÉFICIAIRES</div>
            @endif
            <div class="title">CONVOCATION OFFICIELLE</div>
            <div class="subtitle">Rendez-vous de suivi - Programme des bénéficiaires</div>
        </div>
        
        <div class="section">
            <div class="section-title">INFORMATIONS PERSONNELLES</div>
            <p>
                <strong>Bénéficiaire :</strong> {{ $beneficiaire->prenom }} {{ $beneficiaire->nom }}<br>
                <strong>CIN :</strong> {{ $beneficiaire->cin }}<br>
                <strong>Email :</strong> {{ $beneficiaire->email }}<br>
                <strong>Téléphone :</strong> {{ $beneficiaire->tel }}<br>
                <strong>Date d'acceptation :</strong> {{ $beneficiaire->created_at->format('d/m/Y') }}
            </p>
        </div>
        
        <div class="section">
            <div class="section-title">DÉTAILS DU RENDEZ-VOUS</div>
            <div class="appointment-details">
                <div class="detail-row">
                    <span class="detail-label">Date :</span> {{ $appointmentDate->format('d/m/Y') }}
                </div>
                <div class="detail-row">
                    <span class="detail-label">Heure :</span> {{ $appointmentDate->format('H:i') }}
                </div>
                <div class="detail-row">
                    <span class="detail-label">Lieu :</span> Centre de Formation, 123 Boulevard Principal, Casablanca
                </div>
                <div class="detail-row">
                    <span class="detail-label">Contact :</span> Service des bénéficiaires (+212 522 XX XX XX)
                </div>
            </div>
        </div>
        
        <div class="section">
            <div class="section-title">DOCUMENTS À APPORTER</div>
            <p>Veuillez vous présenter avec les documents originaux suivants :</p>
            <ul class="documents-list">
                <li>Carte d'identité nationale (CIN)</li>
                <li>Copie du contrat signé</li>
                <li>Toutes attestations ou documents pouvant appuyer votre dossier</li>
                <li>Cette convocation imprimée</li>
            </ul>
        </div>
        
        <div class="note">
            <strong>Important :</strong> En cas d'empêchement, veuillez nous contacter au moins 48 heures à l'avance pour reporter votre rendez-vous. Tout rendez-vous manqué sans notification préalable pourra entraîner la révision de votre statut de bénéficiaire.
        </div>
        
        <div class="section">
            <div class="section-title">PROGRAMME DE LA JOURNÉE</div>
            <table>
                <tr>
                    <th>Horaire</th>
                    <th>Activité</th>
                </tr>
                <tr>
                    <td>{{ $appointmentDate->format('H:i') }} - {{ $appointmentDate->copy()->addMinutes(30)->format('H:i') }}</td>
                    <td>Accueil et vérification des documents</td>
                </tr>
                <tr>
                    <td>{{ $appointmentDate->copy()->addMinutes(30)->format('H:i') }} - {{ $appointmentDate->copy()->addMinutes(90)->format('H:i') }}</td>
                    <td>Présentation du programme et des ressources disponibles</td>
                </tr>
                <tr>
                    <td>{{ $appointmentDate->copy()->addMinutes(90)->format('H:i') }} - {{ $appointmentDate->copy()->addMinutes(120)->format('H:i') }}</td>
                    <td>Entretien individuel avec un conseiller</td>
                </tr>
            </table>
        </div>
        
        <div class="footer">
            <p>Document généré le {{ $generatedAt->format('d/m/Y à H:i') }} | ID: {{ $beneficiaire->id }}-{{ time() }}</p>
            <p>© {{ date('Y') }} Programme de Bénéficiaires - Tous droits réservés</p>
        </div>
    </div>
</body>
</html> 