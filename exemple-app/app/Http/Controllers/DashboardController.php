<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Alerte; 
use App\Models\User;

class DashboardController extends Controller
{
   
    
    public function index()
    {
        $events = Event::where('start_date', '>', now())->get()->map(function ($event) {
            $event->totalInscriptions = User::where('name', $event->id)->count();
            return $event;
        });
        $alertes = Alerte::all(); 
    
        return view('dashboard.index', ['events' => $events, 'alertes' => $alertes]);
    }
    
public function showInscriptionForm($id)
{
    // Recherche du cours par son ID
    $cours = Cours::find($id);

    if (!$cours) {
        // Rediriger l'utilisateur vers une page d'erreur ou afficher un message d'erreur si le cours n'est pas trouvé
        return redirect()->route('dashboard')->with('error', 'Cours non trouvé.');
    }

    // Passer les informations du cours à la vue d'inscription
    return view('dashboard.inscription', compact('cours'));
}
    public function store(Request $request)
{
    // Traitement de l'inscription à partir des données du formulaire
    // Utilisez $request->input('cours_id') pour obtenir l'ID du cours inscrit
    // Enregistrez l'inscription dans la base de données

    return redirect()->back()->with('success', 'Inscription réussie !');
}
}
