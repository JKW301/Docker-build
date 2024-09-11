@extends('layouts.app')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

@section('content')
    <div class="container">
        <h1>Modifier le personnel</h1>
        <form method="POST" action="{{ route('personnel.update', ['user' => $user->id]) }}">
            @csrf
            @method('PUT')

            <!-- Nom -->
            <div class="form-group">
                <label for="name">Nom :</label>
                <input type="text" name="name" id="name" value="{{ $user->name }}" class="form-control">
            </div>

            <!-- Email -->
            <div class="form-group">
                <label for="email">Email :</label>
                <input type="email" name="email" id="email" value="{{ $user->email }}" class="form-control">
            </div>

            <!-- Téléphone -->
            <div class="form-group">
                <label for="telephone">Téléphone :</label>
                <input type="text" name="telephone" id="telephone" value="{{ $user->telephone }}" class="form-control">
            </div>

            <!-- Permis de conduire -->
            <div class="form-group">
                <label for="permis_de_conduire">Permis de conduire :</label>
                <input type="text" name="permis_de_conduire" id="permis_de_conduire" value="{{ $user->permis_de_conduire }}" class="form-control">
            </div>

            <!-- Rôle -->
            <div class="form-group">
                <label for="role">Rôle :</label>
                <select name="role" id="role" class="form-control">
                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="gestionnaire" {{ $user->role === 'gestionnaire' ? 'selected' : '' }}>Gestionnaire</option>
                    <option value="beneficiaire" {{ $user->role === 'beneficiaire' ? 'selected' : '' }}>Bénéficiaire</option>
                </select>
            </div>

            <!-- Ajouter les champs supplémentaires -->
            <!-- PSC1 -->
            <div class="form-group">
                <label for="psc1">PSC1 :</label>
                <input type="checkbox" name="psc1" id="psc1" value="1" {{ $user->PSC1 == 1 ? 'checked' : '' }}>
            </div>

            <!-- Permis camion -->
            <div class="form-group">
                <label for="permis_camion">Permis camion :</label>
                <input type="checkbox" name="permis_camion" id="permis_camion" value="1" {{ $user->permis_camion == 1 ? 'checked' : '' }}>
            </div>

            <!-- Cours de français -->
            <div class="form-group">
                <label for="cours_francais">Cours de français :</label>
                <input type="checkbox" name="cours_francais" id="cours_francais" value="1" {{ $user->cours_francais == 1 ? 'checked' : '' }}>
            </div>

            <!-- Aide administrative -->
            <div class="form-group">
                <label for="aide_admin">Aide administrative :</label>
                <input type="checkbox" name="aide_admin" id="aide_admin" value="1" {{ $user->aide_admin == 1 ? 'checked' : '' }}>
            </div>

            <!-- Niveau de français -->
            <div class="form-group">
                <label for="niveau_francais">Niveau de français :</label>
                <input type="text" name="niveau_francais" id="niveau_francais" value="{{ $user->niveau_de_francais }}" class="form-control">
            </div>

            <!-- Autorisations entrepôt -->
            <div class="form-group">
                <label for="autorisations_entrepot">Autorisations entrepôt :</label>
                <input type="checkbox" name="autorisations_entrepot" id="autorisations_entrepot" value="1" {{ $user->autorisations_entrepot == 1 ? 'checked' : '' }}>
            </div>

            <!-- Clé de certification (à partir d'une liste de certifications existantes) -->
            <div class="form-group">
				<label for="key_certification">Certification :</label>
				<select name="key_certification" id="key_certification" class="form-control">
					@foreach ($certifications as $certification)
						<option value="{{ $certification->id }}" {{ $user->key_certification == $certification->id ? 'selected' : '' }}>
							{{ $certification->nom }}
						</option>
					@endforeach
				</select>
			</div>


            <!-- Bouton pour enregistrer les modifications -->
            <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
        </form>
    </div>
@endsection
