<?php

namespace Princetech\MobileMoney\Mpesa\Library;

use Princetech\MobileMoney\Mpesa\Exceptions\MpesaException;
use GuzzleHttp\Exception\ServerException;

/**
 * Class BulkSender
 *
 * @package Princetech\MobileMoney\Mpesa\Library
 */
class BulkSender extends ApiCore
{
    /**
     * @var string
     */
    private $number;
    /**
     * @var int
     */
    private $amount;
    /**
     * @var string
     */
    private $remarks = 'Some remarks';
    /**
     * @var int
     */
    private $trials = 3;


    /**
     * Set number to receive the funds
     *
     * @param string $number
     * @return $this
     */
    public function to($number): self
    {
        $this->number = $this->formatPhoneNumber($number);
        return $this;
    }

    public function withRemarks($remarks): self
    {
        $this->remarks = $remarks;
        return $this;
    }

    /**
     * The amount to transact
     *
     * @param  $amount
     * @return $this
     */
    public function amount($amount): self
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @param string|null $number
     * @param int|null $amount
     * @param string|null $remarks
     * @return mixed
     * @throws \Princetech\MobileMoney\Mpesa\Exceptions\MpesaException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws MpesaException
     */
    public function send($number = null, $amount = null, $remarks = null)
    {
        $body = [
            'InitiatorName' => \config('Princetech.mpesa.b2c.initiator'),
            'SecurityCredential' => \config('Princetech.mpesa.b2c.security_credential'),
            'CommandID' => 'BusinessPayment', //SalaryPayment,BusinessPayment,PromotionPayment
            'Amount' => $amount ?: $this->amount,
            'PartyA' => \config('Princetech.mpesa.b2c.short_code'),
            'PartyB' => $this->formatPhoneNumber($number ?: $this->number),
            'Remarks' => $remarks ?: $this->remarks,
            'QueueTimeOutURL' => \config('Princetech.mpesa.b2c.timeout_url') . 'b2c',
            'ResultURL' => \config('Princetech.mpesa.b2c.result_url') . 'b2c',
            'Occasion' => ' '
        ];
        $this->bulk = true;
        try {
            $response = $this->sendRequest($body, 'b2c');
            return $this->mpesaRepository->saveB2cRequest($response, $body);
        } catch (ServerException $exception) { //sometimes this endpoint behaves weird even for a nice request lets retry 1 atleast
            if ($this->trials > 0) {
                $this->trials--;
                return $this->send($number, $amount, $remarks);
            }
            throw new MpesaException('Server Error');
        }
    }

    /**
     * @return mixed
     * @throws \Princetech\MobileMoney\Mpesa\Exceptions\MpesaException
     * @throws \Exception
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function balance()
    {
        $body = [
            'CommandID' => 'AccountBalance',
            'Initiator' => \config('Princetech.mpesa.bulk.initiator'),
            'SecurityCredential' => \config('Princetech.mpesa.bulk.security_credential'),
            'PartyA' => \config('Princetech.mpesa.bulk.short_code'),
            'IdentifierType' => 4,
            'Remarks' => 'Checking Balance',
            'QueueTimeOutURL' => \config('Princetech.mpesa.bulk.timeout_url') . 'bulk_balance',
            'ResultURL' => \config('Princetech.mpesa.bulk.result_url') . 'bulk_balance',
        ];
        $this->bulk = true;
        return $this->sendRequest($body, 'account_balance');
    }
}
