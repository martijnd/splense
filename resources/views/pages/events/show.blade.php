<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col items-center justify-between px-4 md:flex-row">
            <h2 class="flex items-center text-xl font-semibold leading-tight text-gray-800 dark:text-white">
                Event: {{ $event->title }}
                @if ($event->closed_at)
                    <x-badge.danger class="ml-2">
                        Closed
                    </x-badge.danger>
                @endif
            </h2>
            <div class="flex space-x-2">
                @if (!$event->closed_at)
                    <x-button.secondary href="{{ route('events.expenses.create', $event->id) }}">
                        Add an expense
                    </x-button.secondary>
                @endif
                @if ($event->user_id === auth()->id())
                    @if ($event->closed_at)
                        <form action="{{ route('events.open', $event) }}" method="POST">
                            @csrf
                            <x-button.danger type="submit" outlined>
                                Re-open event
                            </x-button.danger>
                        </form>
                    @else
                        <form action="{{ route('events.close', $event) }}" method="POST">
                            @csrf
                            <x-button.danger type="submit">
                                Close event
                            </x-button.danger>
                        </form>
                    @endif
                @endif
            </div>
        </div>
    </x-slot>
    <div class="py-6">
        <div class="grid grid-cols-1 gap-4 mx-auto max-w-7xl sm:px-6 lg:px-8 md:grid-cols-12">
            <div
                class="col-span-12 overflow-hidden bg-white shadow-sm dark:text-white dark:bg-gray-800 sm:rounded-lg lg:col-span-8">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <h2 class="mb-2 text-xl font-semibold">Expenses</h2>
                        <x-button.secondary href="{{ route('events.show.result', $event->id) }}">Results
                        </x-button.secondary>
                    </div>
                    <div>

                        @if ($event->expenses->count() === 0)
                            <em>No expenses.</em>
                        @else
                            <div class="divide-y">
                                <div class="grid grid-cols-12 my-2">
                                    <div class="col-span-2 font-semibold">Payer</div>
                                    <div class="col-span-3 font-semibold md:col-span-2">Title</div>
                                    <div class="col-span-3 font-semibold md:col-span-2">Amount</div>
                                    <div class="hidden font-semibold md:block md:col-span-2">Date</div>
                                    <div class="col-span-4 font-semibold">Participants</div>
                                </div>
                                @foreach ($event->expenses as $expense)
                                    <div class="grid grid-cols-12 py-8 text-sm">
                                        <div class="col-span-2">{{ $expense->payer->name }}</div>
                                        <div class="col-span-3 md:col-span-2">{{ $expense->title }}</div>
                                        <div class="col-span-3 md:col-span-2">€
                                            {{ number_format($expense->amount / 100, 2, ',', '.') }}</div>
                                        <div class="hidden md:block col-span-0 md:col-span-2">
                                            {{ $expense->created_at->format('d-m-y') }}</div>
                                        <div class="col-span-4">{{ $expense->users->map->name->join(', ') }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-span-12 lg:col-span-4">
                <div class="p-6 overflow-hidden bg-white dark:bg-gray-800 dark:text-white border-gray-200 rounded-lg">
                    <h2 class="my-2 text-xl font-semibold">People</h2>
                    <ul class="space-y-1">
                        @foreach ($event->users as $user)
                            <li>{{ $user->name }}</li>
                        @endforeach
                        @foreach ($event->invitedUsers as $user)
                            <li>{{ $user->email }} <em>Invited</em></li>
                        @endforeach
                    </ul>
                    @if (!$event->closed_at && $event->user_id === auth()->id())
                        <form class="flex flex-col my-2" action="{{ route('events.invite', $event) }}" method="POST">
                            @csrf
                            <div class="flex flex-col space-y-2 sm:flex-row sm:space-y-0 sm:space-x-2">
                                <x-text-input class="w-full" type="email" placeholder="Email" name="email"
                                    value="{{ old('email') }}" />
                                <x-button.primary type="submit">Invite</x-button.primary>
                            </div>
                            @error('email')
                                <div class="mt-2 text-red-500">{{ $message }}</div>
                            @enderror
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
