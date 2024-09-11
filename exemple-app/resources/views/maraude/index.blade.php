@extends('layouts.app')

<link href="{{ asset('css/event.css') }}" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

@section('content')
    <div class="container">
        <h1>Liste des maraudes</h1>

        @if(count($maraudes) > 0)
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Date</th>
                            <th>ID Bénévole</th>
                            <th>ID Véhicule</th>
                            <th>Destination</th>
                            <th>Chargement</th>
                            <th>ID Chargement</th>
                            <th>Date de début</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($maraudes as $maraude)
                            <tr>
                                <td>{{ $maraude->id }}</td>
                                <td>{{ $maraude->date }}</td>
                                <td>{{ $maraude->id_benevole }}</td>
                                <td>{{ $maraude->id_vehicule }}</td>
                                <td>{{ $maraude->destination }}</td>
                                <td>{{ $maraude->chargement }}</td>
                                <td>{{ $maraude->id_chargement }}</td>
                                <td>{{ $maraude->start_date }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p>Aucune maraude trouvée.</p>
        @endif

        <a href="{{ route('maraudes.create') }}" class="btn btn-primary">Créer une nouvelle maraude</a>
    </div>
@endsection
