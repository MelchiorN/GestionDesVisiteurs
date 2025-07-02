@extends('layouts.admin')

@section('title', 'Tableau de Bord Admin')

@section('page_heading', 'Aperçu Général')

@section('content')
<div class="bg- container mx-auto">
    <div class="mb-8">
        <h2 class="text-3xl font-extrabold text-gray-900 mb-2">Bienvenue, {{Auth::user()->nom}} {{ Auth::user()->prenom }} </h2>
        <p class="text-gray-600 text-lg">Gérez et supervisez l'activité de votre bâtiment.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-lg p-6 flex items-center justify-between transition-transform duration-200 hover:scale-105">
            <div>
                <h3 class="text-gray-500 text-sm font-medium">Visiteurs aujourd'hui</h3>
                <p class="text-3xl font-bold text-gray-900 mt-1"></p>
            </div>
            <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                <i class="fas fa-users text-2xl"></i>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6 flex items-center justify-between transition-transform duration-200 hover:scale-105">
            <div>
                <h3 class="text-gray-500 text-sm font-medium">Locataires Actifs</h3>
                <p class="text-3xl font-bold text-gray-900 mt-1"></p>
            </div>
            <div class="p-3 rounded-full bg-green-100 text-green-600">
                <i class="fas fa-home text-2xl"></i>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6 flex items-center justify-between transition-transform duration-200 hover:scale-105">
            <div>
                <h3 class="text-gray-500 text-sm font-medium">Agents Enregistrés</h3>
                <p class="text-3xl font-bold text-gray-900 mt-1"></p>
            </div>
            <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                <i class="fas fa-user-secret text-2xl"></i>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6 flex items-center justify-between transition-transform duration-200 hover:scale-105">
            <div>
                <h3 class="text-gray-500 text-sm font-medium">Visiteurs Actuellement Présents</h3>
                <p class="text-3xl font-bold text-gray-900 mt-1"></p>
            </div>
            <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                <i class="fas fa-walking text-2xl"></i>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">Activité des Visiteurs (7 derniers jours)</h3>
            <div class="h-64">
                <canvas id="weeklyVisitorsChart"></canvas>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">Répartition des Motifs de Visite</h3>
            <div class="h-64">
                <canvas id="visitPurposeChart"></canvas>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 bg-white rounded-xl shadow-lg p-6">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">Dernières Activités</h3>
            <ul class="divide-y divide-gray-200">
                
                <li class="py-3 flex items-center justify-between">
                    <div>
                        <p class="text-gray-800"><span class="font-medium">Jean Dupont</span> a enregistré un nouveau visiteur.</p>
                        <span class="text-sm text-gray-500">il y a 5 minutes</span>
                    </div>
                    <a href="#" class="text-indigo-600 hover:text-indigo-800 text-sm">Voir</a>
                </li>
                <li class="py-3 flex items-center justify-between">
                    <div>
                        <p class="text-gray-800">Le locataire <span class="font-medium">Marie Curie</span> a mis à jour son profil.</p>
                       
                    </div>
                    <a href="#" class="text-indigo-600 hover:text-indigo-800 text-sm">Voir</a>
                </li>
                
                    <li class="py-3 flex items-center justify-between">
                        <div>
                            <p class="text-gray-800"></p>
                            <span class="text-sm text-gray-500"></span>
                        </div>
                        <a href="" class="text-indigo-600 hover:text-indigo-800 text-sm">Détails</a>
                    </li>
           
                    <li class="py-4 text-center text-gray-500 italic">Aucune activité récente.</li>
           
            </ul>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">Accès Rapide</h3>
            <div class="space-y-4">
                <a href=" class="flex items-center p-4 bg-indigo-50 rounded-lg hover:bg-indigo-100 transition-colors duration-200">
                    <div class="p-2 rounded-full bg-indigo-100 text-indigo-600 mr-4">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <div>
                        <h4 class="font-medium text-gray-800">Ajouter un Utilisateur</h4>
                        <p class="text-sm text-gray-500"> Agent ou Locataire</p>
                    </div>
                </a>
                <a href="" class="flex items-center p-4 bg-green-50 rounded-lg hover:bg-green-100 transition-colors duration-200">
                    <div class="p-2 rounded-full bg-green-100 text-green-600 mr-4">
                        <i class="fas fa-door-open"></i>
                    </div>
                    <div>
                        <h4 class="font-medium text-gray-800">Enregistrer une Visite</h4>
                        <p class="text-sm text-gray-500">Enregistrer un nouvel entrant</p>
                    </div>
                </a>
                <a href="#" class="flex items-center p-4 bg-purple-50 rounded-lg hover:bg-purple-100 transition-colors duration-200">
                    <div class="p-2 rounded-full bg-purple-100 text-purple-600 mr-4">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <div>
                        <h4 class="font-medium text-gray-800">Ajouter un Locataire</h4>
                        <p class="text-sm text-gray-500">Nouveau résident</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Placeholder Data for Charts (replace with actual data from your Laravel controller)
    const weeklyVisitorsLabels = ['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'];
    const weeklyVisitorsData = [25, 30, 18, 40, 35, 20, 28]; // Example data

    const visitPurposeLabels = ['Réunion', 'Livraison', 'Personnel', 'Entretien', 'Autre'];
    const visitPurposeData = [30, 20, 25, 15, 10]; // Example percentage distribution

    // Weekly Visitors Chart
    const weeklyVisitorsCtx = document.getElementById('weeklyVisitorsChart').getContext('2d');
    new Chart(weeklyVisitorsCtx, {
        type: 'line',
        data: {
            labels: weeklyVisitorsLabels,
            datasets: [{
                label: 'Nombre de Visites',
                data: weeklyVisitorsData,
                backgroundColor: 'rgba(59, 130, 246, 0.2)', // blue-500 with transparency
                borderColor: 'rgba(59, 130, 246, 1)',      // blue-500
                borderWidth: 2,
                tension: 0.4,
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
                        stepSize: 5
                    }
                }
            }
        }
    });

    // Visit Purpose Doughnut Chart
    const visitPurposeCtx = document.getElementById('visitPurposeChart').getContext('2d');
    new Chart(visitPurposeCtx, {
        type: 'doughnut',
        data: {
            labels: visitPurposeLabels,
            datasets: [{
                data: visitPurposeData,
                backgroundColor: [
                    '#4F46E5', // Indigo 600
                    '#10B981', // Emerald 500
                    '#F59E0B', // Amber 500
                    '#EC4899', // Pink 500
                    '#6366F1'  // Violet 500
                ],
                hoverOffset: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'right',
                    labels: {
                        boxWidth: 15,
                        padding: 20
                    }
                }
            },
            cutout: '70%'
        }
    });
</script>
@endsection