<?php

namespace App\Models\Backend;

use App\Models\Frontend\MultiImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCatalog extends Model
{
    use HasFactory;

    public function orders()
    {
        return $this->hasMany(Order::class, 'product_catalogs_id');
    }

    public function multiImages()
    {
        return $this->hasMany(MultiImage::class, 'product_catalogs_id');
    }
}
