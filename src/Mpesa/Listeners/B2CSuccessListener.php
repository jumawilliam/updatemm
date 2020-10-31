<?php


namespace Princetech\MobileMoney\src\Mpesa\Listeners;

use Princetech\MobileMoney\Mpesa\Database\Entities\MpesaBulkPaymentResponse;
use Princetech\MobileMoney\Mpesa\Events\B2cPaymentSuccessEvent;

/**
 * Class B2CSuccessListener
 * @package Princetech\MobileMoney\src\Mpesa\Listeners
 */
class B2CSuccessListener
{
    /**
     * @param B2cPaymentSuccessEvent $event
     */
    public function handle(B2cPaymentSuccessEvent $event)
    {
    }
}
