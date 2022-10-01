@props(['href', 'type' => 'button', 'buttonClasses'])


<x-button {{ $attributes }} button-classes="bg-indigo-600 text-white hover:bg-indigo-700">
    {{ $slot }}
</x-button>
