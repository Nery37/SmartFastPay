<?php

declare(strict_types=1);

namespace App\Wrappers\Interfaces;

interface PaymentGatewayInterface
{
    public function process(): bool;
}
