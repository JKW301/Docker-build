<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cours;
use App\Models\Salle;
use App\Models\User;
use App\Models\Event;
use App\Models\CoursInscrit;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class CoursController extends Controller
{

public function index()
{
    $cours = Cours::select(
        'cours.id', 
        'cours.niveau', 
        'cours.start_date', 
        'cours.animateur_id', 
        'cours.statut', 
        'cours.created_at', 
        'cours.updated_at', 
        'cours.salle_id', 
        'cours.end_date', 
        DB::raw('COUNT(cours_inscrits.id_cours) AS nombre_inscrits'),
        'salle.capacite_personne' // Sélectionner la colonne capacite_personne de la table Salle
    )
    ->leftJoin('cours_inscrits', 'cours.id', '=', 'cours_inscrits.id_cours')
    ->leftJoin('salle', 'cours.salle_id', '=', 'salle.id') // Joindre la table Salle
    ->groupBy(
        'cours.id', 
        'cours.niveau', 
        'cours.start_date', 
        'cours.animateur_id', 

        'cours.statut', 
        'cours.created_at', 
        'cours.updated_at', 
        'cours.salle_id', 
        'cours.end_date',
        'salle.capacite_personne' // Inclure la colonne capacite_personne dans le regroupement
    )
    ->get();

    return view('cours.index', ['cours' => $cours]);
}
    public function create()
	{
		$salles = Salle::all(); // Récupérez toutes les salles depuis le modèle Salle
		
		$animateurs = User::where(function ($query) {
			$query->where('role', 'admin')
				->orWhere('role', 'gestionnaire');
		})
		->whereNotNull('permis_de_conduire')
		->get();

		return view('cours.create', [
			'salles' => $salles,
			'animateurs' => $animateurs
		]); // Passez les salles et les animateurs à la vue
	}

public function user()
{
    return $this->belongsTo(User::class, 'animateur_id');
}

public function animateur($id)
{
    // Recherchez le cours par son ID
    $cours = Cours::findOrFail($id);

    // Récupérez les informations de l'utilisateur associé à l'animateur_id du cours
    $animateur = $cours->user;

    // Passez les informations de l'animateur à la vue
    return view('cours.animateur', compact('animateur'));
}


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'niveau' => 'required|string|max:255',
            'start_date' => 'required|date',
            'duration' => 'required|string',
            'animateur_id' => 'required|integer',
            'salle_id' => 'required|integer',
            //'nombre_inscrits' => 'required|integer|min:0',
            //'list_inscrits' => 'required|string',
            'statut' => 'required|in:fait,oui,non',
        ]);
        
        // Formater la date au format datetime
        $start_date = date('Y-m-d H:i:s', strtotime($request->start_date));
        // Calculer la date de fin en fonction de la durée du cours
		$duration = $request->duration;
		list($hours, $minutes) = explode(':', $duration);
		$end_date = date('Y-m-d H:i:s', strtotime($start_date . " +$hours hours +$minutes minutes"));
		
		$cours = Cours::create($validatedData);
			$event = Event::create([
			'title_id' => 'cours_de_français',
			'start_date' => $request->start_date,
			'end_date' => $end_date,
			'k_cours' => $cours->id, // Utilisez l'ID du cours nouvellement créé comme référence
			'animateur_id' => $request->animateur_id, // Assurez-vous que cela correspond à votre modèle de données
			// Autres champs de admin_event
		]);
        return redirect()->route('cours.index');
    }
    
public function update(Request $request, $id)
{
    // Validez les données du formulaire
    $validatedData = $request->validate([
        'niveau' => 'required|string|max:255',
        'start_date' => 'required|date',
        'duration' => 'required|string',
            'animateur_id' => 'required|integer',
            'salle_id' => 'required|integer',
            //'nombre_inscrits' => 'required|integer|min:0',
            //'list_inscrits' => 'required|string',
            'statut' => 'required|in:fait,oui,non',
        // Ajoutez d'autres règles de validation pour les autres champs
    ]);

    // Formater la date au format datetime
    $start_date = date('Y-m-d H:i:s', strtotime($request->start_date));

    // Calculer end_date comme 1 heure 30 minutes après start_date
    $end_date = date('Y-m-d H:i:s', strtotime($start_date . ' +1 hour +30 minutes'));

    // Mettez à jour le cours avec les données du formulaire, y compris end_date
    $cours = Cours::findOrFail($id);
    $cours->update($validatedData + ['end_date' => $end_date]);

    // Mettez également à jour l'événement correspondant dans la table admin_events
    $event = Event::where('title_id', 'cours_de_francais')
                  ->where('start_date', $cours->start_date)
                  ->where('animateur_id', $cours->animateur_id)
                  ->first();

    if ($event) {
        $event->update([
            'start_date' => $request->start_date,
            'end_date' => $end_date,
            // Mettez à jour d'autres champs si nécessaire
        ]);
    }

    // Redirigez l'utilisateur vers la page de détails du cours avec un message de confirmation
    return redirect()->route('cours.show', $cours->id)->with('success', 'Le cours a été modifié avec succès.');
}
    
