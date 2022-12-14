<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-600">
    <div>
        {{ $logo }}
    </div>

    <div class="w-full sm:max-w-md mt-6 overflow-hidden">

        <div class="bg-white dark:bg-gray-800 shadow-md px-6 py-4 sm:rounded-lg">
            {{ $slot }}
        </div>
        @isset($footer)
            {{ $footer }}
        @endisset
    </div>
</div>
