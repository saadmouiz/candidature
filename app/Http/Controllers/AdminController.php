<?php

namespace App\Http\Controllers;

use App\Models\Candidature;
use App\Models\Beneficiaire;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $candidaturesEnAttente = Candidature::where('status', 'en_attente')->count();
        $candidaturesAcceptees = Candidature::where('status', 'accepte')->count();
        $candidaturesRefusees = Candidature::where('status', 'refuse')->count();
        $totalBeneficiaires = Beneficiaire::count();

        return view('admin.index', compact(
            'candidaturesEnAttente',
            'candidaturesAcceptees',
            'candidaturesRefusees',
            'totalBeneficiaires'
        ));
    }
}