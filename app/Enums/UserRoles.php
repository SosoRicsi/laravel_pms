<?php

declare(strict_types=1);

namespace App\Enums;

enum UserRoles: string
{
    case OWNER = 'owner';
    case ADMIN = 'admin';
    case MODERATOR = 'moderator';
    case PARTNER = 'partner';
    case WORKER = 'worker';
    case USER = 'user';

    public static function list(): array
    {
        $array = [];
        // $array = array_column(self::cases(), 'value');
        foreach (self::cases() as $case) {
            $array[] = [
                'value' => $case,
                'display' => $case->display(),
            ];
        }

        return $array;
    }

    public static function toArray(): array
    {
        return [
            'owner' => self::OWNER->value,
            'admin' => self::ADMIN->value,
            'moderator' => self::MODERATOR->value,
            'partner' => self::PARTNER->value,
            'worker' => self::PARTNER->value,
            'user' => self::USER->value,
        ];
    }

    public static function implode(string $separator): string
    {
        return implode($separator, self::toArray());
    }

    public function display(): string
    {
        return match ($this) {
            self::OWNER => 'Tulajdonos',
            self::ADMIN => 'Admin',
            self::MODERATOR => 'Moderátor',
            self::PARTNER => 'Partner',
            self::WORKER => 'Munkás',
            self::USER => 'Felhasználó',
        };
    }
}
