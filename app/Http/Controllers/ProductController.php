<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category')->get();

        return view('pages.product.index', compact('products'));
    }

    public function detail(Product $product){
        return view('pages.product.detail', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $products = Product::with('category')->get();
        
        return view('pages.product.create', compact('categories', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        DB::transaction(function () use ($request) {
            $validated = $request->validated();

            $validated['parent_id'] = $validated['parent_id'] ?? 0;

            if ($request->hasFile('product_image')) {
                $imagePath = $request->file('product_image')->store('productImages', 'public');
                $validated['product_image'] = $imagePath;
            }

            Product::create($validated);
        });

        return redirect()->route('admin.product.index')->with('success', 'Product created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $productDetails = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select('products.*', 'categories.category_name')
            ->where('products.parent_id', $product->id)
            ->get();

        dd($productDetails);

        return view('pages.product.detail', compact('productDetails'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();

        return view('pages.product.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        DB::transaction(function () use ($request, $product) {
            $validated = $request->validated();

            if ($request->hasFile('product_image')) {
                if ($product->product_image) {
                    Storage::delete($product->product_image);
                }
                $imagePath = $request->file('product_image')->store('productImages', 'public');
                $validated['product_image'] = $imagePath;
            }

            $product->update($validated);
        });

        return redirect()->route('admin.product.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        DB::transaction(function () use ($product) {
            $product->delete();
        });

        return redirect()->route('admin.product.index');
    }
}
