<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Event: {{ $event->name }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if ($event->ended_at)
                        <h2>Closed at {{ $event->ended_at?->format('d-m-Y') }}</h2>
                    @endif

                    <h2 class="mt-2 font-semibold">Members</h2>
                    <ul>

                        @foreach ($event->users ?? [] as $user)
                            <li>{{ $user->name }}</li>
                        @endforeach
                    </ul>
                    <h2 class="mt-2 font-semibold">Expenses</h2>
                    <ul>
                        @foreach ($event->expenses as $expense)
                            <li>{{ $expense->title }}, € {{ number_format($expense->amount / 100, 2, ',', '.') }}</li>
                        @endforeach
                        @if ($event->expenses->count() === 0)
                            <em>No expenses.</em>
                        @endif
                    </ul>

                    <h2 class="mt-2 font-semibold">Created by</h2>
                    {{ $event->creator->name }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
