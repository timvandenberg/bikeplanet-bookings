<div class="flex flex-wrap">

    <div class="flex justify-between w-full mb-5">
        <div class="form-field-radio">
            <label for="gender" class="block text-gray-700 text-sm font-semibold mb-2">
                &nbsp;
            </label>
            <div class="flex w-full mb-3">
                <input id="input_male" type="radio" name="gender" value="male" required>
                <label for="input_male" class="pl-1 text-gray-700 text-sm font-semibold">Mr.</label>
            </div>

            <div class="flex w-full">
                <input id="input_female" type="radio" name="gender" value="female" required>
                <label for="input_female" class="pl-1 text-gray-700 text-sm font-semibold">Ms.</label>
            </div>
        </div>

        <div class="form-field-quarter">
            <label for="first_name" class="block text-gray-700 text-sm font-semibold mb-2">
                {{ __('First name') }}
            </label>
            <input id="first_name" type="text" class="form-input w-full @error('first_name')  border-red-500 @enderror"
            name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>
        </div>

        <div class="form-field-last-name">
            <label for="last_name" class="block text-gray-700 text-sm font-semibold mb-2">
                {{ __('Last name') }}
            </label>
            <input id="last_name" type="text" class="form-input w-full @error('last_name')  border-red-500 @enderror"
            name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>
        </div>

        <div class="form-field-quarter">
            <label for="birth_date" class="block text-gray-700 text-sm font-semibold mb-2">
                {{ __('Birth date') }}
            </label>
            <input type="date" name="birth_date" class="form-input w-full" required>
        </div>
    </div>

    <div class="flex justify-between w-full mb-5">
        <div class="form-field-half">
            <label for="email" class="block text-gray-700 text-sm font-semibold mb-2">
                {{ __('Email') }}
            </label>
            <input id="email" type="email" class="form-input w-full @error('email') border-red-500 @enderror"
            name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
        </div>
        <div class="form-field-half">
            <div class="flex">
                <label for="phone" class="block text-gray-700 text-sm font-semibold mb-2">
                    {{ __('Telephone number') }}

                </label>
                <span class="text-xs pl-2 leading-4"> (preferably reachable in europe)</span>
            </div>
            <input id="phone" type="phone" class="form-input w-full @error('phone') border-red-500 @enderror"
            name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>
        </div>
    </div>

    <div class="flex justify-between w-full mb-5">
        <div class="form-field-third">
            <label for="street" class="block text-gray-700 text-sm font-semibold mb-2">
                {{ __('Street + House nr') }}
            </label>
            <input id="street" type="street" class="form-input w-full @error('street') border-red-500 @enderror"
            name="street" value="{{ old('street') }}" required autocomplete="street" autofocus>
        </div>

        <div class="form-field-sixth">
            <label for="postal_code" class="block text-gray-700 text-sm font-semibold mb-2">
                {{ __('Postal code') }}
            </label>
            <input id="postal_code" type="postal_code" class="form-input w-full @error('postal_code') border-red-500 @enderror"
            name="postal_code" value="{{ old('postal_code') }}" required autocomplete="postal_code" autofocus>
        </div>

        <div class="form-field-third">
            <label for="town" class="block text-gray-700 text-sm font-semibold mb-2">
                {{ __('Town') }}
            </label>
            <input id="town" type="town" class="form-input w-full @error('town') border-red-500 @enderror"
            name="town" value="{{ old('town') }}" required autocomplete="town" autofocus>
        </div>

        <div class="form-field-sixth">
            <label for="country" class="block text-gray-700 text-sm font-semibold mb-2">
                {{ __('Country') }}
            </label>
            <select name="country" id="country" class="form-input w-full">
                @include('booking.forms.country-select-options')
            </select>
        </div>
    </div>

    @error('title')
    <p class="text-red-500 text-xs italic mt-4">
        {{ $message }}
    </p>
    @enderror
</div>
