@extends('layouts.app')
<link href="{{ asset('css/event.css') }}" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

@section('content')
    <div class="container">
        <h1>Détails de l'événement</h1>
        <p>ID de l'événement : {{ $event->id }}</p>
        <p>Titre : {{ $event->title_id }}</p>
        <p>Adresse : {{ $event->location }}</p>
        <p>Date de début : {{ $event->start_date }}</p>
        <p>Date de fin : {{ $event->end_date }}</p>
        <!-- Ajoutez d'autres informations sur l'événement au besoin -->
        </div>
 
	<!-- Placeholder for event details or form -->

	
	<!-- Affichage du formulaire de mise à jour -->
	<form id="edit-event-form" method="POST" action="{{ route('events.update', ':id') }}"></form>
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
</div>

    
    
@endsection

