@props(['active'])

@php
    $classes = $active ?? false ? 'inline-flex items-center px-1 pt-1 border-b-2 border-indigo-400 text-gray-800 dark:text-gray-300 text-sm font-medium leading-5 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out' : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 hover:text-black dark:hover:text-white hover:border-gray-300 focus:outline-none focus:text-black dark:focus:text-white active:text:black dark:active:text-white focus:border-gray-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
