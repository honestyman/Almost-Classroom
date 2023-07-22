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
    @vite('resources/css/app.css')
</head>

<body class="antialiased bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-300">
    <div class="flex flex-col justify-around min-h-screen">
        <div class="flex justify-center mt-4">
            <h1 class="text-4xl md:text-5xl font-bold">Almost-Classroom</h1>
        </div>
        <div class="flex flex-col gap-2 md:gap-4 items-center justify-center">
            <h2 class="text-3xl md:text-4xl font-bold text-center">
                Vítejte v aplikaci Almost-Classroom!
            </h2>
            <h3 class="text-xl md:text-2xl text-center">
                Tato aplikace vznikla jako ročníkový projekt v posledním roku studia na střední škole.
            </h3>
            <div class="flex justify-center">
                <img src="{{ asset('storage/images/app-preview.png') }}" alt="Application preview"
                    class="w-full md:w-1/3 rounded-xl">
            </div>
        </div>
        <div class="mb-4 flex justify-center">
            <a href="{{ route('home') }}"
                class="px-4 py-2 text-2xl font-medium text-white bg-purple-600 rounded-lg hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:ring-offset-2">
                Vstoupit do aplikace
            </a>
        </div>
    </div>
</body>

</html>
