<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <img src="images/logo.png" alt="Logo" width="100" class="w-20 h-20" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf

            <!-- Name -->
            <div class="mb-4">
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mb-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mb-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mb-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                type="password"
                                name="password_confirmation" required />
            </div>
<!-- Country -->
<div class="mb-4">
    <x-label for="country" :value="__('Country')" />

    <select id="country" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="country" required onchange="updatePhonePrefix()">
        <option value="FR">{{ __('France') }}</option>
        <option value="US">{{ __('United States') }}</option>
    </select>
</div>

<!-- Phone -->
<div class="mb-4">
    <x-label for="phone" :value="__('Phone')" />

    <input id="phone" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="phone" required>
</div>

<script>
function updatePhonePrefix() {
    var countrySelect = document.getElementById('country');
    var phoneInput = document.getElementById('phone');

    if (countrySelect.value === 'FR') {
        phoneInput.value = '+33';
    } else if (countrySelect.value === 'US') {
        phoneInput.value = '+1';
    }
}
updatePhonePrefix();
</script>
<!-- Role -->
<div class="flex items-center mb-4">
    <x-label class="mr-2" for="role_beneficiaire" :value="__('Beneficiaire')" />
    <input id="role_beneficiaire" type="radio" class="shadow appearance-none border rounded text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="role" value="beneficiaire" required>

    <x-label class="ml-4 mr-2" for="role_gestionnaire" :value="__('Bénévole')" />
    <input id="role_gestionnaire" type="radio" class="shadow appearance-none border rounded text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="role" value="gestionnaire" required>
</div>

<div id="permis" style="display: none;">
    <x-label class="ml-4 mr-2" for="permis" :value="__('Détenteur du permis C1 ?')" />
    <input id="permis" type="checkbox" class="shadow appearance-none border rounded text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="permis">
</div>

<script>
    document.getElementById('role_gestionnaire').addEventListener('change', function() {
        document.getElementById('permis').style.display = this.checked ? 'block' : 'none';
    });

    document.getElementById('role_beneficiaire').addEventListener('change', function() {
        document.getElementById('permis').style.display = this.checked ? 'none' : 'block';
    });
</script>
            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
<script src="{{ asset('js/app.js') }}"></script>
</x-guest-layout>