public function show($id)
{
    // Rechercher le cours par son ID
    $cours = Cours::findOrFail($id);

    // Récupérer les animateurs pour affichage
    $animateurs = User::whereIn('role', ['admin', 'gestionnaire'])
                      ->whereNotNull('permis_de_conduire')
                      ->get();

    // Récupérer les informations sur la salle associée au cours
    $salle = Salle::findOrFail($cours->salle_id);

    // Compter le nombre d'inscrits pour ce cours
    $nombreInscrits = CoursInscrit::where('id_cours', $id)->count();
    $salles_select = Salle::all();
    
        // Récupérez la liste des utilisateurs inscrits à ce cours
    $utilisateursInscrits = CoursInscrit::where('id_cours', $id)
        ->with('user') // Charger les informations sur les utilisateurs
        ->get();

    // Passez les données du cours, des animateurs, de la salle et du nombre d'inscrits à la vue
    return view('cours.show', compact('cours', 'animateurs', 'salle', 'nombreInscrits', 'salles_select', 'utilisateursInscrits'));
}

public function retirerUtilisateur($coursId, $userId)
{
    // Recherchez l'inscription à supprimer
    $inscription = CoursInscrit::where('id_cours', $coursId)
        ->where('id_users', $userId)
        ->first();

    if ($inscription) {
        $inscription->delete(); // Supprimer l'inscription

        return redirect()->back()->with('success', 'Utilisateur retiré avec succès du cours.');
    } else {
        return redirect()->back()->with('error', 'Inscription introuvable.');
    }
}


    
    public function destroy($id)
{
    // Recherchez le cours à supprimer
    $cours = Cours::findOrFail($id);

    // Supprimez l'événement associé, si nécessaire
    $event = Event::where('title_id', 'cours')
                  ->where('start_date', $cours->start_date)
                  ->where('animateur_id', $cours->animateur_id)
                  ->first();
    if ($event) {
        $event->delete();
    }

    // Supprimez le cours
    $cours->delete();

    // Redirigez l'utilisateur vers la page des cours
    return redirect()->route('cours.index')->with('success', 'Le cours a été supprimé avec succès.');
}

public function showInscriptionForm($id)
{
    $cours = Cours::findOrFail($id);

    return view('cours.inscription', compact('cours'));
}

public function inscription($id)
{
    $userId = auth()->user()->id; // Récupérer l'ID de l'utilisateur actuellement connecté

    // Vérifier s'il existe déjà une inscription pour ce cours et cet utilisateur
    $existingInscription = CoursInscrit::where('id_cours', $id)
        ->where('id_users', $userId)
        ->exists();

    if ($existingInscription) {
        // Redirection avec un message d'erreur si l'utilisateur est déjà inscrit à ce cours
        return redirect()->route('cours.show', $id)->with('error', 'Vous êtes déjà inscrit à ce cours.');
    }

    // Vérifier si le nombre d'inscrits atteint la capacité maximale de la salle associée au cours
    $cours = Cours::find($id); // Récupérer le cours par son ID
    $salle = Salle::find($cours->salle_id); // Récupérer la salle associée au cours

    if ($salle && $cours->nombre_inscrits >= $salle->capacite_personne) {
        // Redirection avec un message d'erreur si la capacité maximale est atteinte
        return redirect()->route('cours.show', $id)->with('error', 'La capacité maximale pour ce cours est atteinte.');
    }

    // Créer une nouvelle entrée dans la table cours_inscrits
    $coursInscrit = new CoursInscrit();
    $coursInscrit->id_cours = $id; // Assigner l'ID du cours
    $coursInscrit->id_users = $userId; // Assigner l'ID de l'utilisateur
    $coursInscrit->save(); // Enregistrer l'entrée

    // Redirection avec un message de succès après inscription
    return redirect()->route('cours.show', $id)->with('success', 'Inscription réussie !');
}
/*
public function inscription($id)
{
    $userId = auth()->user()->id;

    // Créer une nouvelle entrée dans la table cours_inscrits
    $coursInscrit = new CoursInscrit();
    $coursInscrit->id_cours = $id; // Assignez l'id du cours
    $coursInscrit->id_users = $userId; // Assignez l'id de l'utilisateur
    $coursInscrit->save(); // Enregistrez l'entrée

    return redirect()->route('cours.show', $id)->with('success', 'Inscription réussie !');
}
*/
}

