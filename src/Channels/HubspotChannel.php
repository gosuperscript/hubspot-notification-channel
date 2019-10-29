<?php

namespace DigitalRisks\Notifications\Channels;

use SevenShores\Hubspot\Factory;
use Illuminate\Notifications\Notification;

class HubspotChannel
{
    /**
     * The Hubspot client instance.
     *
     * @var \SevenShores\Hubspot\Factory
     */
    protected $hubspot;

    /**
     * Create a new Hubspot channel instance.
     *
     * @param  \SevenShores\Hubspot\Factory  $hubspot
     * @param  string  $from
     * @return void
     */
    public function __construct(Factory $hubspot)
    {
        $this->hubspot = $hubspot;
    }

    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     */
    public function send($notifiable, Notification $notification)
    {
        if (!$to = $notifiable->routeNotificationFor('hubspot', $notification)) {
            return;
        }

        $message = $notification->toHubspot($notifiable);

        return $this->hubspot->singleEmail()->send(
            $message->templateId,
            array_merge(['to' => $to], $message->messageProperties),
            $message->contactProperties,
            $message->customProperties,
        );
    }
}
