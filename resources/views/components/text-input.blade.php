@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'mt-1 border-gray-300 rounded-md shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 focus-within:text-primary-600
dark:bg-gray-700 dark:border-gray-600 dark:focus:border-gray-500 dark:focus:ring-gray-600 dark:focus:ring-opacity-50']) !!}>
