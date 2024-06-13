<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function index(){
        $products = Product::paginate(8);
        $products->transform(function ($product) {
            $product->image = $product->image ? asset($product->image) : null;
            return $product;
        });
        return view('welcomee', compact('products'))->with('i', (request()->input('page', 1) - 1) * 8); 
    }

    public function category(){
        $categories = Category::paginate(8);
        return view('guest_category', compact('categories'))->with('i', (request()->input('page', 1) - 1) * 8); 
    }

    public function show($id)
    {
        $products = Product::where('category_id', $id)->paginate(8);
        return view('guest_product_by_category', compact('products'))->with('i', (request()->input('page', 1) - 1) * 8);
    }
}
