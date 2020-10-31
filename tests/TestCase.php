<?php

namespace Princetech\MobileMoney\Tests;

use Princetech\MobileMoney\Mpesa\Facades\B2C;
use Princetech\MobileMoney\Mpesa\Facades\Identity;
use Princetech\MobileMoney\Mpesa\Facades\Registrar;
use Princetech\MobileMoney\Mpesa\Facades\STK;
use Princetech\MobileMoney\MobileMoneyServiceProvider;

/**
 * Class TestCase
 * @package Princetech\MobileMoney\Tests
 */
class TestCase extends \Orchestra\Testbench\TestCase
{
    /**
     * @param \Illuminate\Foundation\Application $app
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [MobileMoneyServiceProvider::class];
    }

    protected function getPackdageAliases($app)
    {
        return [
            'B2C' => B2C::class,
            'Identity' => Identity::class,
            'Registrar' => Registrar::class,
            'STK' => STK::class,
        ];
    }
}
