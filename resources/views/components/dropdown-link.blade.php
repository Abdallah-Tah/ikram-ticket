<li>
    <a {{ $attributes->merge(['class' => 'inline-flex items-center w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800
    dark:hover:bg-gray-700 dark:hover:text-gray-200 dark:text-gray-100 dark:hover:bg-gray-700 dark:focus:bg-gray-700 dark:focus:text-gray-100
    ']) }}>
        {{ $icon ?? '' }}
        <span>{{ $slot }}</span>
    </a>
</li>
