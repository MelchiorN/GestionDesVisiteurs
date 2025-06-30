<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title','Gestion des visiteurs')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Icônes Heroicons -->
    <script src="https://unpkg.com/@heroicons/vue@1.0.5/dist/heroicons.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            display: flex;
            min-height: 100vh;
        }
        .sidebar {
            width: 250px;
            transition: all 0.3s;
        }
        .content {
            flex: 1;
            overflow-y: auto;
        }
        .logo {
            background: linear-gradient(135deg, #4f46e5 0%, #10b981 100%);
        }
        .nav-item.active {
            background-color: #e0e7ff;
            color: #4f46e5;
        }
        .nav-item.active svg {
            color: #4f46e5;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Sidebar -->
    <div class="sidebar bg-white shadow-lg flex flex-col">
        <!-- Logo -->
        <div class="p-4 flex items-center space-x-3 border-b">
            <div class="logo h-10 w-10 rounded-lg flex items-center justify-center text-white font-bold text-xl">
                GV
            </div>
            <span class="text-xl font-bold text-gray-800">Gestion Visiteurs</span>
        </div>
        
        <!-- Menu de navigation -->
        <div class="flex-grow p-4 overflow-y-auto">
            <ul class="space-y-2">
                <!-- Accueil/Dashboard -->
                <li>
                    <a href="{{ route('dashboard') }}" class="nav-item flex items-center px-4 py-3 rounded-lg text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-colors @if(request()->routeIs('dashboard')) active @endif">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        Accueil
                    </a>
                </li>
                
                <!-- Nouveau visiteur -->
                <li>
                    <a href="{{ route('visiteurs.create') }}" class="nav-item flex items-center px-4 py-3 rounded-lg text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-colors @if(request()->routeIs('visiteurs.create')) active @endif">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                        </svg>
                        Nouveau visiteur
                    </a>
                </li>
                
                <!-- Visiteurs présents -->
                <li>
                    <a href="{{ route('visiteurs.presents') }}" class="nav-item flex items-center px-4 py-3 rounded-lg text-gray-700 hover:bg-green-50 hover:text-green-600 transition-colors @if(request()->routeIs('visiteurs.presents')) active @endif">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                        </svg>
                        Visiteurs présents
                    </a>
                </li>
                
                <!-- Tous les visiteurs -->
                <li>
                    <a href="{{ route('visiteurs.filtre') }}" class="nav-item flex items-center px-4 py-3 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors @if(request()->routeIs('visiteurs.filtre')) active @endif">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd" />
                        </svg>
                        Tous les visiteurs
                    </a>
                </li>
                
                <!-- Locataires -->
                 <li>
                    <a href="{{ route('locataires.create') }}" class="nav-item flex items-center px-4 py-3 rounded-lg text-gray-700 hover:bg-purple-50 hover:text-purple-600 transition-colors @if(request()->routeIs('locataires.*')) active @endif">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                        </svg>
                        Nouveau locataire
                    </a>
                </li>
                <li>
                    <a href="{{ route('locataires.index') }}" class="nav-item flex items-center px-4 py-3 rounded-lg text-gray-700 hover:bg-purple-50 hover:text-purple-600 transition-colors @if(request()->routeIs('locataires.*')) active @endif">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                        </svg>
                        Gestion locataires
                    </a>
                </li>
                
                <!-- Notifications -->
                <li>
                    <a href="{{ route('locataires.index') }}" class="nav-item flex items-center px-4 py-3 rounded-lg text-gray-700 hover:bg-yellow-50 hover:text-yellow-600 transition-colors relative @if(request()->routeIs('notifications.*')) active @endif">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                        Notifications
                       
                    </a>
                </li>
                <li>
        <a href="{{ route('statistiques.index') }}" class="nav-item flex items-center px-4 py-3 rounded-lg text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-colors @if(request()->routeIs('statistiques.index')) active @endif">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17a4 4 0 110-8 4 4 0 010 8zm-7 4h14a2 2 0 002-2v-1a9 9 0 10-18 0v1a2 2 0 002 2z" />
            </svg>
            Statistiques
        </a>
</li>

            </ul>
        </div>
        
        <!-- Déconnexion -->
        <div class="p-4 border-t">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center px-4 py-3 rounded-lg text-gray-700 hover:bg-red-50 hover:text-red-600 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    Déconnexion
                </button>
            </form>
        </div>
    </div>

    <!-- Contenu principal -->
    <div class="content">
        <main class="flex-grow">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <!-- Notifications -->
                @if(session('success'))
                    <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            {{ session('success') }}
                        </div>
                    </div>
                @endif

                @yield('content')
            </div>
        </main>

        <!-- Pied de page -->
        <footer class="bg-white border-t border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                <p class="text-center text-gray-500 text-sm">
                    &copy; {{ date('Y') }} Gestion des Visiteurs. Tous droits réservés.
                </p>
            </div>
        </footer>
    </div>
</body>
</html>