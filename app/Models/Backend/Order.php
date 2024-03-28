<?php

namespace App\Models\Backend;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function productCatalog()
    {
        return $this->belongsTo(ProductCatalog::class, 'product_catalogs_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public static function getProductCountForUser($userId, $productId)
    {
        return static::where('user_id', $userId)
            ->where('product_catalogs_id', $productId)
            ->count();
    }
}
