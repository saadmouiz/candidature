<?php

namespace App\Http\Controllers;

use App\Models\Beneficiaire;
use Illuminate\Http\Request;

class BeneficiaireController extends Controller
{
    public function index()
    {
        $beneficiaires = Beneficiaire::with('candidature')->paginate(10);
        return view('beneficiaires.index', compact('beneficiaires'));
    }

    

    public function show(Beneficiaire $beneficiaire)
{
    return view('beneficiaires.show', compact('beneficiaire'));
}
}