<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create new event') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="font-bold">{{ __('Create a new event') }}</h1>
                    <form class="gap-4 mt-4 items-center" action="{{ route('events.store') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-2">
                            <label for="title">
                                {{ __('Title') }}
                            </label>
                            <div>
                                <x-text-input class="w-full" type="text" name="title" id="title"
                                    placeholder="Title" />
                                @error('title')
                                    <div class="text-red-500 mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        {{-- Image --}}
                        <div class="grid grid-cols-2 mt-8" x-data="imageHandler()">
                            <label for="image">Image</label>
                            <div class="flex space-x-2">
                                <x-text-input type="text" name="image" id="image"
                                    placeholder="Search images..." />
                                <x-button.secondary class="flex-grow" @click="searchImage()">Search</x-button.secondary>
                            </div>
                            <div class="grid grid-cols-3 col-span-2 mt-4 gap-2">
                                <template x-for="(image, i) in images">
                                    <button @click="() => setImage(image.src.large)" type="button"
                                        :class="`hover:ring-2 ring-purple-900 inline-block mx-auto ${selected === image.src.large ? 'ring-purple-900 ring-2' : ''}`">
                                        <img :src="image.src.small" :alt="image.alt" :title="image.alt">
                                    </button>
                                </template>
                            </div>
                            <input type="hidden" name="image_url" id="image_url">
                        </div>
                        <h2 class="font-semibold text-lg mt-8">Emails</h2>
                        <div x-data="emailHandler()" class="space-y-4 mb-4">
                            <template x-for="(email, i) in emails" :key="i">
                                <div class="grid grid-cols-2 items-center">
                                    <label :for="`email-${i}`" x-text="'Email ' + (i + 1)"></label>
                                    <x-text-input ::id="`email-${i}`" placeholder="Email" x-model="emails[i]"
                                        type="email" name="emails[]" />
                                </div>
                            </template>
                            <div class="flex justify-end">
                                <x-button.secondary class="w-1/2" @click="addNewEmail()">
                                    &plus; Add email
                                </x-button.secondary>
                            </div>
                        </div>
                        <x-button.primary type="submit">{{ __('Create event') }}</x-button.primary>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function imageHandler() {
            return {
                selected: null,
                images: [],
                async searchImage(eventId) {
                    const imageInput = document.getElementById('image');
                    const json = await fetch(`/search-image?query=${imageInput.value}`);
                    const res = await json.json();
                    console.log(res);
                    this.images = res.photos;
                },
                setImage(imageUrl) {
                    console.log(imageUrl);
                    this.selected = imageUrl;
                    const imageUrlInput = document.getElementById('image_url');
                    imageUrlInput.value = imageUrl;
                }
            }

        }

        function emailHandler() {
            return {
                emails: [""],
                addNewEmail() {
                    this.emails = [...this.emails, ''];
                },
                removeEmail(index) {
                    this.emails.splice(index, 1);
                },
            };
        }
    </script>
</x-app-layout>
