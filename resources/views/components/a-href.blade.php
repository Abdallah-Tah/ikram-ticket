<a {{ $attributes->merge(['class' => 'px-4 py-2 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring dark:bg-gray-700 dark:border-gray-600 dark:focus:border-gray-500 dark:focus:ring-gray-600 dark:focus:ring-opacity-50 cursor-pointer']) }}>
    {{ $slot }}
</a>
