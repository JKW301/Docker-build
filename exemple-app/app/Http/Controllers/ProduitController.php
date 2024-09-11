<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;

class ProduitController extends Controller
{
    // Afficher tous les produits
    public function index()
{
    $produits = Produit::orderBy('dlc')->get();
        return view('produit.index', ['produits' => $produits]);
        }


    // Afficher le formulaire de création d'un nouveau produit
    public function create()
    {
        return view('produits.create');
    }

    // Enregistrer un nouveau produit
    public function store(Request $request)
    {
        $produits = new Produit;
        $produits->name = $request->name;
        $produits->type = $request->type;
        $produits->dlc = $request->dlc;
        $produits->unite = $request->unite;
        $produits->poids = $request->poids;
        $produits->save();

        // Redirection vers la liste des produits
        return redirect()->route('produits.index');
    }
}

