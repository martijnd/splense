@props(['outlined' => ''])

<x-button {{ $attributes }}
    button-classes="{{ $outlined ? 'border-red-500 text-red-500 hover:bg-red-500 hover:text-white' : 'bg-red-600 dark:bg-red-500 text-white hover:bg-red-700 dark:hover:bg-red-600' }}">
    {{ $slot }}
</x-button>
