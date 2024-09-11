<form method="POST" action="{{ route('alertes.store') }}">
    @csrf
    <div>
        <label for="event_id">{{ __('Choisir un événement') }}</label>
        <select id="event_id" name="event_id" required>
            @foreach ($events as $event)
                <option value="{{ $event->id }}">{{ $event->title }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label for="title">{{ __('Titre de l\'alerte') }}</label>
        <input type="text" id="title" name="title" required>
    </div>
    <div>
        <label for="description">{{ __('Description de l\'alerte') }}</label>
        <textarea id="description" name="description" required></textarea>
    </div>
    <div>
        <button type="submit">{{ __('Créer une alerte') }}</button>
    </div>
</form>