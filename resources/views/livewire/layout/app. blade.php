<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @livewireStyles
    <!-- Add your CSS or other styles here -->
</head>
<body>
    <div class="min-h-screen bg-gray-100">
        <!-- Navigation or header can go here -->

        <!-- Main content of the page -->
        <main>
            {{ $slot }}
        </main>

        @livewireScripts
        <!-- Add your JS or other scripts here -->
    </div>
</body>
</html>
