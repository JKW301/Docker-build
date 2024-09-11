@extends('layouts.app')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link href='https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@6.1.11/main.min.css' rel='stylesheet' />
</head>
@section('content')
<div class="container">
    <h1>Ajouter un Cours de Français</h1>
    <div class="row">
        <!-- Colonne de gauche avec le formulaire -->
        <div class="col-md-6">
            <form method="POST" action="{{ route('cours.store') }}">
                @csrf

                <div class="form-group">
                    <label for="niveau">Niveau :</label>
                    <input type="text" name="niveau" id="niveau" class="form-control">
                </div>

                <div class="form-group">
                    <label for="date_prevue">Date prévue :</label>
                    <input type="datetime-local" name="start_date" id="start_date" class="form-control">
                </div>
                
                <div class="form-group">
					<label for="duration">Durée du cours :</label>
					<div class="input-group">
						<input type="time" id="duration" name="duration" class="form-control">
						<span class="input-group-text">heure:minute</span>
					</div>
				</div>
				
                <div class="form-group">
                    <label for="animateur_id">Sélectionner un animateur :</label>
                    <select name="animateur_id" id="animateur_id" class="form-control" onchange="updateUserInfo()">
                        @foreach($animateurs as $animateur)
                        <option value="{{ $animateur->id }}" 
                            data-role="{{ $animateur->role }}" 
                            data-telephone="{{ $animateur->telephone }}"
                            data-permis="{{ $animateur->permis_de_conduire }}">
                            {{ $animateur->name }} ({{ $animateur->email }})
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="salle_id">Salle :</label>
                    <select name="salle_id" id="salle_id" class="form-control">
                        @foreach($salles as $salle)
                        <option value="{{ $salle->id }}">{{ $salle->id }} | {{ $salle->adresse }} | {{ $salle->numero }} | {{ $salle->etage }} | {{ $salle->capacite_personne }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="statut">Statut :</label>
                    <select name="statut" id="statut" class="form-control">
                        <option value="fait">Fait</option>
                        <option value="oui">Oui</option>
                        <option value="non">Non</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Créer</button>
            </form>
        </div>
        <!-- Colonne de droite avec le calendrier -->
        <div class="col-md-6">
            <div id="user-info">
                @if(isset($selectedUser))
                <strong>Nom :</strong> {{ $selectedUser->name }} <br>
                <strong>Email :</strong> {{ $selectedUser->email }} <br>
                <strong>Rôle :</strong> {{ $selectedUser->role }} <br>
                <strong>Téléphone :</strong> {{ $selectedUser->telephone }} <br>
                <strong>Permis de conduire :</strong> {{ $selectedUser->permis_de_conduire }}
                @endif
            </div>
            <div class="calendar-container">
                <script src='https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@6.1.11/index.global.min.js'></script>
                <div class="card">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Planning') }}</h2>
                    <div id="calendar"></div>
                </div>
            </div>
            <div class="details-container">
                <div class="card">
                    <div class="card-body">
                        <!-- Placeholder for event details or form -->
                        <h2>Planning du bénévole</h2>
                        <div id="event-details-placeholder">
                            Sélectionnez un bénévole pour voir son planning.
                        </div>
                        @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        events: [], // Les événements seront ajoutés dynamiquement
        eventClick: function(info) {
            var eventId = info.event.id;
            fetchEventDetails(eventId);
        },
        dateClick: function(info) {
            var clickedDate = info.dateStr;
            fetchEventsForDate(clickedDate);
        }
    });
    calendar.render();

    function fetchEventDetails(eventId) {
        // Vous devez d'abord obtenir l'ID de l'utilisateur sélectionné
        var selectedUserId = document.getElementById('animateur_id').value;

        // Ensuite, vous pouvez utiliser cet ID pour récupérer les événements de cet utilisateur
        fetch('/personnel/' + selectedUserId + '/events')
            .then(response => response.json())
            .then(data => {
                // Mettre à jour le calendrier avec les événements récupérés
                calendar.removeAllEvents();
                calendar.addEventSource(data.events);
                calendar.refetchEvents();
            })
            .catch(error => {
                console.error('Erreur lors de la récupération de l\'emploi du temps : ', error);
            });
    }

    function fetchEventsForDate(date) {
        var eventDetailsPlaceholder = document.getElementById('event-details-placeholder');
        eventDetailsPlaceholder.innerHTML = 'Evénements pour la date sélectionnée : ' + date;
        document.getElementById('edit-event-form').style.display = 'none';
    }
});

</script>

    
<script>
    function updateUserInfo() {
    var select = document.getElementById('animateur_id');
    var selectedIndex = select.selectedIndex;
    var selectedOption = select.options[selectedIndex];
    var selectedUserId = selectedOption.value;
    var selectedUserName = selectedOption.text.split('(')[0].trim();
    var selectedUserEmail = selectedOption.text.split('(')[1].split(')')[0].trim();
    var selectedUserRole = selectedOption.getAttribute('data-role');
    var selectedUserTelephone = selectedOption.getAttribute('data-telephone');
    var selectedUserPermis = selectedOption.getAttribute('data-permis');
    
    var userInfo = document.getElementById('user-info');
    userInfo.innerHTML = '<strong>Nom :</strong> ' + selectedUserName + '<br>' +
        '<strong>Email :</strong> ' + selectedUserEmail + '<br>' +
        '<strong>Rôle :</strong> ' + selectedUserRole + '<br>' +
        '<strong>Téléphone :</strong> ' + selectedUserTelephone + '<br>' +
        '<strong>Permis de conduire :</strong> ' + selectedUserPermis;
}
</script>



    
@endsection

