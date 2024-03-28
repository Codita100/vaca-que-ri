<?php

namespace App\Models\Backend;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTransaction extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transactionin()
    {
        return $this->belongsTo(UserPointsIn::class, 'user_points_ins', 'id');
    }

    public function transactionOUT()
    {
        return $this->belongsTo(UserPointsOut::class, 'user_points_outs', 'id');
    }
}
