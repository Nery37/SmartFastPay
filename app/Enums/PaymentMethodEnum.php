<?php

declare(strict_types=1);

namespace App\Enums;

enum PaymentMethodEnum: int implements EnumInterface
{
    case BILLET = 1;
    case PIX = 2;
    case BANK_TRANSFER = 3;

    public static function toArray(): array
    {
        return [
            PaymentMethodEnum::BILLET,
            PaymentMethodEnum::PIX,
            PaymentMethodEnum::BANK_TRANSFER,
        ];
    }

    public function getTranslatedName(): string
    {
        return match ($this) {
            PaymentMethodEnum::BILLET => 'Boleto Bancário',
            PaymentMethodEnum::PIX => 'PIX',
            PaymentMethodEnum::BANK_TRANSFER => 'Transferência Bancária',
        };
    }

    public static function getById(int $id): EnumInterface
    {
        return match ($id) {
            PaymentMethodEnum::BILLET->value => PaymentMethodEnum::BILLET,
            PaymentMethodEnum::PIX->value => PaymentMethodEnum::PIX,
            PaymentMethodEnum::BANK_TRANSFER->value => PaymentMethodEnum::BANK_TRANSFER,
        };
    }
}
