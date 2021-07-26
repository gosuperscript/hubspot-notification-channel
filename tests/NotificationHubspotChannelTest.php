<?php

namespace DigitalRisks\Tests\Notifications;

use DigitalRisks\Notifications\Channels\HubspotChannel;
use DigitalRisks\Notifications\Messages\HubspotMessage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\Notification;
use Mockery;
use PHPUnit\Framework\TestCase;
use SevenShores\Hubspot\Factory;
use SevenShores\Hubspot\Resources\TransactionalEmail;

class NotificationHubspotChannelTest extends TestCase
{
    public function test_email_is_sent_via_hubspot()
    {
        // https://stackoverflow.com/questions/21358268/mockery-call-has-a-different-signature
        if (defined('E_STRICT')) error_reporting(E_ALL ^ E_STRICT);

        // Arrange.
        $hubspot = Mockery::mock(Factory::class);
        $singleEmail = Mockery::mock(TransactionalEmail::class);
        $channel = new HubspotChannel($hubspot);

        // Assert.
        $hubspot->shouldReceive('transactionalEmail')->andReturn($singleEmail);
        $singleEmail->shouldReceive('send')->with(
            '12134249933',
            ['to' => 'kani.robinson@digitalrisks.co.uk'],
            [
                ['name' => 'limit', 'value' => '100']
            ],
            [
                ['name' => 'name', 'value' => 'Kani Robinson']
            ]
        )->andReturn(true);

        // Act.
        $result = $channel->send(new TestNotifiable, new TestNotification);
        $this->assertTrue($result);
    }

    public function tearDown() : void
    {
        Mockery::close();
    }
}

class TestNotifiable
{
    use Notifiable;

    public function routeNotificationForHubspot($notification) {
        return 'kani.robinson@digitalrisks.co.uk';
    }
}

class TestNotification extends Notification
{
    public function toHubspot($notifiable)
    {
        return (new HubspotMessage)
            ->templateId('12134249933')
            ->contactProperties([
                [
                    'name' => 'limit',
                    'value' => '100',
                ],
            ])
            ->customProperties([
                [
                    'name' => 'name',
                    'value' => 'Kani Robinson',
                ],
            ]);
    }
}
