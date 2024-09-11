<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Actualité') }}
                </h2>
            </div>
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Evenements à venir') }}
                </h2>
                <table class="table-auto w-full">
                    <thead>
                        <tr>
                            <th>Titre</th>
                            <th>Date de début</th>
                            <th>Date de fin</th>
                            <th>Description</th>
                            <th>Localisation</th>
                            <th>Nombre de personne requise</th>
                            <th>Nombre de personnes inscrites</th>
                            <th>Inscription</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($events as $event)
                            <tr>
                                <td>{{ $event->title_id }}</td>
                                <td>{{ $event->start_date }}</td>
                                <td>{{ $event->end_date }}</td>
                                <td>{{ $event->description }}</td>
                                <td>{{ $event->location }}</td>
                                <td>{{ $event->max_people }}</td>
                                <<td>{{ $event->totalInscriptions }}</td>
                                <!-- Lien avec l'ID du cours comme paramètre dans l'URL -->
<td>
    <a href="{{ route('dashboard.inscription', ['id' => $cours->id]) }}">Inscription</a>
</td>

</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8">Pas d'événements à venir</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!--
                <div class="p-6 bg-white border-b border-gray-200">
					<h2 class="font-semibold text-xl text-gray-800 leading-tight">
						{{ __('Alerte') }}
					</h2>
					@forelse ($alertes as $alert)
						<div>
							<h3>{{ $alert->title }}</h3>
							<p>Lieu: {{ $alert->location }}</p>
							<p>Date: {{ $alert->date }}</p>
							<p>Personne Manquante : </p>
						</div>
					@empty
						<p>Pas d'alerte prévue</p>
					@endforelse
				</div>
				-->

            </div>
        </div>
    </div>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}"></script>
</x-app-layout>
