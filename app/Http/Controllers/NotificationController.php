<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification as NotificationModel;
use App\Models\Locataire;
use App\Models\Visiteur;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    public function index(Locataire $locataire)
    {
        $notifications = $locataire->notifications()->latest()->paginate(10);
        return view('locataires.notifications', compact('locataire', 'notifications'));
    }

    public function action(Request $request, $notificationId)
    {
        $notification = NotificationModel::findOrFail($notificationId);
        $locataire = Locataire::findOrFail($request->locataire_id);
        $visiteur = Visiteur::findOrFail($notification->data['visiteur_id']);

        DB::transaction(function () use ($request, $notification, $visiteur) {
            // Marquer comme lu
            $notification->markAsRead();

            // Enregistrer l'action
            $data = $notification->data;
            $data['action'] = $request->action;
            $data['message'] = $request->message;
            $data['processed_at'] = now()->toDateTimeString();
            $notification->data = $data;
            $notification->save();

            // Actions spécifiques
            
        });

        return redirect()->back()
               ->with('success', 'Action enregistrée avec succès');
    }
} 