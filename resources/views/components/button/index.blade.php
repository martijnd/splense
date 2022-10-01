@props(['href', 'type' => 'button', 'buttonClasses', 'classes' => $buttonClasses . ' w-full flex items-center justify-center px-4 py-2 border border-transparent text-base font-medium rounded-md'])

<div {{ $attributes->merge(['class' => 'rounded-md shadow']) }}>
    @isset($href)
        <a href="{{ $href }}" class="{{ $classes }}">
            {{ $slot }}
        </a>
    @else
        <button type="{{ $type }}" class="{{ $classes }}">
            {{ $slot }}
        </button>
    @endisset
</div>
