<?php

namespace Princetech\MobileMoney\Mpesa\Library;

use Carbon\Carbon;

/**
 * Class IdCheck
 *
 * @package Princetech\MobileMoney\Mpesa\Library
 */
class IdCheck extends ApiCore
{
    /**
     * @param string      $number
     * @param string|null $callback
     * @return mixed
     * @throws \Exception
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function validate($number, $callback = null)
    {
        $number = $this->formatPhoneNumber($number);
        $time = Carbon::now()->format('YmdHis');
        $shortCode = \config('Princetech.mpesa.c2b.short_code');
        $passkey = \config('Princetech.mpesa.c2b.passkey');
        $defaultCallback = \config('Princetech.mpesa.id_validation_callback');
        $initiator = \config('Princetech.mpesa.initiator');
        $password = \base64_encode($shortCode . $passkey . $time);
        $body = [
            'Initiator' => $initiator,
            'BusinessShortCode' => $shortCode,
            'Password' => $password,
            'Timestamp' => $time,
            'TransactionType' => 'CheckIdentity',
            'PhoneNumber' => $number,
            'CallBackURL' => $callback ?: $defaultCallback,
            'TransactionDesc' => ' '
        ];
        return $this->sendRequest($body, 'id_check');
    }
}
