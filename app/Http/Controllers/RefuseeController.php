<?php

namespace App\Http\Controllers;

use App\Models\Refusee;
use App\Models\Candidature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RefuseeController extends Controller
{
    /**
     * Afficher la liste des candidatures refusées
     */
    public function index()
{
    $candidatures = Refusee::with('admin')->paginate(10);
    
    return view('candidatures.refusees', compact('candidatures'));
}
    /**
     * Afficher les détails d'une candidature refusée
     */
    public function show(Refusee $refusee)
    {
        return view('candidatures.refusee-show', compact('refusee'));
    }

    /**
     * Refuser une candidature et l'enregistrer dans la table refusees
     */
    public function refuser(Candidature $candidature, Request $request)
    {
        // Mettre à jour le statut de la candidature
        $candidature->update(['status' => 'refuse']);
        
        // Créer un enregistrement dans la table refusees
        Refusee::create([
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
            'admin_id' => Auth::id(),
            'raison_refus' => $request->input('raison_refus')
        ]);
        
        return redirect()->back()->with('success', 'Candidature refusée avec succès');
    }
    
    /**
     * Rechercher parmi les candidatures refusées
     */
    public function search(Request $request)
    {
        $search = $request->input('search');
        
        $refusees = Refusee::where('nom', 'like', "%$search%")
            ->orWhere('prenom', 'like', "%$search%")
            ->orWhere('cin', 'like', "%$search%")
            ->orWhere('email', 'like', "%$search%")
            ->paginate(10);
            
        return view('candidatures.refusees', compact('refusees', 'search'));
    }
}