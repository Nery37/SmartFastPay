<?php

declare(strict_types=1);

namespace App\Wrappers;

use App\Adapters\HttpClientAdapter;
use App\Entities\Payment;
use App\Wrappers\Interfaces\PaymentGatewayInterface;

/**
 * PaymentGateway.
 */
class PaymentGateway implements PaymentGatewayInterface
{
    private $client;

    public function __construct()
    {
        $this->client = new HttpClientAdapter(['verify' => false]);
    }

    public function process(): bool
    {
        // Simulando resposta.
        return rand(0, 100) < 70;
    }
}
