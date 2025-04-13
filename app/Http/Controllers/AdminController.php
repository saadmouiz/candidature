<?php
namespace App\Http\Controllers;

use App\Models\Candidature;
use App\Models\Beneficiaire;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $candidatures_count = Candidature::where('status', 'en_attente')->count();
        $beneficiaires_count = Beneficiaire::count();
        
        return view('admin.index', compact('candidatures_count', 'beneficiaires_count'));
    }
}