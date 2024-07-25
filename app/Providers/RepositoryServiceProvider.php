<?php

declare(strict_types=1);

namespace App\Providers;

use App\Repositories\MerchantRepository;
use App\Repositories\MerchantRepositoryEloquent;
use App\Repositories\PasswordResetRepository;
use App\Repositories\PasswordResetRepositoryEloquent;
use App\Repositories\PaymentMethodRepository;
use App\Repositories\PaymentMethodRepositoryEloquent;
use App\Repositories\PaymentRepository;
use App\Repositories\PaymentRepositoryEloquent;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register() {}

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        $this->app->bind(MerchantRepository::class, MerchantRepositoryEloquent::class);
        $this->app->bind(PasswordResetRepository::class, PasswordResetRepositoryEloquent::class);
        $this->app->bind(PaymentRepository::class, PaymentRepositoryEloquent::class);
        $this->app->bind(PaymentMethodRepository::class, PaymentMethodRepositoryEloquent::class);
    }
}
