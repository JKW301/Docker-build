@extends('layouts.app')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
@section('content')
    <div class="container">
        <h1>Événements de {{ $user->name }}</h1>
        <!-- Ajouter toutes ces colonnes : id, title_id, start_date, end_date, location, description, admin_id, max_people, min_people, participants, created_at, updated_at, materiel, salle, animateur, animateur_id -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Titre</th>
                    <th scope="col">Date de début</th>
                    <th scope="col">Date de fin</th>
                    <th scope="col">Location</th>
                    <th scope="col">Description</th>
                    <th scope="col">Admin ID</th>
                    <th scope="col">Capacité maximale</th>
                    <th scope="col">Capacité minimale</th>
                    <th scope="col">Participants</th>
                    <th scope="col">Créé le</th>
                    <th scope="col">Mis à jour le</th>
                    <th scope="col">Matériel</th>
                    <th scope="col">Salle</th>
                    <th scope="col">Animateur</th>
                    <th scope="col">ID Animateur</th>
                    <!-- Ajouter d'autres colonnes au besoin -->
                </tr>
            </thead>
            <tbody>
                @foreach($events as $event)
                    <tr>
                        <td>{{ $event->id }}</td>
                        <td>{{ $event->title_id }}</td>
                        <td>{{ $event->start_date }}</td>
                        <td>{{ $event->end_date }}</td>
                        <td>{{ $event->location }}</td>
                        <td>{{ $event->description }}</td>
                        <td>{{ $event->admin_id }}</td>
                        <td>{{ $event->max_people }}</td>
                        <td>{{ $event->min_people }}</td>
                        <td>{{ $event->participants }}</td>
                        <td>{{ $event->created_at }}</td>
                        <td>{{ $event->updated_at }}</td>
                        <td>{{ $event->materiel }}</td>
                        <td>{{ $event->salle }}</td>
                        <td>{{ $event->animateur }}</td>
                        <td>{{ $event->animateur_id }}</td>
                        <!-- Ajouter d'autres colonnes au besoin -->
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

