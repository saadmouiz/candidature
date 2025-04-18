<?php

namespace App\Http\Controllers;

use App\Models\Candidature;
use App\Models\Beneficiaire;
use App\Mail\ConfirmationCandidature;
use App\Mail\CandidatureAcceptee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;


class CandidatureController extends Controller
{
    public function index()
    {
        $candidatures = Candidature::where('status', 'en_attente')->paginate(10);
        
        // Get statistics for the dashboard
        $acceptedCount = Candidature::where('status', 'accepte')->count();
        $rejectedCount = Candidature::where('status', 'refuse')->count();
        $pendingCount = Candidature::where('status', 'en_attente')->count();
        $totalCount = Candidature::count();
        
        return view('candidatures.index', compact('candidatures', 'acceptedCount', 'rejectedCount', 'pendingCount', 'totalCount'));
    }

    public function create()
    {
        return view('candidatures.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'cin' => 'required|string|max:20|unique:candidatures',
            'date' => 'required|date',
            'email' => 'required|email|max:255|unique:candidatures',
            'tel' => 'required|numeric|digits:10|unique:candidatures',
            'niveau_scolaire' => 'required|in:bac,bac+2,bac+3',
            'baccalaureat' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'cin_doc' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'acte_doc' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'releve_notes' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'photo' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);
    
        // Stockage des fichiers
        $baccalaureatPath = $request->file('baccalaureat')->store('documents', 'public');
        $cinPath = $request->file('cin_doc')->store('documents', 'public');
        $actePath = $request->file('acte_doc')->store('documents', 'public');
        $releveNotesPath = $request->file('releve_notes')->store('documents', 'public');
        $photoPath = $request->file('photo')->store('photos', 'public');
    
        // Création de la candidature
        $candidature = Candidature::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'cin' => $request->cin,
            'date_naissance' => $request->date,
            'email' => $request->email,
            'tel' => $request->tel,
            'niveau_scolaire' => $request->niveau_scolaire,
            'baccalaureat_path' => $baccalaureatPath,
            'cin_path' => $cinPath,
            'acte_path' => $actePath,
            'releve_notes_path' => $releveNotesPath,
            'photo_path' => $photoPath,
            'status' => 'en_attente',
        ]);
        
        // Envoi de l'email de confirmation
        Mail::to($candidature->email)->send(new ConfirmationCandidature($candidature));
    
        return redirect()->route('merci');
    }

    public function accepter(Candidature $candidature)
{
    $candidature->update(['status' => 'accepte']);

    
    // Créer un bénéficiaire avec toutes les données de la candidature + admin connecté
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
        'photo_path' => $candidature->photo_path,
        'admin_id' => auth()->id() // Stocke l'ID de l'admin
    ]);
    

    // Envoi de l'email d'acceptation
    Mail::to($candidature->email)->send(new CandidatureAcceptee($candidature));

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

    public function refusees()
    {
        $candidatures = Candidature::where('status', 'refuse')->paginate(10);
        return view('candidatures.refusees', compact('candidatures'));
    }
    

}