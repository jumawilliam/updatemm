<?php

namespace Princetech\MobileMoney\Mpesa\Events;

use Princetech\MobileMoney\Mpesa\Database\Entities\MpesaStkRequest;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Http\Request;
use Illuminate\Queue\SerializesModels;

/**
 * Class StkPushRequestedEvent
 * @package Princetech\MobileMoney\Mpesa\Events
 */
class StkPushRequestedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    /**
     * @var MpesaStkRequest
     */
    public $stk;
    /**
     * @var
     */
    public $request;

    /**
     * StkPushRequestedEvent constructor.
     * @param MpesaStkRequest $mpesaStkRequest
     * @param Request $request
     */
    public function __construct(MpesaStkRequest $mpesaStkRequest, Request $request)
    {
        $this->stk = $mpesaStkRequest;
        $this->request = $request;
    }
}
