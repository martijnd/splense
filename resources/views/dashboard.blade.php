<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-white">
                {{ __('Events') }}
            </h2>
            <x-button.secondary href="{{ route('events.create') }}">
                Create new event
            </x-button.secondary>
        </div>
    </x-slot>

    <div class="px-4 py-6 mx-auto max-w-7xl">
        <div class="grid gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
            @foreach ($events as $event)
                <a href="{{ route('events.show', $event->id) }}">
                    <div
                        class="transition-all bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:hover:bg-gray-900 dark:border-gray-900 hover:shadow-xl">
                        <div class="inline max-h-64">
                            <img class="rounded-t-lg" src="{{ $event->image_url }}" />
                        </div>
                        <div class="p-5">
                            <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white">
                                {{ $event->title }}</h5>
                            <p class="mb-2 font-normal text-gray-700 dark:text-white">
                                <span class="font-semibold">{{ $event->users()->count() }}</span>
                                {{ $event->users()->count() === 1 ? 'participant' : 'participants' }}
                            </p>
                            <p class="mb-2 font-normal text-gray-700 dark:text-white">
                                <span class="font-semibold">{{ $event->expenses()->count() }}</span>
                                {{ $event->expenses()->count() === 1 ? 'expense' : 'expenses' }}
                            </p>
                            <p class="mb-2 font-normal text-gray-700 dark:text-white">
                                € <span
                                    class="font-semibold">{{ number_format($event->total() / 100, 2, ',', '.') }}</span>
                                total
                            </p>
                            @if ($event->closed_at)
                                <div>
                                    <x-badge.danger>Closed</x-badge.danger>
                                </div>
                            @endif
                        </div>
                    </div>
                </a>
            @endforeach
            <a class="grid font-bold text-gray-500 transition-colors border-8 border-white border-dashed dark:text-white dark:border-gray-900 rounded-xl place-items-center hover:bg-gray-200 hover:dark:bg-gray-800"
                href="{{ route('events.create') }}">
                Create new event
            </a>
        </div>
    </div>
</x-app-layout>
