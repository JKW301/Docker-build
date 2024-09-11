@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <h1>Visites aux personnes âgées</h1>

        <form action="{{ route('service.store') }}" method="POST">
            @csrf
            <input type="hidden" name="service_id" value="{{ $typeDeService->id }}">

            <div class="form-group">
                <label for="user_id">Sélectionnez un bénévole :</label>
                <select name="user_id" id="user_id" class="form-control">
                    @foreach ($volunteers as $volunteer)
                        @foreach ($volunteer->certifications as $certification)
                            @if ($certification->ennum === 'personnes_agees')
                                <option value="{{ $volunteer->id }}">{{ $volunteer->name }}</option>
                                @break
                            @endif
                        @endforeach
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="date_rdv">Date du Rendez-vous :</label>
                <input type="datetime-local" name="date_rdv" id="date_rdv" class="form-control">
            </div>

            <div class="form-group">
                <label for="adresse">Adresse :</label>
                <input type="text" name="adresse" id="adresse" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Créer Mission de Service</button>
        </form>
    </div>
@endsection
