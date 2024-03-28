<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cod extends Model
{
    use HasFactory;

    const AVAILABLE = 0;
    const USED = 1;

    public static function getStatusName($status)
    {
        switch ($status) {
            case self::AVAILABLE:
                return 'Available';
            case self::USED:
                return 'Used';
            default:
                return 'Status necunoscut';
        }
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
