<?php

namespace Princetech\MobileMoney\AirtelMoney;

use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Princetech\MobileMoney\AirtelMoney\Library\Cashier;

/**
 * Class AirtelMoneyServiceProvider
 * @package Princetech\MobileMoney\AirtelMoney
 */
class AirtelMoneyServiceProvider extends ServiceProvider
{
    /**
     *
     */
    public function register()
    {
        $this->app->bind('airtel_money', function (Application $app) {
            return $app->make(Cashier::class);
        });
    }
}
