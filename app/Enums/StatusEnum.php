<?php

declare(strict_types=1);

namespace App\Enums;

enum StatusEnum: int
{
    case CONCLUDED = 1;
    case PENDING = 2;

    public function getTranslateName(): string
    {
        return match ($this) {
            self::CONCLUDED => 'Concluído',
            self::PENDING => 'Pendente',
        };
    }

    public static function getById(int $id): StatusEnum
    {
        return match ($id) {
            1 => self::CONCLUDED,
            2 => self::PENDING,
            default => throw new \InvalidArgumentException('Invalid status ID.')
        };
    }

    public static function getByName(string $name): StatusEnum
    {
        $name = strtoupper($name);

        return match ($name) {
            self::CONCLUDED->name => self::CONCLUDED,
            self::PENDING->name => self::PENDING,
            default => throw new \InvalidArgumentException('Invalid status ID.')
        };
    }
}
