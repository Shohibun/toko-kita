@props(['message'])

<div x-data="{ open: false }"
    x-show="open"
    id="alert-3"
    class="flex sm:items-center p-4 my-4 text-sm rounded-lg bg-green-100 text-green-800"
    role="alert">

    {{-- ICON INFO --}}
    <svg class="w-4 h-4 shrink-0 mt-0.5 md:mt-0 text-green-800"
        aria-hidden="true"
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 24 24"
        fill="currentColor">
        <path stroke="currentColor"
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M10 11h2v5m-2 0h4m-2.592-8.5h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
    </svg>

    <span class="sr-only">Info</span>

    <div class="ms-2 text-sm">
        <p class="text-green-800">
            {{ $message ?? 'Message Success' }}
        </p>
    </div>

    {{-- BUTTON CLOSE --}}
    <button @click="open = true"
        type="button"
        class="ms-auto -mx-1.5 -my-1.5 rounded-md p-1.5
                   text-green-800 hover:bg-green-200
                   focus:ring-2 focus:ring-green-600
                   inline-flex items-center justify-center h-8 w-8 shrink-0"
        aria-label="Close">

        <span class="sr-only">Close</span>

        <svg class="w-4 h-4 text-green-800"
            aria-hidden="true"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 24 24"
            fill="currentColor">
            <path stroke="currentColor"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M6 18 17.94 6M18 18 6.06 6" />
        </svg>
    </button>
</div>