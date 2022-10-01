@props(['href', 'type' => 'button', 'buttonClasses'])

<x-button {{ $attributes }} button-classes="bg-white text-indigo-600 hover:bg-gray-50">
    {{ $slot }}
</x-button>
