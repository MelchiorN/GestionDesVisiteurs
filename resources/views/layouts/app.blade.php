<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title','Gestion des visiteurs')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
        .nav-item.active i {
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
                <!-- Accueil -->
                <li>
                    <a href="{{ route('agent.dashboard') }}" class="nav-item flex items-center px-4 py-3 rounded-lg text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-colors @if(request()->routeIs('dashboard')) active @endif">
                        <i class="fas fa-home mr-3"></i><span>Accueil</span>                       
                    </a>
                </li>

                <!-- Nouveau visiteur -->
                <li>
                    <a href="{{ route('visiteurs.create') }}" class="nav-item flex items-center px-4 py-3 rounded-lg text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-colors @if(request()->routeIs('visiteurs.create')) active @endif">
                        <i class="fas fa-user-plus mr-3"></i> <span>Nouveau visiteur</span>                        
                    </a>
                </li>

                <!-- Visiteurs présents -->
                <li>
                    <a href="{{ route('visiteurs.presents') }}" class="nav-item flex items-center px-4 py-3 rounded-lg text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-colors @if(request()->routeIs('visiteurs.presents')) active @endif">
                        <i class="fas fa-users mr-3"></i><span>Visiteurs présents</span>                     
                    </a>
                </li>

                <!-- Tous les visiteurs -->
                <li>
                    <a href="{{ route('visiteurs.index') }}" class="nav-item flex items-center px-4 py-3 rounded-lg text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-colors @if(request()->routeIs('visiteurs.filtre')) active @endif">
                        <i class="fas fa-list mr-3"></i> <span>Tous les visiteurs</span>                      
                    </a>
                </li>

                <!-- Nouveau résident -->
                <li>
                    <a href="{{ route('locataires.create') }}" class="nav-item flex items-center px-4 py-3 rounded-lg text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-colors @if(request()->routeIs('locataires.create')) active @endif">
                        <i class="fas fa-user-plus mr-3"></i><span>Nouveau résident</span>                        
                    </a>
                </li>

                <!-- Gestion résidents -->
                <li>
                    <a href="{{ route('locataires.index') }}" class="nav-item flex items-center px-4 py-3 rounded-lg text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-colors @if(request()->routeIs('locataires.*')) active @endif">
                        <i class="fas fa-users-cog mr-3"></i><span>Gestion résidents</span>
                    </a>
                </li>

                <!-- Notifications -->
                <li>
                    <a href="{{ route('notifications.index') }}" class="nav-item flex items-center px-4 py-3 rounded-lg text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-colors @if(request()->routeIs('notifications.*')) active @endif">
                        <i class="fas fa-bell mr-3"></i> <span>Notifications</span>                      
                    </a>
                </li>

                <!-- Statistiques -->
                <li>
                    <a href="{{ route('statistiques.index') }}" class="nav-item flex items-center px-4 py-3 rounded-lg text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-colors @if(request()->routeIs('statistiques.index')) active @endif">
                        <i class="fas fa-chart-bar mr-3"></i><span>Statistiques</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- Déconnexion -->
        <div class="p-4 border-t">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center px-4 py-3 rounded-lg text-gray-700 hover:bg-red-50 hover:text-red-600 transition-colors">
                    <i class="fas fa-sign-out-alt mr-3"></i><span>Déconnexion</span>   
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
                            <i class="fas fa-check-circle mr-2"></i>
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
