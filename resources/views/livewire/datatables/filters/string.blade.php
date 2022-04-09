<div x-data class="flex flex-col relative">
    <input
        x-ref="input"
        type="text"
        class="m-1 pl-2 h-10 text-md leading-4 block border border-gray-200"
        wire:change="doTextFilter('{{ $index }}', $event.target.value)"
        x-on:change="$refs.input.value = ''"
    />
    <div class="flex flex-wrap max-w-48 space-x-1">
        @foreach($this->activeTextFilters[$index] ?? [] as $key => $value)
        <button wire:click="removeTextFilter('{{ $index }}', '{{ $key }}')" class="m-1 pl-1 flex items-center uppercase tracking-wide bg-gray-300 text-white hover:bg-red-600 rounded-full focus:outline-none text-xs space-x-1">
            <span>{{ $this->getDisplayValue($index, $value) }}</span>
            <x-icons.x-circle />
        </button>
        @endforeach
    </div>
    <div class="absolute right-1 top-1">
        <div class="grid place-items-center w-10 h-10 border-solid border-l border-gray-200">
            <svg width="13" height="13" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M13 11.875 9.123 7.997a5.015 5.015 0 0 0 .96-2.956A5.047 5.047 0 0 0 5.04 0 5.047 5.047 0 0 0 0 5.041a5.047 5.047 0 0 0 5.041 5.041 5.015 5.015 0 0 0 2.956-.96L11.875 13 13 11.875ZM5.041 8.49a3.45 3.45 0 1 1 0-6.898 3.45 3.45 0 0 1 0 6.898Z" fill="#241A05"/></svg>
        </div>
    </div>
</div>
