<?php

namespace App\Enums;

enum PaymentType: int {

    case ONLINE_PAYMENT = 1;
    case CASH_ON_DELIVERY = 2;

    public function title(): string
    {
        return match($this)
        {
            $this::ONLINE_PAYMENT => 'Online Payment',
            $this::CASH_ON_DELIVERY => 'Cash on Delivery'
        };
    }
}
