<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
            {{ __('Add a new expense') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg dark:text-white">
                <div class="p-6">
                    <h1 class="font-bold">Add a new expense for event '{{ $event->title }}'</h1>
                    <form x-data="handler()" class="grid grid-cols-2 md:w-1/2 gap-4 mt-4 items-center"
                        action="{{ route('events.expenses.store', $event) }}" method="POST">
                        @csrf
                        <label for="title">
                            Title
                        </label>
                        <div>
                            <x-text-input type="text" name="title" id="title" placeholder="Title" />
                            @error('title')
                                <div class="text-red-500 mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <label for="amount">
                            Amount
                        </label>
                        <div>
                            <x-text-input placeholder="Amount" type="text" name="amount" id="amount" />
                            @error('amount')
                                <div class="text-red-500 mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <label for="users" class="self-start">
                            Participants
                        </label>
                        <div>
                            <x-button.secondary class="mb-2" @click="selectAll()">Toggle all</x-button.secondary>
                            @foreach ($event->users as $user)
                                <div class="flex space-x-2 items-center">
                                    <label for="{{ $user->id }}">
                                        <input class="rounded dark:bg-gray-900" type="checkbox" data-participant-input
                                            name="users[{{ $user->id }}]" id="{{ $user->id }}" />
                                        <span>{{ $user->name }}</span>
                                    </label>
                                </div>
                            @endforeach
                            @error('users')
                                <div class="text-red-500 mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <x-button.primary type="submit" class="col-start-2">
                            {{ __('Create event') }}
                        </x-button.primary>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function handler() {
            return {
                selectAll() {
                    const inputs = Array.from(document.querySelectorAll('[data-participant-input]'));
                    const value = inputs.some(input => input.checked === false);
                    inputs.forEach(input => {
                        input.checked = value;
                    })
                }
            }
        }
    </script>
</x-app-layout>
