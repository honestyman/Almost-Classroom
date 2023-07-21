<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Scripts -->
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.4/dist/flowbite.min.css" />
    <script defer src="https://unpkg.com/@alpinejs/focus@3.x.x/dist/cdn.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <script src="https://kit.fontawesome.com/d8c9721737.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</head>

<body class="font-sans antialiased">
    <div class="flex flex-col min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="mx-2 sm:mx-6 md:mx-10 py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main class="flex-grow">
            {{ $slot }}
        </main>

        <!-- Page Footing -->
        <footer
            class="p-4 mt-auto bg-white rounded-lg shadow flex items-center justify-between md:p-6 dark:bg-gray-800">
            <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">© {{ date('Y') }} <a
                    href="#" class="hover:underline">web by Štěpán Švarc</a>
            </span>
            <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">
                <a href="https://laravel.com/" class="hover:underline">Při tvorbě byl použit Laravel!</a>
            </span>
        </footer>

    </div>
    <script src="https://unpkg.com/flowbite@1.5.4/dist/flowbite.js"></script>
    @livewire('livewire-ui-modal')
    @livewireScripts
</body>

</html>
