<link href="{{ asset('css/dons.css') }}" rel="stylesheet">
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Faire un don') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form>
                        <div>
                            <label for="name">{{ __('Votre nom') }}</label>
                            <input type="text" id="name" name="name" required>
                        </div>
                        <div>
                            <label for="email">{{ __('Votre email') }}</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                        <div>
                            <label for="amount">{{ __('Montant du don') }}</label>
                            <input type="number" id="amount" name="amount" required>
                        </div>
                        <div>
                            <label for="isCompany">{{ __('Êtes-vous une entreprise ?') }}</label>
                            <input type="checkbox" id="isCompany" name="isCompany">
                        </div>
                        <div>
                            <label for="paymentType">{{ __('Type de paiement') }}</label>
                            <select id="paymentType" name="paymentType" required>
                                <option value="">{{ __('Choisissez un type de paiement') }}</option>
                                <option value="paypal">{{ __('PayPal') }}</option>
                                <option value="creditCard">{{ __('Carte Bleue') }}</option>
                            </select>
                        </div>
                        <div>
                            <button type="submit">{{ __('Faire un don') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}"></script>
</x-app-layout>
