<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Planning') }}
        </h2>
    </x-slot>

    <div class="p-6 bg-white border-b border-gray-200">
        <h3>Your Planning</h3>
        <div id="calendar"></div>
    </div>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/calendar.js') }}"></script>
</x-app-layout>