# Association Al Amal - Système de Gestion des Candidatures

## Vue d'ensemble

Ce projet est une plateforme web pour l'Association Al Amal qui vise à soutenir les études supérieures. Le système permet de gérer le processus de candidature, de sélection et de suivi des bénéficiaires qui reçoivent une aide pour poursuivre leurs études.

## Fonctionnalités principales

### Pour les candidats
- **Soumission de candidature** : Les étudiants peuvent postuler en ligne
- **Suivi du statut** : Notification par email de la décision (acceptation/refus)
- **Téléchargement de documents** : Les candidats peuvent fournir leurs documents nécessaires (CIN, baccalauréat, relevés de notes, etc.)

### Pour les administrateurs
- **Tableau de bord** : Vue d'ensemble des statistiques (candidatures en attente, acceptées, refusées)
- **Gestion des candidatures** : Possibilité de consulter, accepter ou refuser les candidatures
- **Gestion des bénéficiaires** : Suivi des candidats acceptés
- **Filtrage et recherche** : Recherche par nom, filtrage par niveau d'études (Bac, Bac+2, Bac+3)

## Processus d'utilisation

1. **Soumission de candidature**
   - Le candidat remplit le formulaire en ligne
   - Il télécharge les documents requis
   - Un email de confirmation est envoyé

2. **Examen de la candidature**
   - Les administrateurs examinent les dossiers soumis
   - Ils peuvent accepter ou refuser chaque candidature

3. **Notification et intégration**
   - Le candidat est notifié par email de la décision
   - En cas d'acceptation, il devient un bénéficiaire du programme

4. **Suivi des bénéficiaires**
   - Les administrateurs peuvent consulter la liste des bénéficiaires
   - Les bénéficiaires sont classés par niveau d'études

## Structure des pages

```
└── Site public
    ├── Page d'accueil (Welcome)
    ├── Formulaire de candidature
    └── Page de remerciement après soumission

└── Espace Administrateur (protégé par authentification)
    ├── Tableau de bord
    ├── Gestion des candidatures
    │   ├── Liste des candidatures en attente
    │   ├── Détails d'une candidature
    │   ├── Candidatures acceptées
    │   └── Candidatures refusées
    └── Gestion des bénéficiaires
        ├── Liste des bénéficiaires (avec filtres)
        └── Détails d'un bénéficiaire
```

## Flux de travail

```
Candidat                                       Administrateur
  │                                               │
  ├── Remplit le formulaire                       │
  │   de candidature                              │
  │                                               │
  ├── Télécharge les documents                    │
  │   requis                                      │
  │                                               │
  ├── Reçoit un email                             │
  │   de confirmation                             │
  │                                               │
  │                                               ├── Consulte les candidatures
  │                                               │   en attente
  │                                               │
  │                                               ├── Examine les dossiers et
  │                                               │   prend une décision
  │                                               │
  ├── Reçoit un email avec                        ├── Accepte ou refuse
  │   la décision                                 │   la candidature
  │                                               │
  │                                               ├── Consulte la liste des
  │                                               │   bénéficiaires
  │                                               │
  └────────────────────────────────────────────────
```

## Technologies utilisées

- **Framework**: Laravel (PHP)
- **Base de données**: MySQL
- **Frontend**: Blade, JavaScript, Tailwind CSS
- **Emails**: Laravel Mail avec SMTP
- **Stockage de fichiers**: Laravel Storage pour les documents téléchargés