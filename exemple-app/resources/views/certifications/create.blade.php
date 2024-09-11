<!-- resources/views/certifications/create.blade.php -->

@extends('layouts.app')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

@section('content')
    <div class="container">
        <h1>Ajouter une Certification</h1>

        <form method="POST" action="{{ route('certifications.store') }}">
            @csrf

            <div class="form-group">
                <label for="nom">Nom :</label>
                <input type="text" name="nom" id="nom" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="ennum">Type :</label>
                <select name="ennum" id="ennum" class="form-control" required>
                    <option value="enfants">Enfants</option>
                    <option value="personnes_agees">Personnes âgées</option>
                    <option value="handicap">Handicap</option>
                </select>
            </div>

            <div class="form-group">
                <label for="description">Description :</label>
                <textarea name="description" id="description" class="form-control"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Ajouter la Certification</button>
        </form>
    </div>
@endsection
