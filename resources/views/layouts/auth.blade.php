<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body 
    class="min-h-screen bg-cover bg-center bg-no-repeat" 
    style="background-image: linear-gradient(to right, #667eea, #764ba2), url('/images/fond-login.jpg');"
>
    <div class="bg-black/30 min-h-screen">
        @yield('content')
    </div>

    <!-- Scripts éventuels -->
    @stack('scripts')
</body>
</html>
