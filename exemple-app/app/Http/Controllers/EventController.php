<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Materiel;
use App\Models\Salle;

class EventController extends Controller
{
    public function index()
{
    $events = Event::all();
    $personnels = User::where('role', 'admin')->get(); // Assurez-vous que le modèle User contient un attribut "role" pour identifier les administrateurs
    $materiels = Materiel::all();
    $salles = Salle::all();
    

    return view('events.index', [
        'events' => $events,
        'personnels' => $personnels,
        'materiels' => $materiels,
        'salles' => $salles,
        
    ]);
}
    
    public function calendrier()
    {
        $events = Event::all(); // Récupérer tous les événements depuis la base de données, ajustez cette requête selon vos besoins

        return view('calendar', compact('events'));
    }

    public function create()
    {
        // Récupérer la liste du personnel, du matériel et de la salle disponibles
        $personnel = User::all();
        $materiels = Materiel::all();
        $salles = Salle::all();
        
        

        // Passer les données à la vue
        return view('events.create', [
            'personnels' => $personnels,
            'materiels' => $materiels,
            'salles' => $salles,
        ]);
    }

    public function store(Request $request)
        {
            $request->validate([
                'title_id' => 'required|integer|min:1',
                // Autres règles de validation...
            ]);

            // Vérification du conflit d'horaire
            $conflictingEvents = Event::where(function ($query) use ($request) {
                $query->where('start_date', '<', $request->end_date)
                      ->where('end_date', '>', $request->start_date);
            })->get();

            if ($conflictingEvents->isNotEmpty()) {
                // S'il y a un conflit, retourner à la vue avec un message d'erreur
                return redirect()->back()->with('error', 'Conflit d\'horaire détecté. Veuillez choisir une autre heure.');
            }

            // Aucun conflit, enregistrement de l'événement
            $event = new Event;
            $event->title_id = $request->title_id;
            // Ajoutez les autres champs du formulaire...
            $event->admin_id = Auth::id();
            $event->save();

            // Redirection avec un message de succès
            return redirect()->route('events.index')->with('success', 'Événement créé avec succès.');
        }


    public function show($id)
    {
        $event = Event::findOrFail($id);
        return view('events.show', ['event' => $event]);
    }

/*
public function show($id)
{
    $event = Event::findOrFail($id);
    return view('event', ['event' => $event]);
}
*/

    public function edit($id)
    {
        $event = Event::findOrFail($id);
        return view('events.edit', ['event' => $event]);
    }

    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);
        $event->title_id = $request->title_id;
        $event->start_date = $request->start_date;
        $event->end_date = $request->end_date;
        $event->admin_id = Auth::id();
        $event->save();
    
        return redirect()->route('events.index');
    }

    public function destroy($id)
    {
        $event = Event::find($id);
        $event->delete();
    
        return redirect()->route('events.index');
    }
    
    public function getUserEvents($userId)
{
    // Interroger la base de données pour récupérer l'emploi du temps de l'utilisateur
    $events = Event::where('animateur_id', $userId)->get();

    // Renvoyer les événements au frontend
    return response()->json(['events' => $events]);
}
    
}
