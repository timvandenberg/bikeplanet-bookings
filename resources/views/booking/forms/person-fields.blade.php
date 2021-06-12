
<div class="w-full mb-4 pb-4 flex border-b person-row person_row person_row_{{$nr}}">
    <div class="w-full flex">
        <div class="text-md mr-10">{{$nr}}.</div>
        <div class="w-full inline flex">
            <input type="hidden" name="person_{{$nr}}" @if($nr === 1) value="1" @else value="0" @endif id="input_person_{{$nr}}" class="input_person">

            <div class="w-1/4 pr-2">
                <input id="name_person_{{$nr}}" type="text" class="form-input w-full @error('name_person_{{$nr}}')  border-red-500 @enderror"
                name="name_person_{{$nr}}" value="{{ old('name_person_'.$nr) }}" autocomplete="name_person_{{$nr}}" autofocus>
            </div>

            <div class="w-1/4 pr-2">
                <input id="email_person_{{$nr}}" type="email" class="form-input w-full @error('email_person_{{$nr}}')  border-red-500 @enderror"
                name="email_person_{{$nr}}" value="{{ old('email_person-'.$nr) }}" autocomplete="email_person_{{$nr}}" autofocus>
            </div>

            <div class="w-1/4 pr-2">
                <select name="bike_person_{{$nr}}" id="bike_person_{{$nr}}" class="form-input w-full @error('bike_person_'.$nr)  border-red-500 @enderror">
                    <option value="E-bike">E-bike</option>
                    <option value="City bike">City bike</option>
                </select>
            </div>

            <div class="w-1/4 pr-2">
                <input id="food_person_{{$nr}}" type="text" class="form-input w-full @error('food_person_{{$nr}}')  border-red-500 @enderror"
            name="food_person_{{$nr}}" value="{{ old('food_person_'.$nr) }}" autocomplete="food_person_{{$nr}}" autofocus>
            </div>
        </div>
    </div>
</div>
