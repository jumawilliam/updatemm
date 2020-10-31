<?php

namespace Princetech\MobileMoney\AirtelMoney\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class AirtelMoney
 * @package Princetech\MobileMoney\AirtelMoney\Facades
 */
class AirtelMoney extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'airtel_money';
    }
}
