<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPointsIn extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'code_id',
        'code',
        'accumulated_points',
        'product_id',
        'product_catalog_id',
        'status',
    ];


    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

}
