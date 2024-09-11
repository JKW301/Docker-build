<!-- resources/views/dashboard/inscription.blade.php -->

<h1>Inscription au Cours</h1>

<div>
    <p><strong>Niveau :</strong> {{ $cours->niveau }}</p>
    <p><strong>Date de Début :</strong> {{ $cours->start_date }}</p>
    <!-- Ajoutez d'autres informations du cours ici -->
</div>

<form method="POST" action="{{ route('dashboard.store') }}">
    @csrf
    <input type="hidden" name="cours_id" value="{{ $cours->id }}">
    <!-- Ajoutez d'autres champs du formulaire d'inscription ici -->

    <button type="submit">S'inscrire</button>
</form>
