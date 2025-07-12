<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PaymentVerifiedNotification extends Notification
{
    use Queueable;

    protected $tagihan;

    public function __construct($tagihan)
    {
        $this->tagihan = $tagihan;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Pembayaran Telah Diverifikasi')
                    ->line('Pembayaran untuk tagihan '.$this->tagihan->nomor_tagihan.' telah diverifikasi.')
                    ->action('Lihat Tagihan', url('/tagihan/'.$this->tagihan->id))
                    ->line('Terima kasih telah menggunakan layanan kami!');
    }

    public function toArray($notifiable)
    {
        return [
            'message' => 'Pembayaran untuk tagihan '.$this->tagihan->nomor_tagihan.' telah diverifikasi',
            'url' => '/tagihan/'.$this->tagihan->id
        ];
    }
}
