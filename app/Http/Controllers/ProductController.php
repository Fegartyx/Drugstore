<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.products.index', [
            'products' => product::latest()->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.products.create', [
            'categories' => Category::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->image === null || $request->category_id === null) {
            $rules = [
                'name' => 'required|max:255',
                'description' => 'required',
                'price' => 'required',
                'status' => 'required|in:available,unavailable',
                'slug' => 'required',
                'release_date' => 'required|date|after_or_equal:today',
                'expire_date' => 'required|date|after_or_equal:today',
                'stock' => 'required',
            ];
        } else {
            $rules = [
                'name' => 'required|max:255',
                'description' => 'required',
                'category_id' => 'required',
                'price' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
                'status' => 'required|in:available,unavailable',
                'stock' => 'required',
                'slug' => 'required',
                'release_date' => 'required|date|after_or_equal:today',
                'expire_date' => 'required|date|after_or_equal:today',
            ];
        }
        $validatedData = $request->validate($rules);


        if ($request->category_id === null) {
            $validatedData['category_id'] = 1;
        }

        if ($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')->store('product-images');
        }

        Product::create($validatedData);

        return redirect('/features/products')->with('success', 'New product has been added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(product $product)
    {
        return view('pages.products.edit', [
            'product' => $product,
            'categories' => Category::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, product $product)
    {
        if ($request->category_id === null) {
            $rules = [
                'name' => 'required|max:255',
                'price' => 'required',
                'description' => 'required',
                'status' => 'required|in:available,unavailable',
                'stock' => 'required',
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg',
                'slug' => 'required',
                'release_date' => 'required|date|after_or_equal:today',
                'expire_date' => 'required|date|after_or_equal:today',
            ];
        } else {
            $rules = [
                'name' => 'required|max:255',
                'description' => 'required',
                'category_id' => 'required',
                'price' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
                'status' => 'required|in:available,unavailable',
                'stock' => 'required',
                'slug' => 'required',
                'release_date' => 'required|date|after_or_equal:today',
                'expire_date' => 'required|date|after_or_equal:today',
            ];
        }
        $validatedData = $request->validate($rules);

        if ($request->category_id === null) {
            $validatedData['category_id'] = 1;
        }

        if ($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')->store('product-images');
        }

        Product::where('id', $product->id)->update($validatedData);

        return redirect('/features/products')->with('success', 'Product updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(product $product)
    {
        if ($product->image) {
            Storage::delete($product->image);
        }
        product::destroy($product->id);

        return redirect('/features/product')->with('success', 'User deleted successfully!');
    }
}
