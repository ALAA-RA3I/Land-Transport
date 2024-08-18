<?php

namespace App\Notifications;

use Illuminate\Notifications\Channels\DatabaseChannel;
use Illuminate\Notifications\Notification;
use NotificationChannels\Fcm\FcmChannel;
use NotificationChannels\Fcm\FcmMessage;
use NotificationChannels\Fcm\Resources\Notification as FcmNotification;
use NotificationChannels\Fcm\Resources\Notification as NotificationResource;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Messaging;
use Kreait\Firebase\Factory;


abstract class NotificationChannel extends Notification
{
    public $notifiable;

    public function via($notifiable)
    {
        return [FcmChannel::class];
    }

    public function toFcmtest($notifiable)
    {
        $messaging = app(FcmMessage::class);

        $message = CloudMessage::new()
            ->withNotification(['title' => 'Test Notification', 'body' => 'This is a test message.'])
            ->withData(['key' => 'value']);

        $messaging->send($message);
    }

    public function toFcm($notifiable): FcmMessage
    {
        return (new FcmMessage(notification: new FcmNotification(
                title: 'hi from back',
                body: 'success notify .',
                
            )))
            ->data(['data1' => 'value', 'data2' => 'value2'])
            ->custom([
                'android' => [
                    'notification' => [
                        'color' => '#0A0A0A',
                    ],
                    'fcm_options' => [
                        'analytics_label' => 'analytics',
                    ],
                ],
                'apns' => [
                    'fcm_options' => [
                        'analytics_label' => 'analytics',
                    ],
                ],
            ]);
    }

    public function getNotification(): ?NotificationResource
    {
        return NotificationResource::create()
            ->title($this->getTitle())
            ->image($this->getImage())
            ->body($this->getBody());
    }

    public function toDatabase($notifiable)
    {
        $this->notifiable = $notifiable;
        $this->locale($notifiable->locale);

        return [
            'title' => $this->getTitle(),
            'body' => $this->getBody(),
            'code' => $this->getCode(),
            'data' => $this->getData() ?: null,
            'sender_name' => $this->getSenderName(),
            'sender_image' => $this->getImage(),
        ];
    }

    abstract public function getCode(): string;

    abstract public function getTitle(): string;

    abstract public function getBody(): string;

    public function getAttributes(): array
    {
        return [];
    }

    abstract public function getData(): array;

    public function getImage(): ?string
    {
        return asset('images/exmaple.svg'); //push notification image
    }

    public function getSenderName(): ?string
    {
        return 'sendermoayad'; // application name
    }

    public function getFcmData(): array
    {
        $data = $this->getData();

        return [
            'code' => $this->getCode(),
            'data' => $data ? json_encode($data) : null,
        ];
    }
}