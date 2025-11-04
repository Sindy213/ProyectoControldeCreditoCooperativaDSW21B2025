<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Autenticación' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
</head>
<body class="bg-gradient-to-br from-blue-100 via-blue-300 to-blue-500 min-h-screen flex items-center justify-center">
    <div class="w-full max-w-lg p-8 bg-white/60 backdrop-blur-md rounded-2xl shadow-2xl border border-blue-200">
        <!-- Logo -->
        <div class="flex justify-center mb-6">
            <img src="{{ asset('img/CooperativaOriginal.jpeg') }}" alt="Logo" class="h-20 w-20 rounded-full shadow-md">
        </div>
        {{ $slot }}
    </div>
</body>
</html>
