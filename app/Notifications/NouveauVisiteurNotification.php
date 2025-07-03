<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

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
        return ['mail','database'];
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
    

public function toMail($notifiable)
{
    return (new MailMessage)
        ->subject('Nouveau visiteur')
        ->greeting('Bonjour ' . $notifiable->prenom)
        ->line('Un nouveau visiteur est arrivé.')
        ->line('Nom : ' . $this->visiteur->nom . ' ' . $this->visiteur->prenom)
        ->action('Voir les détails', url('/locataires/index'))
        ->line('Motif : ' . $this->visiteur->motif)
        ->line('Merci de votre vigilance.');
}

}