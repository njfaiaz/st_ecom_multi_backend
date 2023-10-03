<?php

namespace App\Enums;

enum UserRole: int {

    case ADMIN = 1;
    case CUSTOMER = 2;
    case SELLER = 3;

    public function title(): string
    {
        return match($this)
        {
            UserRole::ADMIN => 'Admin',
            UserRole::CUSTOMER => 'Customer',
            UserRole::SELLER => 'Seller',
        };
    }
}
