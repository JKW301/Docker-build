<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Salle;

class SalleController extends Controller
{
    // Afficher toutes les salles
    public function index()
    {
        $salles = Salle::all();
        return view('salles.index', ['salles' => $salles]);
    }

    // Afficher le formulaire de création de salle
    public function create()
    {
        return view('salles.create');
    }

    // Enregistrer une nouvelle salle
    public function store(Request $request)
    {
        $salle = new Salle;
        $salle->adresse = $request->adresse;
        $salle->numero = $request->numero;
        $salle->etage = $request->etage;
        $salle->capacite_personne = $request->capacite_personne;
        $salle->save();

        return redirect()->route('salles.index');
    }

    // Afficher les détails d'une salle
    public function show($id)
    {
        $salle = Salle::findOrFail($id);
        return view('salles.show', ['salle' => $salle]);
    }

    // Afficher le formulaire de modification de salle
    public function edit($id)
    {
        $salle = Salle::findOrFail($id);
        return view('salles.edit', ['salle' => $salle]);
    }

    // Mettre à jour une salle existante
    public function update(Request $request, $id)
    {
        $salle = Salle::findOrFail($id);
        $salle->adresse = $request->adresse;
        $salle->numero = $request->numero;
        $salle->etage = $request->etage;
        $salle->capacite_personne = $request->capacite_personne;
        $salle->save();

        return redirect()->route('salles.index');
    }

    // Supprimer une salle
    public function destroy($id)
    {
        $salle = Salle::findOrFail($id);
        $salle->delete();

        return redirect()->route('salles.index');
    }
}

