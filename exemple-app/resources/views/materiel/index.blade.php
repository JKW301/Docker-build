@extends('layouts.app')
<link href="{{ asset('css/event.css') }}" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">


@section('content')
    <div class="container">
        <h1>Liste de matériel</h1>
<h2>Matériels :</h2>
<div class="table-responsive"> 
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Type</th>
                <th>Description</th>
                <th>Date d'acquisition</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($materiels as $materiel)
                <tr>
                    <td>{{ $materiel->ID }}</td>
                    <td>{{ $materiel->Nom }}</td>
                    <td>{{ $materiel->Type }}</td>
                    <td>{{ $materiel->Description }}</td>
                    <td>{{ $materiel->Date_acquisition }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<h2>Véhicules :</h2>
<div class="table-responsive"> 
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Type</th>
                <th>Date d'acquisition</th>
                <th>Capacité en personnes</th>
                <th>Capacité de chargement (litres)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($vehicules as $vehicule)
                <tr>
                    <td>{{ $vehicule->ID }}</td>
                    <td>{{ $vehicule->vehicule_type }}</td>
                    <td>{{ $vehicule->Date_acquisition }}</td>
                    <td>{{ $vehicule->capacite_personne }}</td>
                    <td>{{ $vehicule->Capacite_chargement_litres }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>


        <h2>Salles :</h2>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Adresse</th>
                        <th>Numéro</th>
                        <th>Étage</th>
                        <th>Capacité en personnes</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($salles as $salle)
                        <tr>
                            <td>{{ $salle->id }}</td>
                            <td>{{ $salle->adresse }}</td>
                            <td>{{ $salle->numero }}</td>
                            <td>{{ $salle->etage }}</td>
                            <td>{{ $salle->capacite_personne }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <h1>Ajouter un nouveau matériel</h1>
			<button id="toggleFormMateriel" class="btn btn-primary">Ajouter matériel</button>
			<form id="creationForm" method="POST" action="{{ route('materiels.store') }}" style="display: none;">
				@csrf
				<label for="nom">Nom :</label>
					<input type="text" id="nom" name="nom" required><br><br>
				<label for="materiel_type">Type :</label>
					<input type="text" id="materiel_type" name="materiel_type" required><br><br>
				<label for="description">Description :</label>
					<input type="text" id="description" name="description"><br><br>
				<label for="date_acquisition">Date d'acquisition :</label>
					<input type="date" id="date_acquisition" name="date_acquisition" required><br><br>
				
				<button type="submit" class="btn btn-primary">Créer</button>
			</form>

			<h1>Ajouter un nouveau véhicule</h1>
			<button id="toggleFormVehicule" class="btn btn-primary">Ajouter véhicule</button>
			<form id="creationFormVehicule" method="POST" action="{{ route('vehicules.store') }}" style="display: none;">
				@csrf
				<label for="vehicule_type">Type :</label>
					<input type="text" id="vehicule_type" name="vehicule_type" required><br><br>
				<label for="date_acquisition">Date d'acquisition :</label>
					<input type="date" id="date_acquisition" name="date_acquisition" required><br><br>
				<label for="capacite_personne">Capacité en personnes :</label>
					<input type="number" id="capacite_personnes" name="capacite_personnes" required><br><br>
				<label for="capacite_chargement_litres">Capacité de chargement (litres) :</label>
					<input type="number" id="capacite_chargement_litres" name="capacite_chargement_litres" required><br><br>
				<button type="submit" class="btn btn-primary">Créer</button>
			</form>

        
        <h1>Créer une nouvelle salle</h1>

        <button id="toggleFormSalle" class="btn btn-primary">Ajouter</button>

        <form id="creationFormSalle" method="POST" action="{{ route('salles.store') }}" style="display: none;">
            @csrf
            <div class="form-group">
                <label for="adresse">Adresse:</label>
                <input type="text" name="adresse" id="adresse" class="form-control">
            </div>
            <div class="form-group">
                <label for="numero">Numéro:</label>
                <input type="text" name="numero" id="numero" class="form-control">
            </div>
            <div class="form-group">
                <label for="etage">Étage:</label>
                <input type="text" name="etage" id="etage" class="form-control">
            </div>
            <div class="form-group">
                <label for="capacite_personne">Capacité en personnes:</label>
                <input type="number" name="capacite_personne" id="capacite_personne" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Créer</button>
        </form>
    </div>

    <script>
        document.getElementById('toggleFormMateriel').addEventListener('click', function() {
            var form = document.getElementById('creationForm');
            if (form.style.display === 'none') {
                form.style.display = 'block';
            } else {
                form.style.display = 'none';
            }
        });
        
        document.getElementById('toggleFormVehicule').addEventListener('click', function() {
            var form = document.getElementById('creationFormVehicule');
            if (form.style.display === 'none') {
                form.style.display = 'block';
            } else {
                form.style.display = 'none';
            }
        });
        
        document.getElementById('toggleFormSalle').addEventListener('click', function() {
            var form = document.getElementById('creationFormSalle');
            if (form.style.display === 'none') {
                form.style.display = 'block';
            } else {
                form.style.display = 'none';
            }
        });
    </script>
@endsection

