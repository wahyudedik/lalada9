<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Cart::where('user_id', auth()->user()->id)
            ->join('products', 'carts.product_id', '=', 'products.id')
            ->select('carts.*', 'products.name', 'products.image', 'products.price', 'products.sale_price')
            ->get();
        $total = 0;
        foreach ($products as $product) {
            $total += $product->sale_price * $product->quantity;
        }
        return view('cart', compact('products', 'total'));
    }

    public function placeOrder()
    {
        $carts = Cart::where('user_id', auth()->user()->id)->get();
        foreach ($carts as $cart) {
            $order = new Order;
            $order->user_id = auth()->user()->id;
            $order->product_id = $cart->product_id;
            $order->quantity = $cart->quantity;
            $order->total_price = $cart->total_price;
            $order->save();

            $product = Product::find($cart->product_id);
            $product->quantity -= $cart->quantity;
            $product->save();
        }
        Cart::where('user_id', auth()->user()->id)->delete();

        return redirect()->route('dashboard')->with('success', 'Order success');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'quantity' => 'required',
        ]);

        $product = Product::findOrFail($request->product_id);
        if ($product->quantity < $request->quantity) {
            return redirect()->back()->with('error', 'Stock not enough');
        }

        $cart = Cart::create([
            'user_id' => auth()->user()->id,
            'product_id' => $product->id,
            'quantity' => $request->quantity,
            'total_price' => $product->sale_price * $request->quantity,
        ]);
        return redirect()->route('dashboard.cart', compact('cart'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        //
    }
}
