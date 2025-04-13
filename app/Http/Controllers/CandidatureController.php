<?php

namespace App\Http\Controllers;

use App\Models\Candidature;
use App\Models\Beneficiaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CandidatureController extends Controller
{
    public function index()
    {
        $candidatures = Candidature::where('status', 'en_attente')->paginate(10);
        return view('candidatures.index', compact('candidatures'));
    }

    public function create()
    {
        return view('candidatures.create');
    }

    // Correction de la méthode store
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'cin' => 'required|string|max:20|unique:candidatures',
            'date' => 'required|date',  // Nom du champ dans le formulaire
            'email' => 'required|email|max:255|unique:candidatures',
            'tel' => 'required|numeric|digits:10|unique:candidatures',  // Nom du champ dans le formulaire
            'niveau_scolaire' => 'required|in:bac,bac+2,bac+3',
            'baccalaureat' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',  // Nom du champ dans le formulaire
            'cin_doc' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',       // Nom du champ dans le formulaire
            'acte_doc' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',      // Nom du champ dans le formulaire
            'releve_notes' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',  // Nom du champ dans le formulaire
            'photo' => 'required|image|mimes:jpg,jpeg,png|max:2048',           // Nom du champ dans le formulaire
        ]);
    
        // Stockage des fichiers
        $baccalaureatPath = $request->file('baccalaureat')->store('documents', 'public');
        $cinPath = $request->file('cin_doc')->store('documents', 'public');
        $actePath = $request->file('acte_doc')->store('documents', 'public');
        $releveNotesPath = $request->file('releve_notes')->store('documents', 'public');
        $photoPath = $request->file('photo')->store('photos', 'public');
    
        // Création de la candidature
        Candidature::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'cin' => $request->cin,
            'date_naissance' => $request->date,   // stocké comme 'date_naissance'
            'email' => $request->email,
            'tel' => $request->tel,               // stocké comme 'tel' (pas 'telephone')
            'niveau_scolaire' => $request->niveau_scolaire,
            'baccalaureat_path' => $baccalaureatPath,
            'cin_path' => $cinPath,
            'acte_path' => $actePath,
            'releve_notes_path' => $releveNotesPath,
            'photo_path' => $photoPath,
            'status' => 'en_attente',
        ]);
    
        return redirect()->route('merci');
    }
    public function accepter(Candidature $candidature)
    {
        $candidature->update(['status' => 'accepte']);
        
        // Créer un bénéficiaire avec toutes les données de la candidature
        Beneficiaire::create([
            'candidature_id' => $candidature->id,
            'nom' => $candidature->nom,
            'prenom' => $candidature->prenom,
            'cin' => $candidature->cin,
            'date_naissance' => $candidature->date_naissance,
            'email' => $candidature->email,
            'tel' => $candidature->tel,
            'niveau_scolaire' => $candidature->niveau_scolaire,
            'baccalaureat_path' => $candidature->baccalaureat_path,
            'cin_path' => $candidature->cin_path,
            'acte_path' => $candidature->acte_path,
            'releve_notes_path' => $candidature->releve_notes_path,
            'photo_path' => $candidature->photo_path
        ]);
    
        return redirect()->back()->with('success', 'Candidature acceptée avec succès');
    }

    public function refuser(Candidature $candidature)
    {
        $candidature->update(['status' => 'refuse']);
        
        return redirect()->back()->with('success', 'Candidature refusée avec succès');
    }
    public function show(Candidature $candidature)
{
    return view('candidatures.show', compact('candidature'));
}
}