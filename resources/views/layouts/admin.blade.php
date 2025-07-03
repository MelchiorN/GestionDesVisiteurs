<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Admin Dashboard') </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    @push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
@endpush
@push('scripts')
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Crée une carte centrée par défaut
            var map = L.map('map').setView([6.1319, 1.2228], 13); // Exemple : Lomé

            // Ajouter la couche de tuiles OpenStreetMap
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            var marker;

            // Fonction pour mettre à jour les champs lat/lng et le marqueur
            function updateMarker(lat, lng) {
                document.getElementById('latitude').value = lat;
                document.getElementById('longitude').value = lng;

                if (marker) {
                    map.removeLayer(marker);
                }
                marker = L.marker([lat, lng]).addTo(map);
                map.setView([lat, lng], 15);
            }

            // Lorsque l'utilisateur clique sur la carte
            map.on('click', function(e) {
                updateMarker(e.latlng.lat, e.latlng.lng);
            });

            // Option : géolocalisation automatique via navigateur
            document.getElementById('locateOnMap').addEventListener('click', function() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function(position) {
                        updateMarker(position.coords.latitude, position.coords.longitude);
                    }, function(error) {
                        alert("Erreur : " + error.message);
                    });
                } else {
                    alert("Votre navigateur ne supporte pas la géolocalisation.");
                }
            });
        });
    </script>
@endpush

</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <div class="flex h-screen">
        <aside class="w-64 bg-gray-800 text-white flex flex-col">
            <div class="p-6 border-b border-gray-700">
                <h1 class="text-2xl font-semibold">Admin Panel</h1>
            </div>
            <nav class="flex-grow p-4">
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('admin.accueil') }}" class="flex items-center px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors duration-200
                            @if(request()->routeIs('admin.accueil')) active bg-gray-100 text-yellow-700 @endif">
                            <i class="fas fa-tachometer-alt mr-3"></i> Tableau de bord
                        </a>
                    </li>
                    <li>
                        <a href="" class="flex items-center px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors duration-200
                           @if (request()->routeIs('')) active bg-gray-100 text-yellow-700 @endif }}">
                            <i class="fas fa-users-cog mr-3"></i> Gestion des Utilisateurs
                        </a>
                    </li>
                    <li>
                        <a href="" class="flex items-center px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors duration-200
                            @if (request()->routeIs('')) active bg-gray-600 text-yellow-800 @endif">
                            <i class="fas fa-home mr-3"></i> Gestion des Locataires
                        </a>
                    </li>
                    <li>
                        <a href="" class="flex items-center px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors duration-200
                            @if( request()->routeIs('')) active bg-gray-100 text-yellow-800 @endif">
                            <i class="fas fa-user-secret mr-3"></i> Gestion des Agents
                        </a>
                    </li>
                    <li>
                        <a href="" class="flex items-center px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors duration-200
                        @if (request()->routeIs('')) active bg-gray-100 text-yellow-800 @endif">
                            <i class="fas fa-user-friends mr-3"></i> Tous les Visiteurs
                        </a>
                    </li>
                    <li>
                        <a href="{{route('admin.parametre')}}" class="flex items-center px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors duration-200
                            @if (request()->routeIs('admin.parametre')) active bg-gray-100 text-yellow-800 @endif">
                            <i class="fas fa-cogs mr-3"></i> Paramètres
                        </a>
                    </li>
                  
                </ul>
            </nav>
            <div class="">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="flex items-center px-4 py-2 rounded-lg hover:bg-red-700 text-white hover:text-white transition-colors duration-200 w-full">
                        <i class="fas fa-sign-out-alt mr-3"></i> Déconnexion
                    </button>
                </form>
            </div>
        </aside>

        <div class="flex-1 flex flex-col overflow-hidden">
            <header class="bg-white shadow-md p-4 flex justify-between items-center">
                <div class="text-xl font-semibold text-gray-800">
                    @yield('page_heading', 'Tableau de bord Administrateur')
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-gray-600">Bienvenue, {{Auth::user()-> nom}} {{ Auth::user()->prenom  }}</span>
                    <a href="" class="text-indigo-600 hover:text-indigo-800">
                        <i class="fas fa-user-circle text-2xl"></i>
                    </a>
                </div>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
                @yield('content')
            </main>
        </div>
    </div>


</body>
</html>