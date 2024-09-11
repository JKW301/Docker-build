<!-- resources/views/certifications/index.blade.php -->

@extends('layouts.app')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

@section('content')
    <div class="container">
        <h1>Liste des Certifications</h1>
        <a class="nav-link" href="{{ route('certifications.create') }}">Ajouter Certification</a>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                @foreach($certifications as $certification)
                    <tr>
                        <td>{{ $certification->id }}</td>
                        <td>{{ $certification->nom }}</td>
                        <td>{{ $certification->description }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
