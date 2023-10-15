@props(['active'])

@if ($active)
    <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
@endif
<a
    {{ $attributes->merge([
        'class' => 'inline-flex items-center w-full text-sm font-semibold text-gray-500 transition-colors duration-150 hover:text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-none focus:shadow-outline-purple py-3 px-2
        dark:hover:text-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:bg-gray-700 dark:focus:text-gray-100 ' . ($active ? 'bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-100' : '')
    ]) }}>
    {{ $icon ?? '' }}
    <span class="ml-4">{{ $slot }}</span>
</a>
