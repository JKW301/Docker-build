@extends('layouts.app')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

@section('content')
    <div class="container">
        <h1 class="mt-4">Liste du personnel</h1>
        <a class="nav-link" href="{{ route('certifications.index') }}">Certifications</a>
        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th scope="col">Nom</th>
                    <th scope="col">Email</th>
                    <th scope="col">Téléphone</th>
                    <th scope="col">Permis de conduire</th>
                    <th scope="col">Rôle</th>
                    <th scope="col">Actions</th>
                    <th scope="col">Voir</th>
                </tr>
            </thead>
            <tbody>
                @foreach($personnel as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->telephone }}</td>
                    <td>{{ $user->permis_de_conduire }}</td>
                    <td>{{ $user->role }}</td>
                    
                    <td>
                        <a href="{{ route('personnel.edit', ['user' => $user->id]) }}" class="btn btn-primary">Modifier</a>
                    </td>
                    <td>
						<a href="{{ route('personnel.certifications', ['user' => $user->id]) }}">Gérer les certifications</a>

                    </td>
                    <td>
                        <!-- Lien pour voir les événements de l'utilisateur 	-->
                        <a href="{{ route('personnel.events', ['id' => $user->id]) }}" class="btn btn-primary">Voir événements</a>
                    </td>


                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

