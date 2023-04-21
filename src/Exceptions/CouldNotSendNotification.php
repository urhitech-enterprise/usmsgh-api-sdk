<?php

namespace Urhitech\Usmsgh\Exceptions;

use Psr\Http\Message\ResponseInterface;

class CouldNotSendNotification extends \Exception
{
    public static function serviceRespondedWithAnError(ResponseInterface $response)
    {
        return new static('USms-Gh responded with an error: `'.$response->getReasonPhrase().'`');
    }
}
