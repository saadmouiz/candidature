// resources/views/pdfs/contrat.blade.php
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Contrat d'Acceptation</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            color: #333;
            line-height: 1.6;
            padding: 20px;
        }
        .header {
            text-align: center;
            color: #333;
            border-bottom: 1px solid #333;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .content {
            margin-bottom: 30px;
            text-align: justify;
        }
        .footer {
            text-align: center;
            font-size: 12px;
            margin-top: 50px;
            padding-top: 10px;
            border-top: 1px solid #ccc;
        }
        .signature {
            margin-top: 50px;
        }
        .signature-line {
            border-top: 1px solid #000;
            width: 250px;
            margin-top: 70px;
        }
        .signature-container {
            display: flex;
            justify-content: space-between;
        }
        .page-break {
            page-break-after: always;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f0f0f0;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>CONTRAT D'ACCEPTATION</h1>
    </div>
    
    <div class="content">
        <p><strong>INFORMATION DU BÉNÉFICIAIRE</strong></p>
        
        <table>
            <tr>
                <th>Nom</th>
                <td>{{ $candidature->nom }}</td>
            </tr>
            <tr>
                <th>Prénom</th>
                <td>{{ $candidature->prenom }}</td>
            </tr>
            <tr>
                <th>CIN</th>
                <td>{{ $candidature->cin }}</td>
            </tr>
            <tr>
                <th>Date de naissance</th>
                <td>{{ $candidature->date_naissance }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $candidature->email }}</td>
            </tr>
            <tr>
                <th>Téléphone</th>
                <td>{{ $candidature->tel }}</td>
            </tr>
            <tr>
                <th>Niveau scolaire</th>
                <td>{{ $candidature->niveau_scolaire }}</td>
            </tr>
        </table>
        
        <h2>Article 1 : Objet du contrat</h2>
        <p>Le présent contrat a pour objet de définir les conditions d'acceptation du Bénéficiaire à notre programme de formation/accompagnement.</p>
        
        <h2>Article 2 : Durée du programme</h2>
        <p>Le programme débutera le {{ date('d/m/Y', strtotime('+1 week')) }} et se terminera le {{ date('d/m/Y', strtotime('+1 year')) }}, sauf prolongation décidée par l'organisation.</p>
        
        <h2>Article 3 : Engagements du Bénéficiaire</h2>
        <p>Le Bénéficiaire s'engage à :</p>
        <ul>
            <li>Participer activement à toutes les activités du programme</li>
            <li>Respecter le règlement intérieur de l'Organisation</li>
            <li>Informer l'Organisation de tout changement de situation susceptible d'affecter sa participation</li>
            <li>Utiliser les ressources mises à sa disposition de manière responsable</li>
        </ul>
        
        <div class="page-break"></div>
        
        <h2>Article 4 : Engagements de l'Organisation</h2>
        <p>L'Organisation s'engage à :</p>
        <ul>
            <li>Fournir au Bénéficiaire les moyens nécessaires à sa participation au programme</li>
            <li>Assurer un accompagnement adapté tout au long du programme</li>
            <li>Délivrer une attestation de participation à l'issue du programme</li>
        </ul>
        
        <h2>Article 5 : Confidentialité</h2>
        <p>Le Bénéficiaire s'engage à respecter la confidentialité des informations auxquelles il pourrait avoir accès dans le cadre du programme.</p>
        
        <h2>Article 6 : Droit applicable et juridiction compétente</h2>
        <p>Le présent contrat est soumis au droit applicable. Tout litige relatif à son interprétation ou à son exécution sera soumis aux tribunaux compétents.</p>
        
        <p>Fait le {{ date('d/m/Y') }}, en deux exemplaires originaux.</p>
        
        <div class="signature-container">
            <div>
                <p>Pour l'Organisation :</p>
                <div class="signature-line"></div>
                <p>Nom du représentant</p>
            </div>
            
            <div>
                <p>Le Bénéficiaire :</p>
                <div class="signature-line"></div>
                <p>{{ $candidature->prenom }} {{ $candidature->nom }}</p>
            </div>
        </div>
    </div>
    
    <div class="footer">
        <p>Ce document est généré automatiquement. Page 2/2</p>
    </div>
</body>
</html>