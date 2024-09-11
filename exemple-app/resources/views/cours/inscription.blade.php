<!-- resources/views/cours/inscription.blade.php -->

<h1>Inscription au Cours : {{ $cours->titre }}</h1>

<p><strong>Description du Cours :</strong> {{ $cours->description }}</p>
<p><strong>Début du Cours :</strong> {{ $cours->start_date }}</p>
<!-- Ajoutez d'autres informations du cours ici -->

<form method="POST" action="{{ route('cours.inscription', $cours->id) }}">
    @csrf <!-- Ajouter le jeton CSRF pour la protection contre les attaques CSRF -->

    <button type="submit" class="btn btn-primary">S'inscrire</button>
</form>

