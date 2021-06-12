<div class="flex flex-wrap">
    <div class="w-full mb-4">
        <label for="name" class="block text-gray-700 text-sm font-bold mb-2">
            {{ __('Name') }}:
        </label>
        <input id="name" type="text" class="form-input w-full @error('name')  border-red-500 @enderror"
        name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
    </div>

    <div class="w-full mb-4">
        <label for="bike" class="block text-gray-700 text-sm font-bold mb-2">
            {{ __('Bike') }}:
        </label>
        <select name="bike" id="bike" required  class="form-input w-full @error('bike')  border-red-500 @enderror">
            <option value="E-bike">E-bike</option>
            <option value="City bike">City bike</option>
        </select>
    </div>

    <div class="w-full mb-4">
        <label for="food" class="block text-gray-700 text-sm font-bold mb-2">
            {{ __('Food') }}:
        </label>
        <input id="food" type="text" class="form-input w-full @error('food')  border-red-500 @enderror"
        name="food" value="{{ old('food') }}" required autocomplete="food" autofocus>
    </div>

    <div class="w-full mb-4">
        <label for="hotel" class="block text-gray-700 text-sm font-bold mb-2">
            {{ __('Hotel') }}:
        </label>
        <select name="hotel" id="hotel" required  class="form-input w-full @error('hotel') border-red-500 @enderror">
            <option value="1-room">1 room</option>
            <option value="2-rooms">2 rooms</option>
        </select>
    </div>

    @error('title')
    <p class="text-red-500 text-xs italic mt-4">
        {{ $message }}
    </p>
    @enderror
</div>
