
## STK PUSH REQUEST

Sim Toolkit Request is where you initiate a payment request, the request is then pushed to users phone to validate the transaction by entering their MPESA PIN .


Initiate request

```php 
$request = mpesa_request('07xxxxxxxx',1,'reference','description');
```
You can also imitate a request by sending post request to.
 
*POST*: https://YOU-SITE/payments/callbacks/stk_request

*Parameters*
 - phone 
 - amount
 - reference
 - description 
 
::: tip
 MPESA recently allowed transactions of even KES 1.00
:::

This package emits `PrinceTech\MobileMoney\Mpesa\Events\StkPushPaymentSuccessEvent` if an STK payment was processed successfully. 
If an STK request payment is unsuccessful, it emits `PrinceTech\MobileMoney\Mpesa\Events\StkPushPaymentFailedEvent`. Both events exposes the initial request model to the registered event handlers.

## Listening for Payments
A nice and efficient way to tap this events is to register a event listener in your EventServiceProvider
````php
<?php

namespace App\Providers;

use PrinceTech\MobileMoney\Mpesa\Events\C2bConfirmationEvent;
use PrinceTech\MobileMoney\Mpesa\Events\StkPushPaymentFailedEvent;
use PrinceTech\MobileMoney\Mpesa\Events\StkPushPaymentSuccessEvent;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        C2bConfirmationEvent::class => [
            PaymentConfirmed::class,//your listening class
        ],
        StkPushPaymentFailedEvent::class => [
            StkPaymentFailed::class, //your listening classs
        ],
        StkPushPaymentSuccessEvent::class => [
            StkPaymentReceived::class,// your listening class
        ],
    ];
}

````

Here is a sample for `StkPushPaymentSuccessEvent` 
```php
<?php

namespace App\Listeners;

use PrinceTech\MobileMoney\Mpesa\Events\StkPushPaymentSuccessEvent;

/**
 * Class StkPaymentReceived
 * @package Dervis\Listeners
 */
class StkPaymentReceived
{
    /**
     * Handle the event.
     *
     * @param StkPushPaymentSuccessEvent $event
     * @return void
     */
    public function handle(StkPushPaymentSuccessEvent $event)
    {
        $stk = $event->stk_callback; //an instance of mpesa callback model
        $mpesa_request=$event->mpesa_request;// mpesa response as array
        
        //process additional details
    }
}
```
