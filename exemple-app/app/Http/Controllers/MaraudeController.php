<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Maraude;
use App\Models\Event;
use App\Models\Produit;
use App\Models\User;

class MaraudeController extends Controller
{
    // Afficher toutes les maraudes
    public function index()
    {
        $maraudes = Maraude::all();
        $produits = Produit::orderBy('dlc')->get();
    
        return view('maraude.index', ['maraudes' => $maraudes, 'produits' => $produits]);
    }
    
public function create()
{
    $produits = Produit::orderBy('dlc')->get();
    
    $benevoles_maraudes = User::where(function ($query) {
        $query->where('role', 'admin')
            ->orWhere('role', 'gestionnaire');
    })
    ->whereNotNull('permis_de_conduire')
    ->get();

    return view('maraude.create', [
        'produits' => $produits,
        'benevoles_maraudes' => $benevoles_maraudes
    ]);
}

    /* Afficher le formulaire de création d'une nouvelle maraude
    public function create()
    {
        return view('maraudes.create');
    }
    * */

    // Enregistrer une nouvelle maraude
    public function store(Request $request)
    {
        $maraude = new Maraude;
        $maraude->start_date = $request->start_date;
        $maraude->id_benevole = $request->id_benevole;
        $maraude->id_vehicule = $request->id_vehicule;
        $maraude->destination = $request->destination;
        $maraude->chargement = $request->chargement;
        $maraude->save();
        
        // Créer une entrée dans la table admin_event
        Event::create([
            'title_id' => '1',
            'start_date' => $request->start_date,
            'animateur_id' => $request->id_benevole,
            // Autres champs de admin_event
        ]);

        return redirect()->route('maraudes.index');
    }
}
