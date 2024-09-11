@extends('layouts.app')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

@section('content')
    <div class="container py-5">
        <h1>Modifier l'événement</h1>

        <form action="{{ route('service.update', ['type' => $event->title_id, 'id' => $event->id]) }}" method="POST">
            @csrf
            @method('PUT') {{-- Utilisation de la méthode PUT pour l'update --}}

            <div class="form-group">
                <label for="title_id">Titre de l'événement</label>
                <input type="text" name="title_id" id="title_id" class="form-control" value="{{ $event->title_id }}">
            </div>

            <div class="form-group">
                <label for="location">Adresse</label>
                <input type="text" name="location" id="location" class="form-control" value="{{ $event->location }}">
            </div>

            <div class="form-group">
                <label for="start_date">Date de début</label>
                <input type="datetime-local" name="start_date" id="start_date" class="form-control" value="{{ $event->start_date }}">
            </div>

            <div class="form-group">
                <label for="end_date">Date de fin</label>
                <input type="datetime-local" name="end_date" id="end_date" class="form-control" value="{{ $event->end_date }}">
            </div>

            <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
			{{-- Bouton de suppression --}}
        <form action="{{ route('service.destroy', ['type' => $event->title_id, 'id' => $event->id]) }}" method="POST" class="mt-3">
            @csrf
            @method('DELETE') {{-- Utilisation de la méthode DELETE pour la suppression --}}
            <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet événement ?')">Supprimer</button>
        </form>
        </form>
    </div>
@endsection
