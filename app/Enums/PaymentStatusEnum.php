<?php

declare(strict_types=1);

namespace App\Enums;

enum PaymentStatusEnum: int implements EnumInterface
{
    case PENDING = 1;
    case PAID = 2;
    case EXPIRED = 3;
    case FAILED = 4;

    public static function toArray(): array
    {
        return [
            PaymentStatusEnum::PENDING,
            PaymentStatusEnum::PAID,
            PaymentStatusEnum::EXPIRED,
            PaymentStatusEnum::FAILED,
        ];
    }

    public function getTranslatedName(): string
    {
        return match ($this) {
            PaymentStatusEnum::PENDING => 'Pendente',
            PaymentStatusEnum::PAID => 'Pago',
            PaymentStatusEnum::EXPIRED => 'Expirado',
            PaymentStatusEnum::FAILED => 'Falhou',
        };
    }

    public static function getById(int $id): EnumInterface
    {
        return match ($id) {
            PaymentStatusEnum::PENDING->value => PaymentStatusEnum::PENDING,
            PaymentStatusEnum::PAID->value => PaymentStatusEnum::PAID,
            PaymentStatusEnum::EXPIRED->value => PaymentStatusEnum::EXPIRED,
            PaymentStatusEnum::FAILED->value => PaymentStatusEnum::FAILED,
        };
    }
}
