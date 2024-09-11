@extends('layouts.app')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

@section('content')
<div class="container">
    <div class="row">
        <p class="h1">Détails du Cours</p>
        <div class="col-md-6">
            <div>
                <p><strong>ID:</strong> {{ $cours->id }}</p>
                <p><strong>Niveau:</strong> {{ $cours->niveau }}</p>
                <p><strong>Date Prévue:</strong> {{ $cours->date_prevue }}</p>
                <p><strong>Animateur:</strong> 
                    @if ($cours->user)
                        {{ $cours->user->name }}
                    @else
                        Animateur inconnu
                    @endif
                </p>
                <p><strong>Nombre Inscrits:</strong> {{ $nombreInscrits }} / {{ $salle->capacite_personne }}</p>
                <p><strong>Adresse:</strong> 
                    @if ($cours->salle)
                        {{ $cours->salle->adresse }}
                    @else
                        Adresse inconnue
                    @endif
                </p>
                <p><strong>ID Salle:</strong> {{ $cours->salle_id }}</p>
                <p><strong>Statut:</strong> {{ $cours->statut }}</p>
                <p><strong>Utilisateurs Inscrits:</strong></p>
                <ul>
                    @foreach ($utilisateursInscrits as $inscription)
                        @php
                            $user = App\Models\User::find($inscription->id_users);
                        @endphp
                        @if ($user)
                            <li>{{ $user->email }} 
                                <form method="POST" action="{{ route('cours.retirer', ['coursId' => $cours->id, 'userId' => $user->id]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Retirer</button>
                                </form>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>




        <div class="col-md-6">
            <h1>Modifier le Cours</h1>
            <form method="POST" action="{{ route('cours.update', $cours->id) }}">
                @csrf
                @method('PUT') <!-- Utilisation de la méthode PUT pour la mise à jour -->

                <!-- Vos champs de formulaire avec les données pré-remplies -->
                <div class="form-group">
                    <label for="niveau">Niveau :</label>
                    <input type="text" name="niveau" id="niveau" class="form-control" value="{{ $cours->niveau }}">
                </div>

                <div class="form-group">
                    <label for="start_date">Date prévue :</label>
                    <input type="datetime-local" name="start_date" id="start_date" class="form-control" value="{{ $cours->start_date }}">
                </div>
                
                <div class="form-group">
					<label for="duration">Durée du cours :</label>
					<div class="input-group">
						<input type="time" id="duration" name="duration" class="form-control">
						<span class="input-group-text">heure:minute</span>
					</div>
				</div>

                <div class="form-group">
                    <label for="animateur_id">Sélectionner un animateur :</label>
                    <select name="animateur_id" id="animateur_id" class="form-control" onchange="updateUserInfo()">
                        @foreach($animateurs as $animateur)
                        <option value="{{ $animateur->id }}" 
                            data-role="{{ $animateur->role }}" 
                            data-telephone="{{ $animateur->telephone }}"
                            data-permis="{{ $animateur->permis_de_conduire }}">
                            {{ $animateur->name }} ({{ $animateur->email }})
                        </option>
                        @endforeach
                    </select>
                </div>
				<div class="form-group">
					<label for="salle_id">Salle :</label>
					<select name="salle_id" id="salle_id" class="form-control">
						@foreach($salles_select as $salle_select)
							<option value="{{ $salle_select->id }}" {{ $salle_select->id == $cours->salle_id ? 'selected' : '' }}>
								{{ $salle_select->id }} | {{ $salle_select->adresse }} | {{ $salle_select->numero }} | {{ $salle_select->etage }} | {{ $salle_select->capacite_personne }}
							</option>
						@endforeach
					</select>
				</div>

                <div class="form-group">
                    <label for="statut">Statut :</label>
                    <select name="statut" id="statut" class="form-control">
                        <option value="fait">Fait</option>
                        <option value="oui">Oui</option>
                        <option value="non">Non</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Modifier</button>
            </form>
            
            <!-- Formulaire pour supprimer le cours -->
            <form action="{{ route('cours.destroy', $cours->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger mt-3">Supprimer ce cours</button>
            </form>
        </div>
    </div>
</div>
@endsection
