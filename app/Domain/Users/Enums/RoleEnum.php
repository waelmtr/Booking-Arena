<?php

namespace App\Domain\Users\Enums;

enum RoleEnum : string {
    case User = "user";
    case ArenaOwner = "arena-owner";
    public static function allRoles(): array{
        return array_column(self::cases() , 'value');
    }
}