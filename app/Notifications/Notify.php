<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;
class Notify extends Notification
{
    use Queueable;

    protected $title;
    protected $message;
    /**
     * Create a new notification instance.
     */
    public function __construct($title, $message)
    {
        $this->title = $title;
        $this->message = $message;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return [ 'database','mail'];
    }

    /**
     * Get the broadcastable representation of the notification.
     */

    public function toDatabase(object $notifiable)
    {


            $message =  'Your Trip IS Ready Now You can book in it  ';


            return [$message];



    }
    public function toMail(object $notifiable)
    {

return (new MailMessage)->line('Your Trip IS Ready Now You can book in it');
      //  $message =  'Your Trip IS Ready Now You can book in it  ';


        return [$message];



    }
    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
