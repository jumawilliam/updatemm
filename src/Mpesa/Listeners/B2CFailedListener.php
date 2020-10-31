<?php


namespace Princetech\MobileMoney\src\Mpesa\Listeners;

use Princetech\MobileMoney\Mpesa\Events\B2cPaymentFailedEvent;

/**
 * Class B2CFailedListener
 * @package Princetech\MobileMoney\src\Mpesa\Listeners
 */
class B2CFailedListener
{
    /**
     * @param B2cPaymentFailedEvent $event
     */
    public function handle(B2cPaymentFailedEvent $event)
    {
    }
}
