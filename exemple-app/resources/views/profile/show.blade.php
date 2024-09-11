
<link href="{{ asset('css/profile.css') }}" rel="stylesheet">
@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Profile') }}</div>

                <div class="card-body">
                    <p><strong>Name:</strong> {{ Auth::user()->name }}</p>
                    <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                    <p><strong>Role :</strong>{{ Auth::user()->role }}</p>
                    <p><strong>Country :</strong>{{ Auth::user()->country }}</p>
                    <p><strong>Téléphone :</strong>{{ Auth::user()->telephone}}</p>
                    <p><strong>Crée le :</strong>{{ Auth::user()->created_at }}</p>
                    <p><strong>Permis de conduire :</strong>{{ Auth::user()->permis_de_conduire }}</p>
                </div>
                <button class="btn btn-success">Mettre à jour mes informations</button>
            </div>
        </div>
    </div>
</div>
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}"></script>
@endsection