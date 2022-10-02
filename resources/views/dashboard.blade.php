<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Events') }}
            </h2>
            <x-button.secondary href="{{ route('events.create') }}">
                Create new event
            </x-button.secondary>
        </div>
    </x-slot>

    <div class="max-w-7xl py-6 mx-auto px-4">
        <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach ($events as $event)
                <a href="{{ route('events.show', $event->id) }}">
                    <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                        <div class="p-4 bg-white space-y-2">
                            <h2 class="font-semibold">{{ $event->title }}
                            </h2>
                            <h3 class="italic">{{ $event->users()->count() }}
                                {{ $event->users()->count() === 1 ? 'participant' : 'participants' }}</h3>
                            <h3 class="italic">{{ $event->expenses()->count() }}
                                {{ $event->expenses()->count() === 1 ? 'expense' : 'expenses' }}</h3>
                            @if ($event->closed_at)
                                <div>
                                    <x-badge.danger>Closed</x-badge.danger>
                                </div>
                            @endif
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</x-app-layout>
