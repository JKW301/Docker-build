<?php

namespace App\Http\Controllers;

use App\Models\Nourriture;

class NourritureController extends Controller
{
    public function index()
    {
        $denrees = Nourriture::all();

        return view('nourriture', ['denrees' => $denrees]);
    }
public function store(Request $request)
{
    $denree = new Nourriture;
    $denree->nom = $request->nom;
    $denree->quantite = $request->quantite;
    $denree->type = $request->type;
    $denree->date_de_peremption = $request->date_de_peremption;
    $denree->date_de_collecte = $request->date_de_collecte;
    $denree->lieu_de_stockage = $request->lieu_de_stockage;
    $denree->save();

    return redirect('/nourriture');
}

}