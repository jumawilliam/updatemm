<?php
/**
 * Part of the Ignite Platform.
 *
 * NOTICE OF LICENSE
 *
 * Licensed under the 3-clause BSD License.
 *
 * This source file is subject to the 3-clause BSD License that is
 * bundled with this package in the LICENSE file.
 *
 * @package    pesa
 * @version    1.0.0
 * @author     Dervis Group  LLC
 * @license    BSD License (3-clause)
 * @copyright  (c) 2018, Dervis Group LLC
 * @link       https://dervisgroup.com
 */

namespace Princetech\MobileMoney\Mpesa\Listeners;

use Princetech\MobileMoney\Mpesa\Events\StkPushPaymentFailedEvent;

/**
 * Class StkPaymentFailed
 * @package Princetech\MobileMoney\Listeners
 */
class StkPaymentFailed
{
    /**
     * @param StkPushPaymentFailedEvent $event
     */
    public function handle(StkPushPaymentFailedEvent $event)
    {
        /** @var \Princetech\MobileMoney\Mpesa\Database\Entities\MpesaStkCallback $stk */
        $stk = $event->stk_callback;
        $stk->request()->update(['status' => 'Failed']);
    }
}
