@props(['type' => 'button', 'classes'])

<span {{ $attributes }} class="{{ $classes }} text-xs font-semibold mr-2 px-2.5 py-0.5 rounded-lg">
    {{ $slot }}
</span>
