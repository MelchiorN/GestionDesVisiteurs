<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification as NotificationModel;
use App\Models\Locataire;
use App\Models\Notification;
use App\Models\Visiteur;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    public function index(Locataire $locataire,)
    {
        $notifications = $locataire->unreadNotifications()->latest()->paginate(10);
     
        return view('locataires.notifications', compact('locataire', 'notifications'));
    }

   public function action(Request $request, $notificationId)
{
    $notification = NotificationModel::findOrFail($notificationId);
    $locataire = Locataire::findOrFail($request->locataire_id);

    // Convertir en tableau pour manipuler plus facilement
    $data = is_array($notification->data) ? $notification->data : json_decode($notification->data, true);

    // Récupérer le visiteur via le tableau $data
    $visiteur = Visiteur::findOrFail($data['visiteur_id']);

    DB::transaction(function () use ($request, $notification, $visiteur, $data) {
        // Marquer la notification comme lue
        $notification->read_at = now();
        $notification->save();

        // Mettre à jour les données
        $data['action'] = $request->action;
        $data['message'] = $request->message;
        $data['processed_at'] = now()->toDateTimeString();

        $notification->data = $data;
        $notification->save();

        // Mettre à jour le statut du visiteur selon l'action
        if ($request->action === 'accept') {
            $visiteur->statut = 'Présent';
        } elseif ($request->action === 'refuse') {
            $visiteur->statut = 'Parti';
            $visiteur->heure_depart=now()->format('H:i');
        } else {
            $visiteur->statut = 'Banni';
            $visiteur->heure_depart=now()->format('H:i');
        }
        $visiteur->save();
    });

    return redirect()->back()->with('success', 'Action enregistrée avec succès');
}
  
} 