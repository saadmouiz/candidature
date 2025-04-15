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
    $totalCandidatures = Candidature::count();
    $totalBeneficiaires = Beneficiaire::count();

    $candidaturesEnAttente = Candidature::where('status', 'en_attente')->count();
    $candidaturesAcceptees = Candidature::where('status', 'acceptee')->count();
    $candidaturesRefusees = Candidature::where('status', 'refusee')->count();

    return view('admin.index', compact(
        'totalCandidatures',
        'totalBeneficiaires',
        'candidaturesEnAttente',
        'candidaturesAcceptees',
        'candidaturesRefusees'
    ));
}
}