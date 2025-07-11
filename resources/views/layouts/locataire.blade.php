<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Espace Résident')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .sidebar {
            width: 250px;
            min-height: 100vh;
        }
        .nav-item.active {
            background-color: #fef3c7; /* jaune clair */
            color: #92400e;
        }
        .nav-item.active i {
            color: #92400e;
        }
    </style>
</head>
<body class="bg-gray-100 flex">

    <!-- Sidebar -->
    <section class="sidebar bg-purple-500 text-white flex flex-col shadow-lg rounded-xl">
        <div class="p-6 bg-purple-700">
            <h1 class="text-2xl text-center font-bold">Espace Résident</h1>
        </div>

        <nav class="flex-1 px-4 py-6 space-y-4 overflow-y-auto">
            <a href="{{route('locataire.dashboard')}}" class="nav-item block px-4 py-3 rounded-lg text-center text-white hover:bg-purple-300 transition @if(request()->routeIs('locataire.dashboard')) active bg-yellow-100 text-yellow-800 @endif">
                <i class="fas fa-home mr-2"></i> <span>Acueil</span>
            </a>

            <a href="{{route('profil')}}" class="nav-item block px-4 py-3 rounded-lg  text-center text-white hover:bg-purple-300 transition @if(request()->routeIs('profil')) active bg-yellow-100 text-yellow-800 @endif">
                <i class="fas fa-user mr-2"></i> <span>Mon profil</span>
            </a>

            <a href="{{route('visite')}}" class="nav-item block px-4 py-3 rounded-lg  text-center text-white hover:bg-purple-300 transition @if(request()->routeIs('visite')) active bg-yellow-100 text-yellow-800 @endif">
                <i class="fas fa-calendar-check mr-2"></i><span>Mes visites</span>
            </a>

            <a href="{{route('notif.perso')}}" class="nav-item block px-4 py-3 rounded-lg text-center text-white hover:bg-purple-300 transition @if(request()->routeIs('notif.perso')) active bg-yellow-100 text-yellow-800 @endif relative">
                @php
                $user=Auth::user();
                $locataire=App\Models\Locataire::where('email',$user->email)->first();
                $unreadCount=$locataire->unreadNotifications->count();


                @endphp

                <i class="fa-solid fa-bell"></i> 
                @if($unreadCount > 0)
                    <span class="absolute top-1 right-1 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 bg-red-600 rounded-full">
                        {{ $unreadCount }}
                    </span>
                @endif
                
                <span>Notifications</span>
            </a>

            <a href="" class="nav-item block px-4 py-3 rounded-lg text-center text-white hover:bg-purple-300 transition @if(request()->routeIs('resident.messages')) active bg-yellow-100 text-yellow-800 @endif">
                <i class="fas fa-envelope mr-2"></i> <span>Messages</span>
            </a>

            <a href="" class="nav-item block px-4 py-3 rounded-lg text-center text-white hover:bg-purple-300 transition @if(request()->routeIs('resident.parametres')) active bg-yellow-100 text-yellow-800 @endif">
                <i class="fas fa-cog mr-2"></i> <span>Paramètres</span>
            </a>
        </nav>

        <!-- Déconnexion -->
        <div class="p-4 ">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-center px-4 py-2 text-white hover:bg-red-100 hover:text-red-700 rounded-lg transition">
                    <i class="fas fa-sign-out-alt mr-2"></i> Déconnexion
                </button>
            </form>
        </div>
    </section>

    <!-- Contenu principal -->
    <div class="flex-1 flex flex-col min-h-screen">
        <div class="flex-1 flex flex-col overflow-hidden">
            <header class="bg-gray-200 shadow-md p-4 flex justify-between items-center">
                <div class="text-xl font-semibold text-gray-800">
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-gray-600">{{Auth::user()-> nom}} {{ Auth::user()->prenom  }}</span>
                    <a href="{{route('profil')}}" class="text-indigo-600 hover:text-indigo-800">
                       
                    <img class="object-cover rounded-full w-10 h-10  shadow-md"
                         src="{{ asset('storage/' . $locataire->photo) }}"
                         alt="Photo de {{ $locataire->nom }}">
        
                    </a>
                </div>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
                @yield('content')
            </main>
        </div>

        <footer class="bg-white text-center text-gray-500 text-sm border-t py-4">
            &copy; {{ date('Y') }} Espace Résident — Tous droits réservés.
        </footer>
    </div>

</body>
</html>
