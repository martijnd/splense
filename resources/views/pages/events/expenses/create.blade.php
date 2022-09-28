<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add a new expense') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="font-bold">Add a new expense for event '{{ $event->title }}'</h1>
                    <form class="grid grid-cols-2 md:w-1/2 gap-4 mt-4 items-center"
                        action="{{ route('events.expenses.store', $event) }}" method="POST">
                        @csrf
                        <label for="title">
                            Title
                        </label>
                        <div>
                            <input type="text" name="title" id="title" placeholder="Title">
                            @error('title')
                                <div class="text-red-500 mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <label for="amount">
                            Amount
                        </label>
                        <div>
                            <input placeholder="Amount" type="text" name="amount" id="amount">
                            @error('amount')
                                <div class="text-red-500 mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <label for="users">
                            Participants
                        </label>
                        <div>
                            @foreach ($event->users as $user)
                                <div class="flex space-x-2 items-center">
                                    <label for="{{ $user->id }}">
                                        <input type="checkbox" name="users[{{ $user->id }}]"
                                            id="{{ $user->id }}">
                                        <span>{{ $user->name }}</span>
                                    </label>
                                </div>
                            @endforeach
                            @error('users')
                                <div class="text-red-500 mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="border rounded-lg px-4 py-2">Create event</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
