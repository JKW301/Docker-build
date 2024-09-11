<!-- resources/views/service/Navette.blade.php -->

@extends('layouts.app')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

@section('content')
<div class="container py-5">
    <h1>Navette</h1>
    <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titre</th>
                    <th>Adresse</th>
                    <th>Date de début</th>
                    <th>Date de fin</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($events as $event)
                    <tr>
                        <td>{{ $event->id }}</td>
                        <td>{{ $event->title_id }}</td>
                        <td>{{ $event->location }}</td>
                        <td>{{ $event->start_date }}</td>
                        <td>{{ $event->end_date }}</td>
                        <td>
							<a href="{{ route('service.edit', ['type' => $event->title_id, 'id' => $event->id]) }}" class="btn btn-primary">Modifier</a>
						</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Formulaire de création de mission -->
<!-- Formulaire de création de mission -->
<form action="{{ route('service.store') }}" method="POST">
    @csrf
    <input type="hidden" name="service_id" value="{{ $typeDeService->id }}">
    <div class="form-group">
        <label for="user_id">Sélectionnez un bénévole :</label>
        <select name="user_id" id="user_id" class="form-control">
            @foreach ($volunteers as $volunteer)
                @if ($volunteer->permis_de_conduire != 0 || $volunteer->permis_camion != 0)
                    <option value="{{ $volunteer->id }}">
                        {{ $volunteer->name }} - Permis voiture: {{ $volunteer->permis_de_conduire }}, Permis camion: {{ $volunteer->permis_camion }}
                    </option>
                @endif
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="date_rdv">Date du Rendez-vous :</label>
        <input type="datetime-local" name="date_rdv" id="date_rdv" class="form-control">
    </div>
    <div class="form-group">
        <label for="adresse">Adresse :</label>
        <input type="text" name="adresse" id="adresse" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Créer Mission de Service</button>
</form>

    </div>
 </div>
@endsection

