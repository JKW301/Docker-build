<link href="{{ asset('css/services.css') }}" rel="stylesheet">
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Services') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @forelse ($services as $service)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h3 class="font-semibold text-lg text-gray-800 leading-tight">{{ $service->title }}</h3>
                        <p>{{ $service->description }}</p>
                        @if (Auth::user() && Auth::user()->isAdmin())
                            <button class="btn btn-primary">Modifier</button>
                            <button class="btn btn-danger">Supprimer</button>
                        @endif
                    </div>
                </div>
            @empty
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <p>Pas de service disponible</p>
                    </div>
                </div>
            @endforelse
            @if (Auth::user() && Auth::user()->isAdmin())
                <button class="btn btn-success">Ajouter</button>
            @endif
        </div>
    </div>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}"></script>
</x-app-layout>