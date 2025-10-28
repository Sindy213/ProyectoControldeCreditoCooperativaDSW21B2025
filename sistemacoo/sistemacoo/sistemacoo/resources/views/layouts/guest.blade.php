<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Autenticación' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
</head>
<body class="bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 min-h-screen flex items-center justify-center">
    <div class="w-full max-w-lg p-8 bg-white rounded-2xl shadow-xl">
        <!-- Logo -->
        <div class="flex justify-center mb-6">
            <img src="{{ asset('img/logo.png') }}" alt="Logo" class="h-16 w-16">
        </div>

        {{ $slot }}
    </div>
</body>
</html>
