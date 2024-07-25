<?php

declare(strict_types=1);

namespace App\Providers;

use App\Wrappers\Interfaces\PaymentGatewayInterface;
use App\Wrappers\PaymentGateway;
use Illuminate\Support\ServiceProvider;

class WrapperServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(PaymentGatewayInterface::class, PaymentGateway::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
    }
}
