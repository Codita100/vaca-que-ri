<?php

namespace App\Services;

use App\Mail\Backend\OperatorUserOrderCreatedEmail;
use App\Mail\Backend\ViewUserStatusChangedEmail;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;


class CheckInactiveProducts
{
    public static $hasInactiveProduct = false;

    public static function checkInactiveProduct($order)
    {
        foreach ($order->orderItems as $orderItem) {
            if ($orderItem->product->product->status === 0) {
                static::$hasInactiveProduct = true;
                break;
            }
        }
    }
}
