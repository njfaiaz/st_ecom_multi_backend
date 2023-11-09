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

    public static function available_statuses()
    {
        return ['Pending', 'Processing', 'On the way', 'Shipped', 'Cancelled by Customer','Cancelled by Seller', 'Refunded'];
    }

    public static function findValue($status)
    {
        return match ($status) {
            'Pending' => self::PENDING,
            'Processing' => self::PROCESSING,
            'On the way' => self::ONGOING,
            'Shipped' => self::SHIPPED,
            'Delivered' => self::DELIVERED,
            'Cancelled by Customer' => self::CANCELLED_CUSTOMER,
            'Cancelled by Seller' => self::CANCELLED_SELLER,
            'Refunded' => self::REFUNDED,
        };
    }
}
