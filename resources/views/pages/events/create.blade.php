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
                    <form class="md:w-1/2 gap-4 mt-4 items-center" action="{{ route('events.store') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-2">

                            <label for="title">
                                {{ __('Title') }}
                            </label>
                            <div>
                                <input type="text" name="title" id="title" placeholder="Title">
                                @error('title')
                                    <div class="text-red-500 mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <h2 class="font-semibold">Emails</h2>
                        <div x-data="handler()">
                            <template x-for="(email, i) in emails" :key="i">
                                <div class="grid grid-cols-2 items-center">
                                    <label :for="`email-${i}`" x-text="'Email ' + (i + 1)"></label>
                                    <input :id="`email-${i}`" placeholder="Email" x-model="emails[i]" type="email"
                                        name="email[]">
                                </div>
                            </template>
                            <x-button.secondary @click="addNewEmail()">Add email</x-button.secondary>
                        </div>
                        <x-button.primary type="submit">{{ __('Create event') }}</x-button.primary>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function handler() {
            return {
                emails: [""],
                addNewEmail() {
                    this.emails = [...this.emails, ''];
                    console.log(this.emails);
                },
                removeEmail(index) {
                    this.emails.splice(index, 1);
                },
            };
        }
    </script>
</x-app-layout>
