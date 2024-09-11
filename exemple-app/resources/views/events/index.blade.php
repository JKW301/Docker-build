@extends('layouts.app')
<link href="{{ asset('css/event.css') }}" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

@section('content')
<div class="container">
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@6.1.11/index.global.min.js'></script>

    <div class="grid-container">
        <div class="calendar-container">
            <div class="card">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Planning') }}</h2>
                <div id="calendar"></div>
            </div>
        </div>
        <div class="details-container">
            <div class="card">
                <div class="card-body">
                    <!-- Placeholder for event details or form -->
                    <h2>Détails de l'événement</h2>
                    <div id="event-details-placeholder">
                        Sélectionnez un jour pour voir les événements.
                    </div>
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    
                    <form id="edit-event-form" method="POST" action="{{ route('events.update', ':id') }}" style="display: none;">
                @csrf
                <!-- Champ pour le titre de la mission -->
                <div class="form-group">
                    <label for="title_id" class="form-label">Titre de la mission</label>
                    <select id="title_id" name="title_id" class="form-control">
                        <option value="">Sélectionner un évenement</option>
                        <option value="1">Maraude</option>
                        <option value="2">Distribution alimentaire</option>
                        <option value="3">Aides aux devoirs</option>
                        <option value="4">Cours d'alaphabetisations</option>
                        <option value="5">Assistances administratives</option>
                        <option value="6">Collecte de dons</option>
                    </select>
                </div>

                <!-- Autres champs pour la mise à jour de l'événement -->
                <!-- ... -->

                <!-- Bouton de soumission du formulaire de mise à jour -->
                <button type="submit" class="btn btn-primary float-right">Mettre à jour l'événement</button>
            </form>
                    
                    <button id="toggle-store-form-btn" class="btn btn-primary mt-3">Créer Mission</button>
                    
                    <div id="store-event-form" style="display: none;">
                        <form method="POST" action="{{ route('events.store') }}" class="p-3">
                            @csrf
                            <div class="form-group">
                                <label for="title_id" class="form-label">Titre de la mission</label>
                                <select id="title_id" name="title_id" class="form-control">
                                    <option value="">Sélectionner un évenement</option>
                                    <option value="1">Maraude</option>
                                    <option value="2">Distribution alimentaire</option>
                                    <option value="3">Aides aux devoirs</option>
                                    <option value="4">Cours d'alaphabetisations</option>
                                    <option value="5">Assistances administratives</option>
                                    <option value="6">Collecte de dons</option>
                                </select>
                            </div>
                            
                            <!-- Sélection du personnel -->
                            <div class="form-group">
                                <label for="personnel_id" class="form-label">Sélectionner le personnel</label>
                                <select id="personnel_id" name="personnel_id" class="form-control">
                                    <option value="">Sélectionner le personnel</option>
                                    @foreach($personnels as $personnel)
                                    <option value="{{ $personnel->id }}">{{ $personnel->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Sélection du matériel -->
                            <div class="form-group">
                                <label for="materiel_id" class="form-label">Sélectionner le matériel</label>
                                <select id="materiel_id" name="materiel_id" class="form-control">
                                    <option value="">Sélectionner le matériel</option>
                                    @foreach($materiels as $materiel)
                                    <option value="{{ $materiel->id }}">{{ $materiel->type }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Sélection de la salle -->
                            <div class="form-group">
                                <label for="salle_id" class="form-label">Sélectionner la salle</label>
                                <select id="salle_id" name="salle_id" class="form-control">
                                    <option value="">Sélectionner la salle</option>
                                    @foreach($salles as $salle)
                                    <option value="{{ $salle->id }}">{{ $salle->adresse }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="description" class="form-label">Description</label>
                                <textarea id="description" name="description" class="form-control"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="location" class="form-label">Location</label>
                                <input id="location" type="text" name="location" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="min_capacity" class="form-label">Capacité minimale</label>
                                <input id="min_capacity" type="number" name="min_people" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="max_capacity" class="form-label">Capacité maximale</label>
                                <input id="max_capacity" type="number" name="max_people" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="start_date" class="form-label">Date de début</label>
                                <input id="start_date" type="datetime-local" name="start_date" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="end_date" class="form-label">Date de fin</label>
                                <input id="end_date" type="datetime-local" name="end_date" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-primary float-right">Créer Mission</button>
                        </form>
                    </div>
                    
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const eventSelect = document.getElementById('event_id');

        eventSelect.addEventListener('change', function () {
            const selectedEventId = eventSelect.value;
            const updateForm = document.getElementById('edit-event-form');
            const formAction = "{{ route('events.update', ':id') }}".replace(':id', selectedEventId);
            updateForm.setAttribute('action', formAction);
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var events = [
            @foreach($events as $event)
            {
                title: getTitleById('{{ $event->title_id }}'),
                start: '{{ $event->start_date }}',
                end: '{{ $event->end_date }}',
                id: '{{ $event->id }}'
            },
            @endforeach
        ];

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: events,
            eventClick: function(info) {
                // Fetch event details when an event is clicked
                var eventId = info.event.id;
                fetchEventDetails(eventId);
            },
            dateClick: function(info) {
                // Fetch events for the clicked date
                var clickedDate = info.dateStr;
                fetchEventsForDate(clickedDate);
            }
        });
        calendar.render();

        function getTitleById(titleId) {
            switch (titleId) {
                case '1':
                    return 'Maraude';
                case '2':
                    return 'Distribution alimentaire';
                case '3':
                    return 'Aides aux devoirs';
                case '4':
                    return 'Cours d\'alphabétisation';
                case '5':
                    return 'Assistance administrative';
                case '6':
                    return 'Collecte de dons';
                default:
                    return '';
            }
        }

        function fetchEventDetails(eventId) {
    // Replace this with your code to fetch event details
    // For demonstration purposes, here we update the placeholder with event details
    var eventDetailsPlaceholder = document.getElementById('event-details-placeholder');
    // Creating a link to the event page
    var eventLink = document.createElement('a');
    eventLink.href = '/events/' + eventId; // Assuming the route is defined as '/events/{id}'
    eventLink.textContent = 'Détails de l\'événement sélectionné : ' + eventId;
    eventDetailsPlaceholder.innerHTML = ''; // Clearing any previous content
    eventDetailsPlaceholder.appendChild(eventLink); // Adding the link to the placeholder

    // Show the edit event form
    document.getElementById('edit-event-form').style.display = 'block';
}


        function fetchEventsForDate(date) {
            // Replace this with your code to fetch events for the clicked date
            // For demonstration purposes, here we update the placeholder with the clicked date
            var eventDetailsPlaceholder = document.getElementById('event-details-placeholder');
            eventDetailsPlaceholder.innerHTML = 'Evénements pour la date sélectionnée : ' + date;
            // Hide the edit event form
            document.getElementById('edit-event-form').style.display = 'none';
        }
        
        
    });

    document.addEventListener('DOMContentLoaded', function() {
        var toggleUpdateFormBtn = document.getElementById('toggle-update-form-btn');
        var editEventForm = document.getElementById('edit-event-form');
        toggleUpdateFormBtn.addEventListener('click', function() {
            if (editEventForm.style.display === 'none') {
                editEventForm.style.display = 'block';
            } else {
                editEventForm.style.display = 'none';
            }
        });

        var toggleStoreFormBtn = document.getElementById('toggle-store-form-btn');
        var storeEventForm = document.getElementById('store-event-form');
        toggleStoreFormBtn.addEventListener('click', function() {
            if (storeEventForm.style.display === 'none') {
                storeEventForm.style.display = 'block';
            } else {
                storeEventForm.style.display = 'none';
            }
        });
    });
    
</script>

<style>
    .grid-container {
        display: grid;
        grid-template-columns: 1fr 1fr; /* Diviser en deux colonnes */
        gap: 20px; /* Espacement entre les colonnes */
    }

    .calendar-container {
        grid-column: 1; /* Première colonne */
    }

    .details-container {
        grid-column: 2; /* Deuxième colonne */
    }
</style>

@endsection

