@extends('layouts.app')

@section('content')

<div class="container">
    <h2 class="mb-4">Ajouter une denrée</h2>
    <form action="/nourriture" method="POST" class="bg-light p-4 rounded">
        @csrf
        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" required>
        </div>
        <div class="form-group">
            <label for="quantite">Quantité</label>
            <input type="number" class="form-control" id="quantite" name="quantite" required>
        </div>
        <div class="form-group">
            <label for="type">Type</label>
            <input type="text" class="form-control" id="type" name="type" required>
        </div>
        <div class="form-group">
            <label for="date_de_peremption">Date de péremption</label>
            <input type="date" class="form-control" id="date_de_peremption" name="date_de_peremption" required>
        </div>
        <div class="form-group">
            <label for="date_de_collecte">Date de collecte</label>
            <input type="date" class="form-control" id="date_de_collecte" name="date_de_collecte" required>
        </div>
        <div class="form-group">
            <label for="lieu_de_stockage">Lieu de stockage</label>
            <input type="text" class="form-control" id="lieu_de_stockage" name="lieu_de_stockage" required>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Ajouter</button>
    </form>

    <h2 class="mt-5">Stock</h2>
    <table class="table table-striped mt-3">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Quantité</th>
                <th>Type</th>
                <th>Date de péremption</th>
                <th>Date de collecte</th>
                <th>Lieu de stockage</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($denrees as $denree)
            <tr>
                <td>{{ $denree->nom }}</td>
                <td>{{ $denree->quantite }}</td>
                <td>{{ $denree->type }}</td>
                <td>{{ $denree->date_de_peremption }}</td>
                <td>{{ $denree->date_de_collecte }}</td>
                <td>{{ $denree->lieu_de_stockage }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

@endsection

<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<script src="{{ asset('js/app.js') }}"></script>