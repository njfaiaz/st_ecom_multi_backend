<?php
namespace App\Enums;

enum OrderStatus: int {

    case PENDING = 1;
    casE PROCESSING = 2;
    case ONGOING = 3;
    case SHIPPED = 4;
    case DELIVERED = 5;
    case CANCELLED_CUSTOMER = 6;
    case CANCELLED_SELLER = 7;
    case REFUNDED = 8;

    public function title(): string
    {
        return match($this)
        {
            $this::PENDING => 'Pending',
            $this::PROCESSING => 'Processing',
            $this::ONGOING => 'On the way',
            $this::SHIPPED => 'Shipped',
            $this::DELIVERED => 'Delivered',
            $this::CANCELLED_CUSTOMER => 'Cancelled by Customer',
            $this::CANCELLED_SELLER => 'Cancelled by Seller',
            $this::REFUNDED => 'Refunded'
        };
    }
}
