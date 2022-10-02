<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Events') }}
            </h2>
            <x-button.secondary href="{{ route('events.create') }}">
                Create new event
            </x-button.secondary>
        </div>
    </x-slot>

    <div class="px-4 py-6 mx-auto max-w-7xl">
        <div class="grid gap-6 sm:grid-cols-2 md:grid-cols-3">
            @foreach ($events as $event)
                <a href="{{ route('events.show', $event->id) }}">
                    <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg hover:shadow-xl transition-shadow">
                        <div class="p-4 space-y-2 bg-white">
                            <h2 class="font-semibold">{{ $event->title }}
                            </h2>
                            <h3 class="italic">
                                <span class="font-semibold">{{ $event->users()->count() }}</span>
                                {{ $event->users()->count() === 1 ? 'participant' : 'participants' }}
                            </h3>
                            <h3 class="italic">
                                <span class="font-semibold">{{ $event->expenses()->count() }}</span>
                                {{ $event->expenses()->count() === 1 ? 'expense' : 'expenses' }}
                            </h3>
                            @if ($event->closed_at)
                                <div>
                                    <x-badge.danger>Closed</x-badge.danger>
                                </div>
                            @endif
                        </div>
                    </div>
                </a>
            @endforeach
            <a class="grid font-bold text-gray-500 transition-colors border-8 border-white border-dashed rounded-xl place-items-center hover:bg-gray-200"
                href="{{ route('events.create') }}">
                Create new event
            </a>
        </div>
    </div>
</x-app-layout>
