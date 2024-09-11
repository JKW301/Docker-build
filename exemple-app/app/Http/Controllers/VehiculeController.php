<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicule;

class VehiculeController extends Controller
{
    // Afficher toutes les véhicules
    public function index()
    {
        $vehicules = Vehicule::all();
        return view('vehicules.index', ['vehicules' => $vehicules]);
    }

    // Afficher le formulaire de création de véhicule
    public function create()
    {
        return view('vehicules.create');
    }

    // Enregistrer un nouveau véhicule
    public function store(Request $request)
    {
        $vehicule = new Vehicule;
        $vehicule->vehicule_type = $request->vehicule_type;
        $vehicule->date_acquisition = $request->date_acquisition;
        $vehicule->capacite_personne = $request->capacite_personne;
        $vehicule->capacite_chargement_litres = $request->capacite_chargement_litres;
        $vehicule->save();

        return redirect()->route('vehicules.index');
    }

    // Afficher les détails d'un véhicule
    public function show($id)
    {
        $vehicule = Vehicule::findOrFail($id);
        return view('vehicules.show', ['vehicule' => $vehicule]);
    }

    // Afficher le formulaire de modification de véhicule
    public function edit($id)
    {
        $vehicule = Vehicule::findOrFail($id);
        return view('vehicules.edit', ['vehicule' => $vehicule]);
    }

    // Mettre à jour un véhicule existant
    public function update(Request $request, $id)
    {
        $vehicule = Vehicule::findOrFail($id);
        $vehicule->vehicule_type = $request->vehicule_type;
        $vehicule->date_acquisition = $request->date_acquisition;
        $vehicule->capacite_personne = $request->capacite_personne;
        $vehicule->capacite_chargement_litres = $request->capacite_chargement_litres;
        $vehicule->save();

        return redirect()->route('vehicules.index');
    }

    // Supprimer un véhicule
    public function destroy($id)
    {
        $vehicule = Vehicule::findOrFail($id);
        $vehicule->delete();

        return redirect()->route('vehicules.index');
    }
}
