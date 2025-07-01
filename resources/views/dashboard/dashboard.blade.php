@extends('layouts.app')

@section('title', 'Tableau de bord')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Tableau de bord</h1>
        <div class="text-sm text-gray-500">
            <!-- {{ now()->format('l, d F Y') }} -->
            <!-- {{ Carbon\Carbon::now()->locale('fr')->translatedFormat('l ,d F Y') }} -->
            {{mb_convert_case(\Carbon\Carbon::now()->locale('fr')->translatedFormat('l, d F Y'),MB_CASE_TITLE,'utf-8')}}              
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-lg overflow-hidden"> 
            <div class="p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-50 text-blue-700"> {{-- Changed blue-100 to blue-50, text-blue-600 to text-blue-700 --}}
                        <i class="fas fa-users h-6 w-6"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-gray-500 text-sm font-medium">Visiteurs aujourd'hui</h3>
                        {{-- Replace 0 with your actual data variable, e.g., {{ $visitorsToday }} --}}
                        <p class="text-2xl font-bold text-gray-900 mt-1">{{ $visitorsToday ?? 0 }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-lg overflow-hidden"> 
            <div class="p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-emerald-50 text-emerald-700"> 
                       <i class="fas fa-building h-6 w-6"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-gray-500 text-sm font-medium">Cette semaine</h3>
                        <p class="text-2xl font-bold text-gray-900 mt-1">{{ $visitorsThisWeek ?? 0 }}</p>
                    </div>
                </div>
            </div>
        </div>    
        <a href="{{route('visiteurs.presents')}}" class="flex items-center"> {{-- Wrapped the entire content for clickability --}}
             <div class="flex items-center bg-white rounded-xl shadow-lg overflow-hidden p-6">
                    <div class="p-3 rounded-full bg-amber-50 text-amber-700"> {{-- Changed yellow-100 to amber-50, text-yellow-600 to text-amber-700 --}}
                                <i class="fa fa-users w-6 h-6" aria-hidden="true"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-gray-500 text-sm font-medium">Visiteurs présents</h3>
                        <p class="text-sm text-gray-500 mt-1">Actuellement dans l'immeuble</p>
                        <p class="text-2xl font-bold text-gray-900 mt-1">{{ $present ?? 0 }}</p>
                    </div>
                </div>
        </a>
        <div class="bg-white rounded-xl shadow-lg overflow-hidden"> {{-- Changed shadow-md to shadow-lg --}}
            <div class="p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-violet-50 text-violet-700"> {{-- Changed purple-100 to violet-50, text-purple-600 to text-violet-700 --}}
                        <i class="fa fa-line-chart w-6 h-6" aria-hidden="true"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-gray-500 text-sm font-medium">Taux d'occupation</h3>
                        {{-- Replace 0% with your actual data variable, e.g., {{ $occupationRate }}% --}}
                        <p class="text-2xl font-bold text-gray-900 mt-1">{{ $occupationRate ?? '0' }}%</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-lg overflow-hidden p-6"> {{-- Changed shadow-md to shadow-lg --}}
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Activité des 7 derniers jours</h3>
            <div class="h-64">
                <canvas id="weeklyChart"></canvas>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-lg overflow-hidden p-6"> {{-- Changed shadow-md to shadow-lg --}}
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Répartition par motif de visite</h3>
            <div class="h-64">
                <canvas id="purposeChart"></canvas>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 bg-white rounded-xl shadow-lg overflow-hidden"> 
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-800">Derniers visiteurs</h3>
                    <a href="{{ route('visiteurs.index') }}" class="text-sm text-indigo-600 hover:text-indigo-800">Voir tout</a>
                </div>
                <div class="overflow-x-auto">
                    <table  class=" border border-gray-500 min-w-full ">
                        <thead class="bg-indigo-100">
                            <tr>
                                <th class=" border border-gray-500  px-6 py-3 text-center text-xs   font-medium text-indigo-500 uppercase tracking-wider">Nom</th>
                                <th class=" border border-gray-500 px-6 py-3 text-center text-xs   font-medium text-indigo-500 uppercase tracking-wider">Locataire</th>
                                <th class=" border border-gray-500 px-6 py-3 text-center text-xs  font-medium text-indigo-500 uppercase tracking-wider">Heure arrivée</th>
                                <th class=" border border-gray-500 px-6 py-3 text-center text-xs   font-medium text-indigo-500 uppercase tracking-wider">Heure Départ</th>
                                <th class=" border border-gray-500 px-6 py-3 text-center text-xs   font-medium text-indigo-500 uppercase tracking-wider">Statut</th>
                            </tr>
                        </thead>
                        <tbody class="bg-gray-50">
                            @php
                            use App\Models\Visiteur;
                            $dernierVisiteur=Visiteur::latest()->take(5)->get();
                            @endphp
                            @foreach($dernierVisiteur as $visitor)
                            <tr>
                                <td  class=" border border-gray-500 px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $visitor->nom }} {{$visitor->prenom}}</td>
                                <td class=" border border-gray-500 px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $visitor->locataire->nom }}{{ $visitor->locataire-> prenom }}</td>
                                <td class=" border border-gray-500 px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $visitor->heure_arrive }}</td>
                                <td class=" border border-gray-500 px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $visitor->heure_depart }}</td>
                                <td class=" border border-gray-500 px-6 py-4 whitespace-nowrap text-sm">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $visitor->heure_depart ? 'bg-red-300' :'bg-green-300 '}}">
                                        {{$visitor->heure_depart ? $visitor->statut :'Présent'}}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-lg overflow-hidden p-6"> 
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Actions rapides</h3>
            <div class="space-y-4">
                <a href="{{ route('visiteurs.create') }}" class="flex  justify-left items-center p-4 bg-indigo-50 rounded-lg hover:bg-indigo-100 transition-colors">
                    <div class="p-2 rounded-full bg-indigo-100 text-indigo-600 mr-4">
                        <i class="fa fa-user-plus" aria-hidden="true"></i>
                    </div>
                    <div>
                        <h4 class="font-medium text-gray-800">Enregistrer un visiteur</h4>
                        <p class="text-sm text-gray-500">Nouvelle entrée dans l'immeuble</p>
                    </div>
                </a>

                <a href="{{ route('visiteurs.presents') }}" class="flex items-center p-4 bg-emerald-50 rounded-lg hover:bg-emerald-100 transition-colors"> {{-- Changed bg-green-50 to bg-emerald-50, hover:bg-green-100 to hover:bg-emerald-100 --}}
                    <div class="p-2 rounded-full bg-emerald-100 text-emerald-600 mr-4"> {{-- Changed bg-green-100 to bg-emerald-100, text-green-600 to text-emerald-600 --}}
                        <i class="fas fa-users-cog h-6 w-6 mr-3"></i>
                    </div>
                    <div>
                        <h4 class="font-medium text-gray-800">Gérer les présences</h4>
                        <p class="text-sm text-gray-500">Enregistrer les départs</p>
                    </div>
                </a>

                <a href="{{ route('locataires.create') }}" class="flex items-center p-4 bg-fuchsia-50 rounded-lg hover:bg-fuchsia-100 transition-colors"> {{-- Changed bg-purple-50 to bg-fuchsia-50, hover:bg-purple-100 to hover:bg-fuchsia-100 --}}
                    <div class="p-2 rounded-full bg-fuchsia-100 text-fuchsia-600 mr-4"> {{-- Changed bg-purple-100 to bg-fuchsia-100, text-purple-600 to text-fuchsia-600 --}}
                        <i class="fa fa-user-plus" aria-hidden="true"></i>
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

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // These are example data points. You will need to replace them with dynamic data from your Laravel backend.
    // Example:
    // const weeklyLabels = @json($weeklyChartLabels ?? []);
    // const weeklyData = @json($weeklyChartData ?? []);
    // const purposeLabels = @json($purposeChartLabels ?? []);
    // const purposeData = @json($purposeChartData ?? []);

    // Placeholder data for demonstration
    const weeklyLabels = ['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'];
    const weeklyData = [12, 19, 3, 5, 2, 3, 7];

    const purposeLabels = ['Réunion', 'Livraison', 'Entretien', 'Prospection', 'Autre'];
    const purposeData = [30, 15, 20, 10, 25];


    // Graphique hebdomadaire
    const weeklyCtx = document.getElementById('weeklyChart').getContext('2d');
    const weeklyChart = new Chart(weeklyCtx, {
        type: 'line',
        data: {
            labels: weeklyLabels,
            datasets: [{
                label: 'Visiteurs',
                data: weeklyData,
                backgroundColor: 'rgba(59, 130, 246, 0.1)', // Tailwind blue-500 with transparency
                borderColor: 'rgba(59, 130, 246, 1)',      // Tailwind blue-500 solid
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
            labels: purposeLabels,
            datasets: [{
                data: purposeData,
                backgroundColor: [
                    'rgba(59, 130, 246, 0.8)',   // Blue-500
                    'rgba(16, 185, 129, 0.8)',  // Emerald-500
                    'rgba(245, 158, 11, 0.8)',  // Amber-500
                    'rgba(236, 72, 153, 0.8)',  // Pink-500
                    'rgba(99, 102, 241, 0.8)'   // Violet-500
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