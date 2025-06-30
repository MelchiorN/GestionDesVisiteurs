<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Tableau de bord')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">
    <!-- AppBar personnalisée -->
    <nav class="bg-indigo-600 text-white px-6 py-4 flex justify-between items-center">
        <div class="text-xl font-bold">Espace Locataire</div>
        
        <div class="space-x-4">
            
            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="hover:underline">Déconnexion</button>
            </form>
        </div>
    </nav>

    <main class="p-6">
        @yield('content')
    </main>
</body>
</html>
