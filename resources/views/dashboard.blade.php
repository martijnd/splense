<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Events') }}
            </h2>
            <a class="px-4 py-2 border border-gray-300 rounded-lg" href="{{ route('events.create') }}">
                Create new event
            </a>
        </div>
    </x-slot>

    <div class="max-w-7xl py-6 mx-auto px-4">
        <div class="grid grid-cols-3 gap-6">
            @foreach ($events as $event)
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-4 bg-white">
                        <a href="{{ route('events.show', $event->id) }}">
                            <h2 class="font-semibold">{{ $event->title }}</h2>
                            <h3 class="italic">{{ $event->users()->count() }} participants</h3>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
