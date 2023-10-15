<footer class="bg-white rounded-lg shadow m-4 dark:bg-gray-800">
    <div class="w-full mx-auto max-w-screen-xl p-4 md:flex md:items-center md:justify-between">
        <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">© {{\Carbon\Carbon::now()->year}}
            <a
                href="https://github.com/Abdallah-Tah" class="hover:underline">{{ config('app.name') }}™</a>. All Rights Reserved.
        </span>
        <ul class="flex flex-wrap items-center mt-3 text-sm font-medium text-gray-500 dark:text-gray-400 sm:mt-0">
            <li>
                <a href="#" class="mr-4 hover:underline md:mr-6 ">{{ __('About') }}</a>
            </li>
            <li>
                <a href="#" class="mr-4 hover:underline md:mr-6">{{ __('Privacy Policy') }}</a>
            </li>
            <li>
                <a href="#" class="mr-4 hover:underline md:mr-6">{{ __('Terms of Service') }}</a>
            </li>
            <li>
                <a href="#" class="hover:underline">{{ __('Contact Us') }}</a>
            </li>
        </ul>
    </div>
</footer>
