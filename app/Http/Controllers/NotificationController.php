<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    //
    public function index()
    {
        $locataire = auth()->user()->locataire ?? null;
        $notifications = $locataire ? $locataire->notifications : collect();
        return view('notifications.index', compact('notifications'));
    }

    public function action(Request $request, $notificationId)
{
    $notification = auth()->user()->locataire->notifications()->findOrFail($notificationId);

    $action = $request->input('action');
    $message = $request->input('message');

    // Stocke la décision dans le champ data (ou crée un champ dédié si besoin)
    $data = $notification->data;
    $data['decision'] = $action;
    $data['message'] = $message;
    $notification->data = $data;
    $notification->markAsRead();
    $notification->save();

    return redirect()->back()->with('success', 'Décision enregistrée.');
}
}
