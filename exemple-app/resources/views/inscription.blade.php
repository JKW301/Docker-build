<link href="{{ asset('css/inscription.css') }}" rel="stylesheet">
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Inscription à l\'événement') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="post" action="/inscription">
                        @csrf
                        <label for="nom">Nom :</label>
                        <input type="text" id="nom" name="nom" value="{{ $user->name }}">

                        <label for="email">Email :</label>
                        <input type="email" id="email" name="email" value="{{ $user->email }}">

                        <label for="telephone">Téléphone :</label>
                        <input type="text" id="telephone" name="telephone" value="{{ $user->telephone }}">

                        <input type="submit" value="S'inscrire">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}"></script>
</x-app-layout>