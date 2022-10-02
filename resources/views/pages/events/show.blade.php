<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center px-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center">
                Event: {{ $event->title }}
                @if ($event->closed_at)
                    <x-badge.danger class="ml-2">
                        Closed
                    </x-badge.danger>
                @endif
            </h2>
            <div class="space-x-2 flex">
                @if ($event->closed_at)
                    <form action="{{ route('events.open', $event) }}" method="POST">
                        @csrf
                        <x-button.danger type="submit">
                            Re-open event
                        </x-button.danger>
                    </form>
                @else
                    <x-button.secondary href="{{ route('events.expenses.create', $event->id) }}">
                        Add an expense
                    </x-button.secondary>
                    <form action="{{ route('events.close', $event) }}" method="POST">
                        @csrf
                        <x-button.danger type="submit">
                            Close event
                        </x-button.danger>
                    </form>
                @endif
            </div>
        </div>
    </x-slot>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 gap-4 grid grid-cols-1 md:grid-cols-12">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg col-span-12 xl:col-span-8">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center">
                        <h2 class="mb-2 font-semibold text-xl">Expenses</h2>
                        <a href="{{ route('events.show.result', $event->id) }}">Results</a>
                    </div>
                    <div>

                        @if ($event->expenses->count() === 0)
                            <em>No expenses.</em>
                        @else
                            <div class="divide-y">
                                <div class="grid grid-cols-12 my-2">
                                    <div class="col-span-2 font-semibold">Payer</div>
                                    <div class="col-span-2 font-semibold">Title</div>
                                    <div class="col-span-2 font-semibold">Amount</div>
                                    <div class="col-span-2 font-semibold">Date</div>
                                    <div class="col-span-4 font-semibold">Participants</div>
                                </div>
                                @foreach ($event->expenses as $expense)
                                    <div class="grid grid-cols-12 py-8 text-sm">
                                        <div class="col-span-2">{{ $expense->payer->name }}</div>
                                        <div class="col-span-2">{{ $expense->title }}</div>
                                        <div class="col-span-2">€
                                            {{ number_format($expense->amount / 100, 2, ',', '.') }}</div>
                                        <div class="col-span-2">{{ $expense->created_at->format('d-m-y') }}</div>
                                        <div class="col-span-4">{{ $expense->users->map->name->join(', ') }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg col-span-12 xl:col-span-4">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="my-2 font-semibold text-xl">Participants</h2>
                    <ul>
                        @foreach ($event->users as $user)
                            <li>{{ $user->name }}</li>
                        @endforeach
                        @foreach ($event->invitedUsers as $user)
                            <li>{{ $user->email }} <em>Invited</em></li>
                        @endforeach
                        @if (!$event->closed_at)
                            <form class="flex flex-col my-2" action="{{ route('events.invite', $event) }}"
                                method="POST">
                                @csrf
                                <div class="flex">
                                    <input class="mr-2" type="email" placeholder="Email" name="email"
                                        value="{{ old('email') }}">
                                    <x-button.primary type="submit">Invite</x-button.primary>
                                </div>
                                @error('email')
                                    <div class="text-red-500 mt-2">{{ $message }}</div>
                                @enderror
                            </form>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
