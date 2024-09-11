<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Event;
use App\Models\Certification;

use Illuminate\Http\Request;

class PersonnelController extends Controller
{
     /**
     * Affiche la liste du personnel.
     *
     * @return \Illuminate\Http\Response
     */
     
    // Afficher la liste du personnel
    public function index()
    {
        
        $personnel = User::all();

        // Retourner la vue avec les données du personnel
        return view('personnel.index', ['personnel' => $personnel]);
    }
    
    public function edit(User $user)
{
    // Récupérer les données des certifications
    $certifications = Certification::all();

    // Passer les données de l'utilisateur et des certifications à la vue
    return view('personnel.edit', compact('user', 'certifications'));
}
    
public function update(Request $request, User $user)
{
    // Validation des données
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'telephone' => 'nullable|string|max:20',
        'permis_de_conduire' => 'nullable|string|max:10',
        'role' => 'required|string|in:admin,gestionnaire,beneficiaire',
        'niveau_francais' => 'nullable|string|max:255',
        'key_certification' => 'nullable|integer',
        'psc1' => 'boolean',
        'permis_camion' => 'boolean',
        'cours_francais' => 'boolean',
        'aide_admin' => 'boolean',
        'autorisations_entrepot' => 'boolean',
    ]);
        $keyCertification = isset($validatedData['key_certification']) ? $validatedData['key_certification'] : null;


    // Mettre à jour les données de l'utilisateur
    $user->update([
        'name' => $validatedData['name'],
        'email' => $validatedData['email'],
        'telephone' => $validatedData['telephone'],
        'permis_de_conduire' => $validatedData['permis_de_conduire'],
        'role' => $validatedData['role'],
        'niveau_de_francais' => $validatedData['niveau_francais'],
        'key_certification' => $keyCertification,
        'psc1' => $request->has('psc1'),
        'permis_camion' => $request->has('permis_camion'),
        'cours_francais' => $request->has('cours_francais'),
        'aide_admin' => $request->has('aide_admin'),
        'autorisations_entrepot' => $request->has('autorisations_entrepot'),
    ]);

    // Redirection avec un message de succès
    return redirect()->route('personnel.index')->with('success', 'Les informations du personnel ont été mises à jour avec succès.');
}

public function showCertificationsForm(User $user)
{
    // Récupérer toutes les certifications disponibles
    $certifications = Certification::all();

    // Retourner la vue avec les données nécessaires
    return view('personnel.certifications', compact('user', 'certifications'));
}
    
public function updateCertifications(Request $request, User $user)
    {
        // Valider les données du formulaire
        $request->validate([
            'certification_id' => 'required|exists:certification,id',
        ]);

        // Récupérer l'ID de la certification à associer à l'utilisateur
        $certificationId = $request->input('certification_id');

        // Associer la certification à l'utilisateur s'il n'est pas déjà associé
        if (!$user->certifications->contains($certificationId)) {
            $user->certifications()->attach($certificationId);
        }

        // Rediriger avec un message de succès ou afficher la vue appropriée
        return redirect()->route('personnel.certifications', ['user' => $user->id])
            ->with('success', 'Certification ajoutée avec succès.');
    }

    
    public function show(User $user)
    {
        // Retourner la vue avec les détails du personnel
        return view('personnel.show', compact('user'));
    }
    
    public function getUserEvents($userId)
{
    // Récupérer les événements de l'utilisateur avec l'ID $userId depuis la base de données
    // Vous devrez remplacer cette logique par la vôtre pour récupérer les événements appropriés
    $events = Event::where('animateur_id', $userId)->get();

    // Retourner les événements au format JSON
    return response()->json(['events' => $events]);
}


    public function events($userId)
    {
        // Recherche de l'utilisateur par son ID
        $user = User::find($userId);

        if (!$user) {
			// Rediriger l'utilisateur vers une page d'erreur ou afficher un message d'erreur
			return redirect()->route('personnel')->with('error', 'Utilisateur non trouvé.');
		}

        // Récupérer les événements où l'animateur_id correspond à l'ID de l'utilisateur
        $events = Event::where('animateur_id', $user->id)->get();

        // Passer les événements à la vue
        return view('personnel.events', compact('user', 'events'));
    }
}
