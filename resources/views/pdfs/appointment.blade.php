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
            padding: 30px;
            max-width: 800px;
            margin: 0 auto;
        }
        .header {
            text-align: center;
            margin-bottom: 40px;
            position: relative;
        }
        .logo-container {
            text-align: center;
            margin-bottom: 20px;
        }
        .logo {
            width: 150px;
            height: auto;
        }
        .title {
            font-size: 26px;
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
            margin-bottom: 30px;
        }
        .section-title {
            font-size: 18px;
            font-weight: bold;
            color: #ef4444;
            border-bottom: 2px solid #ef4444;
            padding-bottom: 5px;
            margin-bottom: 15px;
        }
        .card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            padding: 20px;
            margin-bottom: 25px;
        }
        .appointment-details {
            background-color: #fff5f5;
            border-left: 4px solid #ef4444;
            padding: 20px;
            margin-bottom: 25px;
            border-radius: 6px;
        }
        .detail-row {
            display: block;
            margin-bottom: 12px;
        }
        .detail-label {
            font-weight: bold;
            display: inline-block;
            width: 140px;
        }
        .documents-list {
            list-style-type: disc;
            padding-left: 20px;
        }
        .documents-list li {
            margin-bottom: 10px;
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
            border-radius: 6px;
            margin: 20px 0;
            font-size: 14px;
            border-left: 4px solid #3b82f6;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            border-radius: 6px;
            overflow: hidden;
        }
        th {
            background-color: #ef4444;
            color: white;
            font-weight: bold;
            text-align: left;
            padding: 12px;
        }
        td {
            border: 1px solid #e5e7eb;
            padding: 10px;
        }
        tr:nth-child(even) {
            background-color: #f9fafb;
        }
        .page-break {
            page-break-after: always;
        }
        .beneficiary-info {
            display: flex;
            flex-wrap: wrap;
        }
        .info-column {
            flex: 1;
            min-width: 250px;
        }
        .qr-section {
            text-align: center;
            background-color: #f0f9ff;
            border: 2px solid #3b82f6;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
        }
        .qr-code {
            margin: 10px auto;
            display: block;
        }
        .qr-instructions {
            font-size: 14px;
            color: #374151;
            margin-top: 10px;
            line-height: 1.5;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo-container">
                @if(isset($includeImages) && $includeImages && isset($hasLogo) && $hasLogo)
                <img src="{{ public_path('assets/logo_ico.png') }}" alt="Logo" class="logo">
            @else
                    <div style="height: 80px; font-weight: bold; color: #ef4444; font-size: 24px; margin-bottom: 15px;">PROGRAMME DE BÉNÉFICIAIRES</div>
            @endif
            </div>
            <div class="title">CONVOCATION OFFICIELLE</div>
            <div class="subtitle">Rendez-vous de suivi - Programme des bénéficiaires</div>
        </div>
        
        <div class="card">
        <div class="section">
            <div class="section-title">INFORMATIONS PERSONNELLES</div>
                <div class="beneficiary-info">
                    <div class="info-column">
                        <div class="detail-row">
                            <span class="detail-label">Nom complet :</span> {{ $beneficiaire->prenom }} {{ $beneficiaire->nom }}
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">CIN :</span> {{ $beneficiaire->cin }}
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Email :</span> {{ $beneficiaire->email }}
                        </div>
                    </div>
                    <div class="info-column">
                        <div class="detail-row">
                            <span class="detail-label">Téléphone :</span> {{ $beneficiaire->tel }}
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Date d'acceptation :</span> {{ $beneficiaire->created_at->format('d/m/Y') }}
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">ID Bénéficiaire :</span> {{ $beneficiaire->id }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="section">
            <div class="section-title">DÉTAILS DU RENDEZ-VOUS</div>
            <div class="appointment-details">
                <div class="detail-row">
                    <span class="detail-label">Date :</span> <strong>{{ $appointmentDate->format('d/m/Y') }}</strong>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Heure :</span> <strong>{{ $appointmentDate->format('H:i') }}</strong>
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
        
        @if(isset($qrCodeBase64) && $qrCodeBase64)
        <div class="section">
            <div class="section-title">CODE QR POUR PRÉSENCE</div>
            <div class="qr-section">
                <img src="{{ $qrCodeBase64 }}" alt="QR Code de présence" class="qr-code" style="width: 300px; height: 300px; display: block; margin: 0 auto;">
                <div class="qr-instructions">
                    <strong>Présentez ce code QR à l'accueil</strong><br>
                    Ce code permettra de confirmer automatiquement votre présence au rendez-vous.<br>
                    <em>Code unique: {{ substr($beneficiaire->qr_code_token, 0, 8) }}...</em>
                </div>
            </div>
        </div>
        @elseif(isset($beneficiaire->qr_code_token) && $beneficiaire->qr_code_token)
        <div class="section">
            <div class="section-title">CODE QR POUR PRÉSENCE</div>
            <div class="qr-section">
                <div style="text-align: center; padding: 20px; border: 2px dashed #ef4444; background-color: #fff5f5;">
                    <div style="font-size: 18px; font-weight: bold; margin-bottom: 10px; color: #ef4444;">
                        <i style="font-size: 24px;">⚠</i> Code QR non disponible
                    </div>
                    <p style="margin: 10px 0;"><strong>Code de référence:</strong></p>
                    <p style="font-family: monospace; font-size: 16px; font-weight: bold; background: #f3f4f6; padding: 10px; border-radius: 4px; margin: 10px 0;">
                        {{ $beneficiaire->qr_code_token }}
                    </p>
                    <p style="font-size: 14px; color: #666; margin: 10px 0;">
                        Présentez ce code de référence à l'accueil pour confirmer votre présence
                    </p>
                    <p style="font-size: 12px; color: #999; margin-top: 15px;">
                        <em>URL de vérification: {{ route('qr.attendance', ['token' => $beneficiaire->qr_code_token]) }}</em>
                    </p>
                </div>
            </div>
        </div>
        @else
        <div class="section">
            <div class="section-title">CONFIRMATION DE PRÉSENCE</div>
            <div class="qr-section">
                <div style="text-align: center; padding: 20px; border: 2px solid #6b7280; background-color: #f9fafb;">
                    <p style="font-size: 16px; font-weight: bold; margin-bottom: 10px;">
                        Confirmation manuelle requise
                    </p>
                    <p style="font-size: 14px; color: #666;">
                        Veuillez vous présenter à l'accueil avec cette convocation pour confirmer votre présence
                    </p>
                </div>
            </div>
        </div>
        @endif
        
        <div class="note">
            <strong>Important :</strong> En cas d'empêchement, veuillez nous contacter au moins 48 heures à l'avance pour reporter votre rendez-vous. Tout rendez-vous manqué sans notification préalable pourra entraîner la révision de votre statut de bénéficiaire.
        </div>
        
        <div class="section">
            <div class="section-title">PROGRAMME DE LA JOURNÉE</div>
            <table>
                <tr>
                    <th style="width: 30%;">Horaire</th>
                    <th style="width: 70%;">Activité</th>
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