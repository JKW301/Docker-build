<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materiel;
use App\Models\Salle;
use App\Models\Vehicule; // Ajout de la classe Vehicule

class MaterielController extends Controller
{
    // Afficher tous les matériels
    public function index()
    {
        $materiels = Materiel::all();
        $salles = Salle::all();
        $vehicules = Vehicule::all(); // Récupération des véhicules
        return view('materiel.index', ['materiels' => $materiels, 'salles' => $salles, 'vehicules' => $vehicules]);
    }
    
    public function create()
    {
        return view('materiels.create');
    }

    // Enregistrer un nouveau matériel
    public function store(Request $request)
    {
        $materiel = new Materiel;
        $materiel->Nom = $request->nom;
        $materiel->materiel_type = $request->materiel_type;
        $materiel->Description = $request->description;
        $materiel->Date_acquisition = $request->date_acquisition;
        $materiel->save();

        return redirect()->route('materiels.index');
    }

    // Enregistrer un nouveau véhicule
    public function storeVehicule(Request $request)
    {
        $vehicule = new Vehicule;
        $vehicule->vehicule_type = $request->vehicule_type;
        $vehicule->date_acquisition = $request->date_acquisition;
        $vehicule->capacite_personne = $request->capacite_personne;
        $vehicule->capacite_chargement_litres = $request->capacite_chargement_litres;
        $vehicule->save();

        return redirect()->route('materiels.index');
    }  
    
    public function storeSalle(Request $request)
    {
        $salle = new Salle;
        $salle->adresse = $request->adresse;
        $salle->numero = $request->numero;
        $salle->etage = $request->etage;
        $salle->capacite_personne = $request->capacite_personne;
        $salle->save();

        return redirect()->route('materiels.index');
    }    
}
