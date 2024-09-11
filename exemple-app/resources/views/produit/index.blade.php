@extends('layouts.app')
<link href="{{ asset('css/event.css') }}" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

@section('content')
    <div class="container">
        <h1>Liste des produits</h1>

        <!-- Tableau des produits -->
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Quantité</th>
                        <th>Unité</th>
                        <th>Poids</th>
                        <th>DLC</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($produits as $produit)
                        <tr>
                            <td>{{ $produit->name }}</td>
                            <td>{{ $produit->type }}</td>
                            <td>{{ $produit->unite }}</td>
                            <td>{{ $produit->poids }}</td>
                            <td>{{ $produit->dlc }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Formulaire d'ajout de produit -->
        <h2>Ajouter un nouveau produit</h2>
        <form method="POST" action="{{ route('produits.store') }}">
            @csrf
            <div class="form-group">
                <label for="name">Nom :</label>
                <input type="text" name="name" id="name" class="form-control">
            </div>
            <div class="form-group">
                <label for="type">Type :</label>
                <select name="type" id="type" class="form-control">
                    <option value="fruit_legume_frais">Fruit ou Légume frais</option>
                    <option value="conserve">Conserve</option>
                    <option value="pates">Pâtes</option>
                    <option value="ramen">Ramen</option>
                    <option value="riz">Riz</option>
                    <!-- Ajoutez d'autres options selon vos types de produits -->
                </select>
            </div>
            
            <div class="form-group">
                <label for="unite">Unité :</label>
                <input type="text" name="unite" id="unite" class="form-control">
            </div>
            <div class="form-group">
                <label for="poids">Poids :</label>
                <input type="number" name="poids" id="poids" class="form-control">
            </div>
            <div class="form-group">
                <label for="dlc">Date limite de consommation :</label>
                <input type="date" name="dlc" id="dlc" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
    </div>
@endsection

