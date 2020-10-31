<?php

namespace Princetech\MobileMoney\Mpesa\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Identity
 * @package Princetech\MobileMoney\Mpesa\Facades
 */
class Identity extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'mpesa_identity';
    }
}
