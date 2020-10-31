<?php

namespace Princetech\MobileMoney\Mpesa\Library;

use GuzzleHttp\ClientInterface;

/**
 * Class Core
 *
 * @package Princetech\MobileMoney\Mpesa\Library
 */
class Core
{
    /**
     * @var ClientInterface
     */
    public $client;
    /**
     * @var Authenticator
     */
    public $auth;

    /**
     * Core constructor.
     *
     * @param  ClientInterface $client
     * @throws \Princetech\MobileMoney\Mpesa\Exceptions\MpesaException
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
        $this->auth = new Authenticator($this);
    }
}
