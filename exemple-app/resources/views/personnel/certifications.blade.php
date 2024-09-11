@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Gestion des certifications pour {{ $user->name }}</h1>

        <!-- Afficher les certifications actuelles de l'utilisateur -->
        <h2>Certifications actuelles :</h2>
        @if ($user->certifications->count() > 0)
            <ul>
                @foreach ($user->certifications as $certification)
                    <li>{{ $certification->nom }}</li>
                @endforeach
            </ul>
        @else
            <p>Aucune certification trouvée pour cet utilisateur.</p>
        @endif

        <hr>

        <!-- Formulaire pour ajouter ou retirer des certifications -->
        <form method="POST" action="{{ route('user.certifications.update', ['user' => $user->id]) }}">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="certification_id">Sélectionner une certification :</label>
        <select name="certification_id" id="certification_id" class="form-control">
            @foreach ($certifications as $certification)
                <option value="{{ $certification->id }}">{{ $certification->nom }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Ajouter Certification</button>
</form>
    </div>
@endsection
