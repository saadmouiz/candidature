<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Contrat de Bénéficiaire</title>
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
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 1px solid #ef4444;
            padding-bottom: 20px;
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
            font-size: 16px;
            color: #4b5563;
            margin-bottom: 5px;
        }
        .reference {
            font-size: 14px;
            color: #6b7280;
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
        .intro {
            margin-bottom: 20px;
        }
        .parties {
            margin-bottom: 20px;
        }
        .party {
            margin-bottom: 15px;
        }
        .party-title {
            font-weight: bold;
            margin-bottom: 5px;
        }
        .clauses ol {
            padding-left: 20px;
        }
        .clauses li {
            margin-bottom: 15px;
        }
        .clause-title {
            font-weight: bold;
            margin-bottom: 5px;
        }
        .signatures {
            margin-top: 50px;
            display: flex;
            justify-content: space-between;
        }
        .signature-block {
            width: 45%;
        }
        .signature-title {
            font-weight: bold;
            margin-bottom: 10px;
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 5px;
        }
        .signature-line {
            border-top: 1px dashed #6b7280;
            margin-top: 70px;
        }
        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 12px;
            color: #6b7280;
            border-top: 1px solid #e5e7eb;
            padding-top: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th {
            text-align: left;
            padding: 8px;
        }
        td {
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
            <div class="title">CONTRAT DE BÉNÉFICIAIRE</div>
            <div class="subtitle">Programme d'Accompagnement et de Formation</div>
            <div class="reference">Réf: BEN-{{ $candidature->id }}/{{ date('Y') }}</div>
        </div>
        
        <div class="intro">
            <p>Le présent contrat est conclu le {{ now()->format('d/m/Y') }} entre les parties suivantes :</p>
        </div>
        
        <div class="parties">
            <div class="party">
                <div class="party-title">L'ORGANISME :</div>
                <p>
                    Programme de Bénéficiaires<br>
                    Adresse : 123 Boulevard Principal, Casablanca<br>
                    Représenté par : Direction du Programme<br>
                    Ci-après dénommé "l'Organisme"
                </p>
            </div>
            
            <div class="party">
                <div class="party-title">LE BÉNÉFICIAIRE :</div>
                <p>
                    {{ $candidature->prenom }} {{ $candidature->nom }}<br>
                    CIN : {{ $candidature->cin }}<br>
                    Né(e) le : {{ $candidature->date_naissance }}<br>
                    Adresse : {{ $candidature->adresse ? $candidature->adresse : 'Non spécifiée' }}<br>
                    Téléphone : {{ $candidature->tel }}<br>
                    Email : {{ $candidature->email }}<br>
                    Ci-après dénommé "le Bénéficiaire"
                </p>
            </div>
        </div>
        
        <div class="section">
            <div class="section-title">OBJET DU CONTRAT</div>
            <p>Ce contrat définit les termes et conditions selon lesquels le Bénéficiaire intègre le Programme d'Accompagnement et de Formation mis en place par l'Organisme.</p>
        </div>
        
        <div class="clauses">
            <ol>
                <li>
                    <div class="clause-title">DURÉE</div>
                    <p>Le présent contrat prend effet à la date de signature pour une durée de 12 mois. Il pourra être renouvelé sur accord des deux parties.</p>
                </li>
                
                <li>
                    <div class="clause-title">ENGAGEMENTS DU BÉNÉFICIAIRE</div>
                    <p>Le Bénéficiaire s'engage à :</p>
                    <ul>
                        <li>Participer activement à toutes les activités du programme</li>
                        <li>Respecter le règlement intérieur de l'Organisme</li>
                        <li>Assister à tous les rendez-vous programmés</li>
                        <li>Informer l'Organisme de tout changement de situation personnelle</li>
                        <li>Utiliser les ressources mises à disposition de manière responsable</li>
                    </ul>
                </li>
                
                <li>
                    <div class="clause-title">ENGAGEMENTS DE L'ORGANISME</div>
                    <p>L'Organisme s'engage à :</p>
                    <ul>
                        <li>Fournir un programme de formation adapté</li>
                        <li>Mettre à disposition les ressources nécessaires à l'apprentissage</li>
                        <li>Assurer un suivi régulier du Bénéficiaire</li>
                        <li>Délivrer une attestation à la fin du programme</li>
                    </ul>
                </li>
                
                <li>
                    <div class="clause-title">RÉSILIATION</div>
                    <p>Le contrat peut être résilié par l'une ou l'autre des parties en cas de manquement grave aux obligations contractuelles, après notification écrite.</p>
                </li>
                
                <li>
                    <div class="clause-title">CONFIDENTIALITÉ</div>
                    <p>Les parties s'engagent à respecter la confidentialité des informations échangées dans le cadre de ce programme.</p>
                </li>
            </ol>
        </div>
        
        <div class="signatures">
            <div class="signature-block">
                <div class="signature-title">Pour l'Organisme</div>
                <div class="signature-line"></div>
                <p>Nom et fonction :</p>
                <p>Date :</p>
            </div>
            
            <div class="signature-block">
                <div class="signature-title">Le Bénéficiaire</div>
                <div class="signature-line"></div>
                <p>{{ $candidature->prenom }} {{ $candidature->nom }}</p>
                <p>Date :</p>
            </div>
        </div>
        
        <div class="footer">
            <p>Document généré le {{ $generatedAt->format('d/m/Y à H:i') }} | Réf: BEN-{{ $candidature->id }}/{{ date('Y') }}</p>
            <p>© {{ date('Y') }} Programme de Bénéficiaires - Tous droits réservés</p>
        </div>
    </div>
</body>
</html> 