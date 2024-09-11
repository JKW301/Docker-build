@extends('layouts.app')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

@section('content')
    <div class="container py-5"> <!-- Ajoute un padding de 5 unités (par exemple) -->
        <h1 class="text-center mb-4">Types de Service</h1>

        <div class="row justify-content-center">
            @foreach($typesDeService as $typeDeService)
                <div class="col-4 mb-3">
                    <a href="{{ route('service.showByType', str_replace(' ', '_', $typeDeService->type)) }}" class="btn btn-primary w-100 py-3"> <!-- Doublé la hauteur avec py-3 -->
                        {{ $typeDeService->type }}
                    </a>
                </div>
            @endforeach
        </div>
    </div>

@endsection
