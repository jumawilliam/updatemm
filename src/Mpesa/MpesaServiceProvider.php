<?php

namespace Princetech\MobileMoney\Mpesa;

use Princetech\MobileMoney\Mpesa\Commands\Registra;
use Princetech\MobileMoney\Mpesa\Commands\StkStatus;
use Princetech\MobileMoney\Mpesa\Events\B2cPaymentFailedEvent;
use Princetech\MobileMoney\Mpesa\Events\B2cPaymentSuccessEvent;
use Princetech\MobileMoney\Mpesa\Events\C2bConfirmationEvent;
use Princetech\MobileMoney\Mpesa\Events\StkPushPaymentFailedEvent;
use Princetech\MobileMoney\Mpesa\Events\StkPushPaymentSuccessEvent;
use Princetech\MobileMoney\Mpesa\Http\Middlewares\MobileMoneyCors;
use Princetech\MobileMoney\Mpesa\Library\BulkSender;
use Princetech\MobileMoney\Mpesa\Library\Core;
use Princetech\MobileMoney\Mpesa\Library\IdCheck;
use Princetech\MobileMoney\Mpesa\Library\RegisterUrl;
use Princetech\MobileMoney\Mpesa\Library\StkPush;
use Princetech\MobileMoney\Mpesa\Listeners\C2bPaymentConfirmation;
use Princetech\MobileMoney\Mpesa\Listeners\StkPaymentFailed;
use Princetech\MobileMoney\Mpesa\Listeners\StkPaymentSuccessful;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Princetech\MobileMoney\src\Mpesa\Listeners\B2CFailedListener;
use Princetech\MobileMoney\src\Mpesa\Listeners\B2CSuccessListener;

/**
 * Class MpesaServiceProvider
 * @package Princetech\MobileMoney\Mpesa
 */
class MpesaServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     * @throws Exceptions\MpesaException
     */
    public function register()
    {
        $core = new Core(new Client(['http_errors' => false,]));
        $this->app->bind(Core::class, function () use ($core) {
            return $core;
        });
        $this->commands(
            [
                Registra::class,
                StkStatus::class,
            ]
        );

        $this->registerFacades();
        $this->registerEvents();
        $this->mergeConfigFrom(__DIR__ . '/../../config/Princetech.mpesa.php', 'Princetech.mpesa');
    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/Http/routes.php');
        $this->loadMigrationsFrom(__DIR__ . '/Database/Migrations');
        $this->publishes([__DIR__ . '/../../config/Princetech.mpesa.php' => config_path('Princetech.mpesa.php'),]);

        $this->app['router']->aliasMiddleware('pesa.cors', MobileMoneyCors::class);
    }

    /**
     * Register facade accessors
     */
    private function registerFacades()
    {
        $this->app->bind(
            'mpesa_stk',
            function () {
                return $this->app->make(StkPush::class);
            }
        );
        $this->app->bind(
            'mpesa_registrar',
            function () {
                return $this->app->make(RegisterUrl::class);
            }
        );
        $this->app->bind(
            'mpesa_identity',
            function () {
                return $this->app->make(IdCheck::class);
            }
        );
        $this->app->bind(
            'mpesa_b2c',
            function () {
                return $this->app->make(BulkSender::class);
            }
        );
    }

    /**
     * Register events
     */
    private function registerEvents()
    {
        Event::listen(StkPushPaymentSuccessEvent::class, StkPaymentSuccessful::class);
        Event::listen(StkPushPaymentFailedEvent::class, StkPaymentFailed::class);
        Event::listen(C2bConfirmationEvent::class, C2bPaymentConfirmation::class);
        Event::listen(B2cPaymentSuccessEvent::class, B2CSuccessListener::class);
        Event::listen(B2cPaymentFailedEvent::class, B2CFailedListener::class);
    }
}
