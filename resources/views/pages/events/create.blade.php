<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create new event') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="font-bold">{{ __('Create a new event') }}</h1>
                    <form class="grid grid-cols-2 md:w-1/2 gap-4 mt-4 items-center" action="{{ route('events.store') }}"
                        method="POST">
                        @csrf
                        <label for="title">
                            {{ __('Title') }}
                        </label>
                        <div>
                            <input type="text" name="title" id="title" placeholder="Title">
                            @error('title')
                                <div class="text-red-500 mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <label for="email">
                            {{ __('Email') }}
                        </label>
                        <div>
                            <input placeholder="Email" type="email" name="email" id="email">
                            @error('email')
                                <div class="text-red-500 mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit">{{ __('Create event') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
