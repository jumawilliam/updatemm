<?php

namespace Princetech\MobileMoney\Mpesa\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Registrar
 * @package Princetech\MobileMoney\Mpesa\Facades
 */
class Registrar extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'mpesa_registrar';
    }
}
