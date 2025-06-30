@extends('layouts.app')

@section('title', 'Tableau de bord')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- En-tête -->
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Tableau de bord</h1>
        <div class="text-sm text-gray-500">
            {{ now()->format('l, d F Y') }}
        </div>
    </div>

    <!-- Cartes de statistiques -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Carte Visiteurs aujourd'hui -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-gray-500 text-sm font-medium">Visiteurs aujourd'hui</h3>
                        
                        <p class="text-sm text-gray-500 mt-1">
                           
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Carte Visiteurs cette semaine -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-100 text-green-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-gray-500 text-sm font-medium">Cette semaine</h3>
                       
                        <p class="text-sm text-gray-500 mt-1">
                            
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Carte Visiteurs présents -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="p-6">
                <div class="flex items-center">
                     <a href="{{route('visiteurs.presents')}}"> 
                        <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                    </a>
                    <div class="">
                        <div class="ml-4">                             
                            <a href="{{route('visiteurs.presents')}}"> 
                                    <h3 class="text-gray-500 text-sm font-medium">Visiteurs présents</h3>
                                    <p class="text-sm text-gray-500 mt-1">Actuellement dans l'immeuble</p>

                            </a>
                              
                        </div>

                    </div>
                    
                </div>
            </div>
        </div>

        <!-- Carte Taux d'occupation -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-gray-500 text-sm font-medium">Taux d'occupation</h3>
                        
                        <p class="text-sm text-gray-500 mt-1">
                           
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Graphiques -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- Graphique évolution hebdomadaire -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Activité des 7 derniers jours</h3>
            <div class="h-64">
                <canvas id="weeklyChart"></canvas>
            </div>
        </div>

        <!-- Graphique répartition par motif -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Répartition par motif de visite</h3>
            <div class="h-64">
                <canvas id="purposeChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Derniers visiteurs et actions rapides -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Derniers visiteurs -->
        <div class="lg:col-span-2 bg-white rounded-xl shadow-md overflow-hidden">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-800">Derniers visiteurs</h3>
                    <a href="{{ route('visiteurs.filtre') }}" class="text-sm text-indigo-600 hover:text-indigo-800">Voir tout</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Locataire</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Heure arrivée</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Actions rapides -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Actions rapides</h3>
            <div class="space-y-4">
                <a href="{{ route('visiteurs.create') }}" class="flex items-center p-4 bg-indigo-50 rounded-lg hover:bg-indigo-100 transition-colors">
                    <div class="p-2 rounded-full bg-indigo-100 text-indigo-600 mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-medium text-gray-800">Enregistrer un visiteur</h4>
                        <p class="text-sm text-gray-500">Nouvelle entrée dans l'immeuble</p>
                    </div>
                </a>

                <a href="{{ route('visiteurs.presents') }}" class="flex items-center p-4 bg-green-50 rounded-lg hover:bg-green-100 transition-colors">
                    <div class="p-2 rounded-full bg-green-100 text-green-600 mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-medium text-gray-800">Gérer les présences</h4>
                        <p class="text-sm text-gray-500">Enregistrer les départs</p>
                    </div>
                </a>

                <a href="{{ route('locataires.create') }}" class="flex items-center p-4 bg-purple-50 rounded-lg hover:bg-purple-100 transition-colors">
                    <div class="p-2 rounded-full bg-purple-100 text-purple-600 mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6z" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-medium text-gray-800">Ajouter un locataire</h4>
                        <p class="text-sm text-gray-500">Nouvel occupant de l'immeuble</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Scripts pour les graphiques -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Graphique hebdomadaire
    const weeklyCtx = document.getElementById('weeklyChart').getContext('2d');
    const weeklyChart = new Chart(weeklyCtx, {
        type: 'line',
        data: {
            
            datasets: [{
                label: 'Visiteurs',
              
                backgroundColor: 'rgba(79, 70, 229, 0.1)',
                borderColor: 'rgba(79, 70, 229, 1)',
                borderWidth: 2,
                tension: 0.3,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });

    // Graphique motifs de visite
    const purposeCtx = document.getElementById('purposeChart').getContext('2d');
    const purposeChart = new Chart(purposeCtx, {
        type: 'doughnut',
        data: {
           
            datasets: [{
                
                backgroundColor: [
                    'rgba(79, 70, 229, 0.8)',
                    'rgba(16, 185, 129, 0.8)',
                    'rgba(245, 158, 11, 0.8)',
                    'rgba(236, 72, 153, 0.8)',
                    'rgba(59, 130, 246, 0.8)'
                ],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'right'
                }
            },
            cutout: '70%'
        }
    });
</script>
@endsection