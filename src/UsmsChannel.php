<?php

namespace Urhitech\Usmsgh;

use Illuminate\Notifications\Notification;
use Urhitech\Usmsgh\Exceptions\CouldNotSendNotification;

class UsmsChannel
{
    /** @var Usms */
    protected $client;

    /**
     * The endpoint for sending your sms.
     *
     * @var string|null
     */
    protected $endpoint = 'https://webapp.usmsgh.com/api/sms/send'; // default send sms endpoint

    /**
     * The api_token for the user authentication.
     *
     * @var string|null
     */
    protected $api_token;

    /**
     * The sender_id name the message should sent from.
     *
     * @var string|null
     */
    public $sender_id;

    /**
     * The phone number the message should always send to.
     *
     * @var string|null
     */
    protected $to;

    /**
     * Create a new UsmsChannel instance.
     *
     * @param  Usms  $client
     * @param  string|null  $sender_id
     * @param  string|null  $to
     */
    public function __construct(Usms $client, $endpoint, $api_token, $sender_id = null, $to = null)
    {
        $this->client = $client;
        $this->endpoint = $endpoint;
        $this->api_token = $api_token;
        $this->sender_id = $sender_id;
        $this->to = $to;
    }

    /**
     * Send the given notification.
     *
     * @param mixed $notifiable
     * @param Notification $notification
     * @return void
     *
     * @throws CouldNotSendNotification
     */
    public function send($notifiable, Notification $notification)
    {
        if (! $to = $notifiable->routeNotificationFor('Usmsgh', $notification)) {
            return;
        }

        if (! empty($this->to)) {
            $to = $this->to;
        }

        $message = $notification->toUsms($notifiable);

        if (is_string($message)) {
            $message = new USmsMessage($message);
        }

        $response = $this->client->sendSms($this->endpoint, $this->api_token, $this->sender_id, $to, $message->toArray());

        if ($response->getStatusCode() !== 200) {
            throw CouldNotSendNotification::serviceRespondedWithAnError($response);
        }
    }
}
