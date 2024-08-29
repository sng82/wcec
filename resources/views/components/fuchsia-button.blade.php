<div x-data="{ submitted: false }">
    <button x-on:click="submitted = !submitted"
            x-cloak
            {{ $attributes->merge([
                'class' => 'flex flex-row justify-center items-center
                text-lg h-9 w-40 bg-fuchsia-500 hover:bg-fuchsia-600
                focus:cursor-wait text-white rounded-full '
            ])}}

{{--            class="flex justify-center items-center mt-4 text-lg h-9 w-32 bg-fuchsia-500 hover:bg-fuchsia-600 focus:cursor-wait text-white rounded-full lg:ml-60"--}}
    >
        <span x-show="!submitted" class="flex flex-row justify-center items-center gap-2">
            {{ $slot }}
        </span>
        <span x-show="submitted">
            <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
              <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
        </span>
    </button>
</div>
