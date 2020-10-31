<?php

namespace Princetech\MobileMoney\Mpesa\Repositories;

use Princetech\MobileMoney\Mpesa\Library\RegisterUrl;

/**
 * Class Register
 * @package Princetech\MobileMoney\Mpesa\Repositories
 */
class Register
{
    /**
     * @var RegisterUrl
     */
    private $registra;

    /**
     * Register constructor.
     * @param RegisterUrl $registerUrl
     */
    public function __construct(RegisterUrl $registerUrl)
    {
        $this->registra = $registerUrl;
    }

    /**
     * @return mixed
     * @throws \Princetech\MobileMoney\Mpesa\Exceptions\MpesaException
     * @throws \Exception
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function doRegister()
    {
        return $this->registra->register(\config('Princetech.mpesa.c2b.short_code'))
            ->onConfirmation(\config('Princetech.mpesa.c2b.confirmation_url'))
            ->onValidation(\config('Princetech.mpesa.c2b.validation_url'))
            ->submit();
    }
}
