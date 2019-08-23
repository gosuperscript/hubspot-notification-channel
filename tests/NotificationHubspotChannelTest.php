<?php

namespace DigitalRisks\Tests\Notifications;

use DigitalRisks\Notifications\Channels\HubspotChannel;
use DigitalRisks\Notifications\Messages\HubspotMessage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\Notification;
use Mockery;
use PHPUnit\Framework\TestCase;
use SevenShores\Hubspot\Factory;

class NotificationHubspotChannelTest extends TestCase
{
    public function test_email_is_sent_via_hubspot()
    {
        $notification = new HubspotChannelTestNotification;
        $notifiable = new HubspotChannelTestNotifiable;
        $channel = new HubspotChannel(
            $hubspot = Mockery::mock(Factory::class),
            'kani.robinson@digitalrisks.co.uk',
        );

        $hubspot->shouldReceive('message->send');

        $channel->send($notifiable, $notification);
    }

    public function tearDown()
    {
        Mockery::close();
    }
}

class HubspotChannelTestNotifiable
{
    use Notifiable;

    public $email = 'kani.robinson@digitalrisks.co.uk';
}

class HubspotChannelTestNotification extends Notification
{
    public function toHubspot($notifiable)
    {
        return (new HubspotMessage)
            ->templateId('12134249933')
            ->customProperties([
                [
                    'name' => 'name',
                    'value' => 'Kani Robinson',
                ],
            ]);
    }
}
