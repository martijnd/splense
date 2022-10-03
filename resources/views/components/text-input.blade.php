@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' =>
        'dark:bg-gray-700 w-full dark:placeholder:text-gray-400 rounded-md shadow-sm border-gray-300 dark:border-gray-800 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50',
]) !!}>
