<div class="flex flex-wrap justify-between">
    <div class="w-32 mb-4">
        <label for="title" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
            {{ __('Title') }}
        </label>

        <input id="title" type="text" class="form-input w-full @error('title')  border-red-500 @enderror"
        name="title" value="@if(isset($tour->title)){{$tour->title}}@endif" required autocomplete="title" autofocus>
    </div>

    <div class="w-32 mb-4">
        <label for="season" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
            {{ __('Season') }}
        </label>
        <select name="season" id="season" required  class="form-input w-full @error('season') border-red-500 @enderror">
            <option @if(isset($tour->season) && $tour->season === '2021') selected @endif value="2021">2021</option>
            <option @if(isset($tour->season) && $tour->season === '2022') selected @endif value="2022">2022</option>
            <option @if(isset($tour->season) && $tour->season === '2023') selected @endif value="2023">2023</option>
            <option @if(isset($tour->season) && $tour->season === '2024') selected @endif value="2024">2024</option>
            <option @if(isset($tour->season) && $tour->season === '2025') selected @endif value="2025">2025</option>
        </select>
    </div>

    <div class="w-32 mb-4">
        <label for="price" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
            {{ __('Price') }}
        </label>

        <input id="price" type="text" class="form-input w-full @error('price') border-red-500 @enderror"
            name="price" value="@if(isset($tour->price)){{$tour->price}}@endif" required autocomplete="price" autofocus>
    </div>

    <div class="w-32 mb-4">
        <label for="max_bookings" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
            {{ __('Max bookings') }}
        </label>

        <input id="max_bookings" type="number" class="form-input w-full @error('max_bookings') border-red-500 @enderror"
            name="max_bookings" value="@if(isset($tour->max_bookings)){{$tour->max_bookings}}@else{{50}}@endif" required autocomplete="max_bookings" autofocus>
    </div>

    <div class="w-32 mb-4">
        <label for="guides" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
            {{ __('Guides') }}
        </label>

        <input id="guides" type="number" class="form-input w-full @error('guides') border-red-500 @enderror"
            name="guides" value="@if(isset($tour->guides)){{$tour->guides}}@else{{2}}@endif" required autocomplete="guides" autofocus>
    </div>

    <div class="w-32 mb-4">
        <label for="crew" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
            {{ __('Crew') }}
        </label>

        <input id="crew" type="number" class="form-input w-full @error('crew') border-red-500 @enderror"
            name="crew" value="@if(isset($tour->crew)){{$tour->crew}}@else{{4}}@endif" required autocomplete="crew" autofocus>
    </div>

    <div class="w-49 mb-4">
        <label for="start_location" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
            {{ __('Start location') }}
        </label>

        <input id="start_location" type="text" class="form-input w-full @error('start_location') border-red-500 @enderror"
            name="start_location" value="@if(isset($tour->start_location)){{$tour->start_location}}@endif" required autocomplete="start_location" autofocus>
    </div>

    <div class="w-49 mb-4">
        <label for="start_date" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
            {{ __('Start date') }}
        </label>

        <input id="start_date" type="date" class="form-input w-full @error('start_date') border-red-500 @enderror"
            name="start_date" value="@if(isset($tour->start_date)){{$tour->start_date}}@endif" required autocomplete="start_date" autofocus>
    </div>

    <div class="w-49 mb-4">
        <label for="end_location" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
            {{ __('End location') }}
        </label>

        <input id="end_location" type="text" class="form-input w-full @error('end_location') border-red-500 @enderror"
            name="end_location" value="@if(isset($tour->end_location)){{$tour->end_location}}@endif" required autocomplete="end_location" autofocus>
    </div>

    <div class="w-49 mb-4">
        <label for="end_date" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
            {{ __('End date') }}
        </label>

        <input id="end_date" type="date" class="form-input w-full @error('end_date') border-red-500 @enderror"
            name="end_date" value="@if(isset($tour->end_date)){{$tour->end_date}}@endif" required autocomplete="end_date" autofocus>
    </div>

    <div class="w-32 mb-4">
        <label for="booking_form" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
            {{ __('Formulier') }}
        </label>

        <select name="booking_form" id="booking_form" required  class="form-input w-full @error('booking_form') border-red-500 @enderror">
            <option @if(isset($tour->booking_form) && $tour->booking_form === 'normal') selected @endif value="normal">Normaal</option>
            <option @if(isset($tour->booking_form) && $tour->booking_form === 'hotel-form') selected @endif value="hotel-form">Hotel Form</option>
        </select>
    </div>

    <div class="w-full mb-4">
        <label for="invoice_text" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
            {{ __('Invoice text') }}
        </label>

        <textarea rows="5" id="invoice_text" class="form-input w-full @error('invoice_text') border-red-500 @enderror" name="invoice_text" required autocomplete="invoice_text" autofocus>
            @if(isset($tour->invoice_text)){{$tour->invoice_text}}@endif
        </textarea>
    </div>

    <div class="w-full mb-4">
        <label for="referral_code" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
            {{ __('Referral code') }}
        </label>

        <input id="referral_code" type="text" class="form-input w-full @error('referral_code') border-red-500 @enderror"
               name="referral_code" value="@if(isset($tour->referral_code)){{$tour->referral_code}}@endif" required autocomplete="referral_code" autofocus>
    </div>

    @error('title')
    <p class="text-red-500 text-xs italic mt-4">
        {{ $message }}
    </p>
    @enderror
</div>
