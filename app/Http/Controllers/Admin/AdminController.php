<?php

namespace App\Http\Controllers\admin;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index()
    {
        $products = Product::paginate(8);
        $products->transform(function ($product) {
            $product->image = $product->image ? asset($product->image) : null;
            return $product;
        });
        return view('admin.dashboard', compact('products'))->with('i', (request()->input('page', 1) - 1) * 8); 
    }
}
