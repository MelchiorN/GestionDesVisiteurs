<?php

namespace App\Http\Controllers;

use App\Models\Visiteur;
use App\Models\Locataire;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistiques de base
        $stats = [
            'today' => Visiteur::whereDate('created_at', today())->count(),
            'today_percent_change' => $this->getPercentChange(
                Visiteur::whereDate('created_at', today())->count(),
                Visiteur::whereDate('created_at', today()->subDay())->count()
            ),
            'week' => Visiteur::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count(),
            'week_percent_change' => $this->getPercentChange(
                Visiteur::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count(),
                Visiteur::whereBetween('created_at', [now()->subWeek()->startOfWeek(), now()->subWeek()->endOfWeek()])->count()
            ),
            'present' => Visiteur::whereNull('heure_depart')->count(),
            'occupation_rate' => min(100, round((Visiteur::whereDate('created_at', today())->count() / 50) * 100)),
            'max_capacity' => 50
        ];

        // Données pour les graphiques
        $weeklyData = $this->getWeeklyData();
        $purposeData = $this->getPurposeData();

        // Derniers visiteurs
        $recentVisitors = Visiteur::with('locataire')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('dashboard', compact('stats', 'weeklyData', 'purposeData', 'recentVisitors'));
    }

    private function getWeeklyData()
    {
        $labels = [];
        $data = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $labels[] = $date->format('D');
            $data[] = Visiteur::whereDate('created_at', $date)->count();
        }

        return [
            'labels' => $labels,
            'data' => $data
        ];
    }

    private function getPurposeData()
    {
        $purposes = Visiteur::select('motif', DB::raw('count(*) as total'))
            ->groupBy('motif')
            ->orderBy('total', 'desc')
            ->get();

        return [
            'labels' => $purposes->pluck('motif'),
            'data' => $purposes->pluck('total')
        ];
    }

    private function getPercentChange($current, $previous)
    {
        if ($previous == 0) {
            return 100;
        }

        return round((($current - $previous) / $previous) * 100);
    }


    public function dashboard()
{
    // Exemple : récupérer tous les visiteurs
    $visiteurs = Visiteur::all();

    // Calculs exemples (à adapter à ta logique)
    $visiteursAujourdHui = Visiteur::whereDate('created_at', today())->count();
    $visiteursCetteSemaine = Visiteur::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count();
    $visiteursPresents = Visiteur::whereNull('heure_depart')->count();

    // Exemple d'un taux d'occupation fictif
    $tauxOccupation = '75%';

    // Derniers visiteurs
    $dernierVisiteurs = Visiteur::latest()->limit(10)->get();

    // Préparer données pour graphiques (exemple)
    $datesSemaine = collect()->range(0,6)->map(fn($i) => now()->startOfWeek()->addDays($i)->format('d M'));
    $visiteursParJour = collect()->range(0,6)->map(fn($i) =>
        Visiteur::whereDate('created_at', now()->startOfWeek()->addDays($i))->count()
    );

    $motifs = ['Réunion', 'Livraison', 'Maintenance', 'Visite', 'Autre'];
    $visiteursParMotif = [];
    foreach ($motifs as $motif) {
        $visiteursParMotif[] = Visiteur::where('motif', $motif)->count();
    }

    return view('dashboard.dashboard', compact(
        'visiteurs',
        'visiteursAujourdHui',
        'visiteursCetteSemaine',
        'visiteursPresents',
        'tauxOccupation',
        'dernierVisiteurs',
        'datesSemaine',
        'visiteursParJour',
        'motifs',
        'visiteursParMotif'
    ));
}

}