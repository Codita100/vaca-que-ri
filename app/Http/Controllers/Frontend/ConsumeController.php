<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Backend\ProductCatalog;
use Illuminate\Http\Request;

class ConsumeController extends Controller
{
    public function index()
    {
        $products = ProductCatalog::get();
        return view('frontend.consume.index', compact('products'));
    }
}
