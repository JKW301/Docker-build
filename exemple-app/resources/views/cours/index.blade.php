@extends('layouts.app')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

@section('content')
    <div class="container">
        <h1>Liste des Cours de Français</h1>
        <a href="{{ route('cours.create') }}" class="btn btn-primary mb-3">Ajouter un cours</a>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Niveau</th>
                    <th>Date Prévue</th>
                    <th>Animateur</th> <!-- Modifier l'en-tête de la colonne -->
                    <th>Nombre Inscrits</th>
                    <th>Adresse</th>
                    <th>Numéro</th>
                    <th>Statut</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cours as $c)
                    <tr>
                        <td>{{ $c->id }}</td>
                        <td>{{ $c->niveau }}</td>
                        <td>{{ $c->start_date }}</td>
                        <td>
                            @if ($c->user)
                                {{ $c->user->name }}
                            @else
                                Animateur inconnu
                            @endif
                        </td>
                        <td>{{ $c->nombre_inscrits }} / {{ $c->capacite_personne }}</td>
                        <td>
							@if ($c->salle_addr)
								{{ $c->salle_addr->adresse }}
							@else
								Adresse inconnue
							@endif
						</td>
						<td>{{ $c->salle_id }}</td>

                        <td>{{ $c->statut }}</td>
                        <td>
                            <a href="{{ route('cours.show', $c->id) }}" class="btn btn-info">Voir détails</a> <!-- Lien vers la page dédiée au cours -->
                            <a href="{{ route('cours.inscription', $c->id) }}" class="btn btn-success">S'inscrire</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
