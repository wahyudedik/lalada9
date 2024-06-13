<?php

namespace App\Http\Controllers\user;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        $products = Product::paginate(8);
        $products->transform(function ($product) {
            $product->image = $product->image ? asset($product->image) : null;
            return $product;
        });
        
        $carts = Cart::where('user_id', auth()->user()->id)->get();
        return view('dashboard', compact('products', 'carts'))->with('i', (request()->input('page', 1) - 1) * 8); 
    }

    public function addToCart($id)
    {
        $product = Product::findOrFail($id);
        return view('add_to_cart', compact('product'));
    }

    public function categoryIndex()
    {
        $categories = Category::paginate(8);
        return view('category', compact('categories'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function categoryShow($id)
    {
        $products = Product::where('category_id', $id)->paginate(8);
        return view('product_by_category', compact('products'))->with('i', (request()->input('page', 1) - 1) * 8);
    }
}