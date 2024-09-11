<?php
// app/Http/Controllers/ServiceController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\User;
use App\Models\Event;
use App\Models\Certification;

class ServiceController extends Controller
{
    public function index()
    {
        $typesDeService = Service::all();
        return view('service.index', compact('typesDeService'));
    }

public function showByType($type)
{
    // Gérer la logique en fonction du type de service
    $formattedType = str_replace('_', ' ', $type);
    $typeDeService = Service::where('type', $formattedType)->first();
    
    if (!$typeDeService) {
        abort(404); // Gérer le cas où le type de service n'est pas trouvé
    }
    
    $events = Event::where('title_id', $formattedType)->get();
    //$validEnnums = ['enfants', 'personnes_agees', 'handicap'];
	$certifications = Certification::all();
    
    $volunteers = User::whereIn('role', ['admin', 'gestionnaire'])
        ->join('user_certification', 'users.id', '=', 'user_certification.user_id')
        ->join('certification', 'certification.id', '=', 'user_certification.certification_id')
        ->get();
        
    // Retourner la vue correspondante avec les données du type de service
    return view('service/' . $type, compact('typeDeService', 'volunteers', 'events', 'certifications'));
}

public function edit($type, $id)
{
    // Récupérer l'événement à éditer en fonction du type et de l'ID
    $event = Event::findOrFail($id);

    // Retourner la vue d'édition avec les données de l'événement
    return view('service.edit', compact('event'));
}

public function update(Request $request, $type, $id)
{
    // Valider les données de la requête
    $validatedData = $request->validate([
        'title_id' => 'required', // Titre de l'événement
        'location' => 'required', // Adresse de l'événement
        'start_date' => 'required|date', // Date de début
        'end_date' => 'nullable|date', // Date de fin (optionnelle)
    ]);

    // Récupérer l'événement à mettre à jour
    $event = Event::findOrFail($id);

    // Mettre à jour les attributs de l'événement
    $event->title_id = $validatedData['title_id'];
    $event->location = $validatedData['location'];
    $event->start_date = $validatedData['start_date'];
    $event->end_date = $validatedData['end_date'];

    // Enregistrer les modifications dans la base de données
    $event->save();

    // Rediriger l'utilisateur vers une vue de succès ou une autre page
    return redirect()->route('service.index')->with('success', 'Événement mis à jour avec succès.');
}

public function destroy($type, $id)
{
    // Récupérer l'événement à supprimer
    $event = Event::findOrFail($id);

    // Supprimer l'événement de la base de données
    $event->delete();

    // Rediriger l'utilisateur vers une vue de succès ou une autre page
    return redirect()->route('service.index')->with('success', 'Événement supprimé avec succès.');
}


public function store(Request $request)
{
    // Valider les données de la requête
    $validatedData = $request->validate([
        'service_id' => 'required', // ID du type de service sélectionné
        'user_id' => 'required', // ID du bénévole sélectionné
        'date_rdv' => 'required|date', // Date du rendez-vous
        'adresse' => 'required', // Adresse de la mission de service
    ]);

    // Récupérer les données du type de service à partir de l'ID fourni dans le formulaire
    $typeDeService = Service::findOrFail($validatedData['service_id']);

    // Créer une nouvelle instance de Event avec les données validées
    $event = new Event();
    $event->title_id = $typeDeService->type; // Utiliser le type du service comme titre de la mission
    $event->animateur_id = $validatedData['user_id']; // Utiliser l'ID du bénévole comme animateur de la mission
    $event->start_date = $validatedData['date_rdv']; // Utiliser la date du rendez-vous comme date de début de la mission
    $event->end_date = null; // Vous pouvez définir la date de fin en fonction des besoins de votre application
    $event->location = $validatedData['adresse'];
    $event->key_service = $typeDeService->id; // Utiliser l'ID du type de service comme référence pour le service de la mission

    // Enregistrer la nouvelle mission de service dans la base de données
    $event->save();

    // Rediriger l'utilisateur vers une vue de succès ou une autre page après l'enregistrement
    return redirect()->route('service.index')->with('success', 'La mission de service a été créée avec succès.');
}
}
