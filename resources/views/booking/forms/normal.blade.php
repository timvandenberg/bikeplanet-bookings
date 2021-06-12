<div class="flex flex-wrap">
    <div class="w-full mb-4">
        <label for="name" class="block text-gray-700 text-sm font-bold mb-2">
            {{ __('Name') }}:
        </label>
        <input id="name" type="text" class="form-input w-full @error('name')  border-red-500 @enderror"
        name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
    </div>

    <div class="w-full mb-4">
        <label for="email" class="block text-gray-700 text-sm font-bold mb-2">
            {{ __('Email') }}:
        </label>
        <input id="email" type="email" class="form-input w-full @error('email')  border-red-500 @enderror"
        name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
    </div>

    <div class="w-full mb-4">
        <label for="room" class="block text-gray-700 text-sm font-bold mb-2">
            {{ __('Room') }}:
        </label>
        <select name="room" id="room" required  class="form-input w-full @error('name') border-red-500 @enderror">
            <option value="normal">Normal ( 2 seperate beds )</option>
            <option value="singles">Couples &amp; Singles ( 1 double bed )</option>
        </select>
    </div>

    @error('title')
    <p class="text-red-500 text-xs italic mt-4">
        {{ $message }}
    </p>
    @enderror
</div>
