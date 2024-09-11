
@extends('layouts.app')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

@section('content')
<div class="container">
    <h2>Créer une nouvelle maraude</h2>
    <button id="toggleFormMaraude" class="btn btn-primary">Ajouter maraude</button>
    <form id="creationForm" method="POST" action="{{ route('maraudes.store') }}" style="display: none;">
        @csrf
        <div class="form-group">
            <label for="date">Date:</label>
            <input type="date" name="date" id="date" class="form-control">
        </div>
        
        <div class="form-group">
            <label for="benevole_id">Sélectionner un conducteur :</label>
            <select name="benevole_id" id="benevole_id" class="form-control" onchange="updateUserInfo()">
                @foreach($benevoles_maraudes as $benevole_maraude)
                <option value="{{ $benevole_maraude->id }}" data-role="{{ $benevole_maraude->role }}"
                    data-telephone="{{ $benevole_maraude->telephone }}"
                    data-permis="{{ $benevole_maraude->permis_de_conduire }}">
                    {{ $benevole_maraude->name }} ({{ $benevole_maraude->email }})
                </option>
                @endforeach
            </select>
            <div id="user-info"></div>
        </div>
        
        <div class="form-group">
            <label for="id_vehicule">ID Véhicule:</label>
            <input type="text" name="id_vehicule" id="id_vehicule" class="form-control">
        </div>
        
        <div class="form-group">
            <label for="start_date">Date de début:</label>
            <input type="datetime-local" name="start_date" id="start_date" class="form-control">
        </div>

        <div class="form-group">
            <label for="destination">Destination(s):</label>
            <input type="text" name="destination" id="destination" class="form-control">
        </div>
        
        <div class="form-group">
            <label for="chargement">Chargement(s):</label>
            <button type="button" id="addChargement" class="btn btn-success">Ajouter chargement</button>
            <div id="chargements">
                <!-- Dans la boucle de génération des chargements -->
                <div class="chargement">
                    <select name="produit[]" class="form-control">
                        <option value="">Sélectionnez un produit</option>
                        @foreach ($produits as $produit)
                        <option value="{{ $produit->id }}">{{ $produit->name }}</option>
                        @endforeach
                    </select>
                    
                    <!-- Champ d'entrée pour le poids -->
                    <input type="number" name="poids[]" class="form-control" style="display: none;" placeholder="Poids (en kg)">

                    <!-- Champ d'entrée pour l'unité -->
                    <input type="number" name="unite[]" class="form-control" style="display: none;" placeholder="Unité">
                    
                    <input type="number" name="quantite[]" class="form-control" placeholder="Quantité">
                    <button type="button" class="btn btn-danger removeChargement">Supprimer</button>
                </div>
            </div>
        </div>
        
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
</div>

<script>
    function updateUserInfo() {
        var select = document.getElementById('benevole_id');
        var selectedIndex = select.selectedIndex;
        var selectedOption = select.options[selectedIndex];
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

<script>
    document.getElementById('addChargement').addEventListener('click', function() {
        var chargements = document.getElementById('chargements');
        var newChargement = document.querySelector('.chargement').cloneNode(true);
        var selects = newChargement.querySelectorAll('select');
        selects.forEach(function(select) {
            select.value = '';
        });
        var inputs = newChargement.querySelectorAll('input[type="number"]');
        inputs.forEach(function(input) {
            input.value = '';
        });
        chargements.appendChild(newChargement);
    });

    document.addEventListener('click', function(event) {
        if (event.target && event.target.classList.contains('removeChargement')) {
            event.target.parentElement.remove();
        }
    });

    document.getElementById('toggleFormMaraude').addEventListener('click', function() {
        var form = document.getElementById('creationForm');
        if (form.style.display === 'none') {
            form.style.display = 'block';
        } else {
            form.style.display = 'none';
        }
    });

    document.getElementById('chargements').addEventListener('change', function(event) {
        if (event.target && event.target.nodeName === 'SELECT' && event.target.classList.contains('form-control')) {
            var selectedOption = event.target.options[event.target.selectedIndex];
            var poidsInput = event.target.nextElementSibling;
            var uniteInput = poidsInput.nextElementSibling;

            var poids = selectedOption.getAttribute('data-poids');
            var unite = selectedOption.getAttribute('data-unite');

            if (poids) {
                poidsInput.style.display = 'block';
                uniteInput.style.display = 'none';
            } else if (unite) {
                uniteInput.style.display = 'block';
                poidsInput.style.display = 'none';
            } else {
                poidsInput.style.display = 'none';
                uniteInput.style.display = 'none';
            }
        }
    });
</script>

@endsection
