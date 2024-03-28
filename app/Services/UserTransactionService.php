<?php

namespace App\Services;

use App\Mail\Backend\OperatorUserOrderCreatedEmail;
use App\Mail\Backend\ViewUserStatusChangedEmail;
use App\Models\Backend\UserTransaction;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;


class UserTransactionService
{


    public static function insertTransaction($userId, $points_id)
    {
        $transaction = new UserTransaction();
        $transaction->user_id = $userId;
        $transaction->user_points_ins = $points_id;
        $transaction->save();
    }

    public static function insertOutTransaction($userId, $points_id)
    {
        $transaction = new UserTransaction();
        $transaction->user_id = $userId;
        $transaction->user_points_outs = $points_id;
        $transaction->save();
    }
}
