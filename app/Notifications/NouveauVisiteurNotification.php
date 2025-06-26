<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NouveauVisiteurNotification extends Notification
{
    use Queueable;

    public $visiteur;

    public function __construct($visiteur)
    {
        $this->visiteur = $visiteur;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'visiteur_id' => $this->visiteur->id,
            'nom' => $this->visiteur->nom,
            'prenom' => $this->visiteur->prenom,
            'motif' => $this->visiteur->motif,
        ];
    }
}