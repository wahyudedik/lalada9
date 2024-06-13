<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.product_create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'category_id' => 'required|integer',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:4248',
            'sale_price' => 'nullable|numeric',
        ]);

        $product = new Product($validatedData);
        $product->sku = 'lalada' . rand(100, 999);
        $quantity = $request->quantity;
        $product->quantity = $quantity;

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('storage/product'), $imageName);
            $product->image = 'storage/product/' . $imageName;
        }

        $product->save();

        return redirect()->route('admin.dashboard')->with('success', 'Product created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.product_details', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('admin.product_update', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'category_id' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:4248',
            'sale_price' => 'nullable|numeric',
            'sku' => 'required',
        ]);

        $product = Product::findOrFail($id);
        $quantity = $request->quantity;
        $product->quantity = $quantity;
        if ($request->hasFile('image')) {
            // remove old image
            if ($product->image) {
                $imagePath = public_path($product->image);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
            // upload new image
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('storage/product'), $imageName);
            $product->image = 'storage/product/' . $imageName;
        }
        $product->update($validatedData);

        return redirect()->route('admin.dashboard')->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        if ($product->image) {
            $imagePath = public_path($product->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
        $product->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Product deleted successfully');
    }
}
