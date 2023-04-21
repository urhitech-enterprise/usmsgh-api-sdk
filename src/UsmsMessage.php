<?php

namespace Urhitech\Usmsgh;

use DateTime;
use DateTimeInterface;

class UsmsMessage
{
    const DATE_FORMAT = 'Y-m-d H:i:s';

    /**
     * The message content.
     *
     * @var string
     */
    public $content;

    /**
     * The sender_id name the message should sent from.
     *
     * @var string|null
     */
    public $sender_id;

    /**
     * The (optional) campaign name.
     *
     * @var string|null
     */
    public $campaign;

    /**
     * The (optional) date the message should sent at.
     *
     * @var string|null
     */
    public $sendAt;

    /**
     * The content parameters values.
     *
     * If you want to use parameters in your message you should add the following placeholder in your content:
     * "#param_x#" where x is the 1-based index of parameters array.
     *
     * <code>
     * $message->content("Hello #param_1# #param_2#")
     *     ->parameters([$user->first_name, $user->last_name]);
     * </code>
     *
     * @var array|null
     */
    public $parameters;

    /**
     * Create a new message instance.
     *
     * @param   $content
     * @return void
     */
    public function __construct($content = '')
    {
        $this->content = $content;
    }

    /**
     * Set message content.
     *
     * @param   $content
     * @return $this
     */
    public function content($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Set the sender_id name the message should sent from.
     *
     * @param   $sender_id
     * @return $this
     */
    public function sender($sender_id)
    {
        $this->sender_id = $sender_id;

        return $this;
    }

    /**
     * Set the campaign name.
     *
     * @param   $campaign
     * @return $this
     */
    public function campaign($campaign)
    {
        $this->campaign = $campaign;

        return $this;
    }

    /**
     * Set the date the message should sent at.
     *
     * @param  \DateTimeInterface| $sendAt
     * @return $this
     * @throws \Exception
     */
    public function sendAt($sendAt)
    {
        if (! $sendAt instanceof DateTimeInterface) {
            $sendAt = new DateTime($sendAt);
        }

        $this->sendAt = $sendAt->format(static::DATE_FORMAT);

        return $this;
    }

    /**
     * Set the message parameters.
     *
     * @param  array  $parameters
     * @return $this
     */
    public function parameters(array $parameters)
    {
        $this->parameters = $parameters;

        return $this;
    }

    /**
     * Get array representation of the message.
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'message' => $this->content,
            'sender_id' => $this->sender_id,
            'campaign' => $this->campaign,
            'date' => $this->sendAt,
            'parameters' => $this->parameters,
        ];
    }
}
