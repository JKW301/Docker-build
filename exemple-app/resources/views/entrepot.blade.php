@extends('layouts.app')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC-wk9yacJJXQlwGbgwpOx3wuAkvEexNfQ" async></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js"></script>
@section('content')


<div class="container">

    <div class="content">
        <div class="row">
            <div class="col-md-6">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Nom</th>
                            <th scope="col">Responsable</th>
                            <th scope="col">Stock maximum</th>
                            <th scope="col">Nombre de camions disponibles</th>
                            <th scope="col">Horraire</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($entrepots as $entrepot)
                        <tr data-lat="{{ $entrepot->latitude }}" data-lng="{{ $entrepot->longitude }}" class="entrepot-row">
                            <td class="entrepot-name">{{ $entrepot->localisation }}</td>
                            <td>{{ $entrepot->user_name }}</td>
                            <td>{{ $entrepot->stock_max }}</td>
                            <td>{{ $entrepot->dispo_camion_disponible }}</td>
                            <td>{{ $entrepot->horraire }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <button id="download" class="btn btn-primary">Télécharger l'itinéraire en PDF</button>
            </div>
            <div class="col-md-6">
                <div id="map" style="height: 400px;"></div>
            </div>
        </div>
    </div>
</div>


<script>
var map;
var marker;
var directionsService;
var directionsRenderer;
var start;
var destination;

function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
        zoom: 12,
        center: {lat: 49.849998, lng: 3.28333}
    });

    directionsService = new google.maps.DirectionsService();
    directionsRenderer = new google.maps.DirectionsRenderer();
    directionsRenderer.setMap(map);

    var entrepotNames = document.querySelectorAll('.entrepot-name');
    entrepotNames.forEach(function(name) {
        name.addEventListener('click', function() {
            var row = name.parentElement;
            var lat = parseFloat(row.getAttribute('data-lat'));
            var lng = parseFloat(row.getAttribute('data-lng'));
            var latLng = new google.maps.LatLng(lat, lng);
            calculateAndDisplayRoute(directionsService, directionsRenderer, latLng);
        });
    });
}

function calculateAndDisplayRoute(directionsService, directionsRenderer, dest) {
    start = new google.maps.LatLng(49.849998, 3.28333);
    destination = dest;
    directionsService.route(
        {
            origin: start,
            destination: destination,
            travelMode: 'DRIVING'
        },
        function(response, status) {
            if (status === 'OK') {
                directionsRenderer.setDirections(response);
            } else {
                window.alert('Directions request failed due to ' + status);
            }
        }
    );
}

document.getElementById('download').addEventListener('click', function() {
    var doc = new jsPDF();
    doc.text('Itinéraire entre deux entrepôts', 10, 10);
    doc.text('Départ : ' + start, 10, 20);
    doc.text('Destination : ' + destination, 10, 30);
    doc.save('itineraire.pdf');
});

window.onload = function() {
    initMap();
};
</script>
@endsection

<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<script src="{{ asset('js/calendar.js') }}"></script>
