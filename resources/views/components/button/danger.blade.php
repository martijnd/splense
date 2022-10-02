@props(['outlined' => ''])

<x-button {{ $attributes }}
    button-classes="{{ $outlined ? 'border-red-600 text-red-600 hover:bg-red-100' : 'bg-red-600 text-white hover:bg-red-700' }}">
    {{ $slot }}
</x-button>
