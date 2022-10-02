@props(['class' => ''])

<x-badge classes="{{ $class }} bg-red-100 text-red-800 dark:bg-red-200 dark:text-red-900">
    {{ $slot }}
</x-badge>
