
<div class="w-full mb-8 pt-8 flex border-t-2 border-orange-500 person-row person_row person_row_{{$nr}}">
    <div class="w-full">
        <h2 class="text-2xl font-semibold  text-gray-700 mb-4">Person {{$nr}}</h2>
    </div>
    <div class="w-full flex relative mb-4">
        <div class="w-full inline flex">
            <input type="hidden" name="person_{{$nr}}" @if($nr === 1) value="1" @else value="0" @endif id="input_person_{{$nr}}" class="input_person">

            <div class="w-name pr-2 ">
                <label for="first_name_person_{{$nr}}" class="block text-gray-700 text-sm font-semibold mb-1">First Name</label>
                <input id="first_name_person_{{$nr}}" type="text" class="form-input w-full @error('first_name_person_{{$nr}}')  border-red-500 @enderror"
                name="first_name_person_{{$nr}}" value="{{ old('first_name_person_'.$nr) }}" autocomplete="first_name_person_{{$nr}}" autofocus>
            </div>

            <div class="w-lastname pr-2">
                <label for="last_name_person_{{$nr}}" class="block text-gray-700 text-sm font-semibold mb-1">Last Name</label>
                <input id="last_name_person_{{$nr}}" type="text" class="form-input w-full @error('last_name_person_{{$nr}}')  border-red-500 @enderror"
                name="last_name_person_{{$nr}}" value="{{ old('last_name_person_'.$nr) }}" autocomplete="last_name_person_{{$nr}}" autofocus>
            </div>

            <div class="w-email pr-2">
                <label for="email_person_{{$nr}}" class="block text-gray-700 text-sm font-semibold mb-1">Email</label>
                <input id="email_person_{{$nr}}" type="email" class="form-input w-full @error('email_person_{{$nr}}')  border-red-500 @enderror"
                name="email_person_{{$nr}}" value="{{ old('email_person-'.$nr) }}" autocomplete="email_person_{{$nr}}" autofocus>
            </div>

            <div class="w-phone">
                <label for="phone_person_{{$nr}}" class="block text-gray-700 text-sm font-semibold mb-1">Phone</label>
                <input id="phone_person_{{$nr}}" type="phone" class="form-input w-full @error('phone_person_{{$nr}}')  border-red-500 @enderror"
                name="phone_person_{{$nr}}" value="{{ old('phone_person-'.$nr) }}" autocomplete="phone_person_{{$nr}}" autofocus>
            </div>
        </div>
    </div>

    @if($nr !== 1)
    <div class="w-full flex">
        <div class="flex">
            <label for="different_address_{{$nr}}" class="block text-gray-700 text-sm font-semibold mb-1 pr-2">Different&nbsp;address</label>
            <input type="checkbox" name="different_address_{{$nr}}" id="different_address_{{$nr}}" class="different_address_checkbox" data-nr="{{$nr}}">
        </div>
    </div>
    @endif
    <div class="w-full flex mb-4">
        <div class="w-full hidden_address_fields_{{$nr}} @if($nr !== 1)mt-4 hidden @endif">
            <div class="flex w-full">
                <div class="w-1/4  pr-2">
                    <label for="street_person_{{$nr}}" class="block text-gray-700 text-sm font-semibold mb-1">Street</label>
                    <input id="street_person_{{$nr}}" type="text" class="form-input w-full @error('street_person_{{$nr}}')  border-red-500 @enderror"
                    name="street_person_{{$nr}}" value="{{ old('street_person_'.$nr) }}" autocomplete="street_person_{{$nr}}" autofocus>
                </div>
                <div class="w-1/4 pr-2">
                    <label for="postal_code_person_{{$nr}}" class="block text-gray-700 text-sm font-semibold mb-1">Postal code</label>
                    <input id="postal_code_person_{{$nr}}" type="text" class="form-input w-full @error('postal_code_person_{{$nr}}')  border-red-500 @enderror"
                    name="postal_code_person_{{$nr}}" value="{{ old('postal_code_person_'.$nr) }}" autocomplete="postal_code_person_{{$nr}}" autofocus>
                </div>
                <div class="w-1/4 pr-2">
                    <label for="town_person_{{$nr}}" class="block text-gray-700 text-sm font-semibold mb-1">City/Town</label>
                    <input id="town_person_{{$nr}}" type="text" class="form-input w-full @error('town_person_{{$nr}}')  border-red-500 @enderror"
                    name="town_person_{{$nr}}" value="{{ old('town_person_'.$nr) }}" autocomplete="town_person_{{$nr}}" autofocus>
                </div>
                <div class="w-1/4">
                    <label for="country_person_{{$nr}}" class="block text-gray-700 text-sm font-semibold mb-1">
                        {{ __('Country') }}
                    </label>
                    <select name="country_person_{{$nr}}" id="country_person_{{$nr}}" class="form-input w-full">
                        @include('booking.forms.country-select-options')
                    </select>
                </div>

            </div>
        </div>
    </div>

    <div class="w-full flex">
        <div class="w-bike pr-2">
            <label for="bike_person_{{$nr}}" class="block text-gray-700 text-sm font-semibold mb-1">Bike</label>
            <select name="bike_person_{{$nr}}" id="bike_person_{{$nr}}" class="form-input w-full @error('bike_person_'.$nr)  border-red-500 @enderror">
                <option value="e-bike">E-bike</option>
                <option value="hybrid-bike">Hybrid bike</option>
            </select>
        </div>

        <div class="w-height pr-2">
            <label for="height_person_{{$nr}}" class="block text-gray-700 text-sm font-semibold mb-1">Body height</label>
            <input id="height_person_{{$nr}}" type="text" class="form-input w-full @error('height_person_{{$nr}}')  border-red-500 @enderror"
                name="height_person_{{$nr}}" value="{{ old('height_person_'.$nr) }}" autocomplete="height_person_{{$nr}}" autofocus>
        </div>

        <div class="w-food pr-2">
            <label for="food_person_{{$nr}}" class="block text-gray-700 text-sm font-semibold mb-1">Diet/Allergies</label>
            <input id="food_person_{{$nr}}" type="text" class="form-input w-full @error('food_person_{{$nr}}')  border-red-500 @enderror"
        name="food_person_{{$nr}}" value="{{ old('food_person_'.$nr) }}" autocomplete="food_person_{{$nr}}" autofocus>
        </div>

        <div class="w-room">
            <label for="cabin_person_{{$nr}}" class="block text-gray-700 text-sm font-semibold mb-1"><span class="font-semibold">Cabin</span><span class="text-xs pl-1 leading-4">(2 person)</span></label>
            @if($nr%2===1)
            <select name="cabin_person_{{$nr}}" id="cabin_person_{{$nr}}" class="form-input w-full js_coupled_room_select" data-nr="{{$nr}}">
                <option selected value="Twin cabin (separate beds)">Twin cabin (separate beds)</option>
                <option value="Double bed cabin">Double bed cabin</option>
            </select>
            @else
            <input class="form-input w-full coupled_room_input" type="text" name="coupled_cabin_person_{{$nr}}" id="coupled_cabin_person_{{$nr}}" value="Twin cabin (separate beds)">
            @endif
        </div>
    </div>
</div>
