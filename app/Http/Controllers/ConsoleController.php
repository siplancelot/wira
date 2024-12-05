<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Product;

class ConsoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $categories = Category::all();
        $products = Product::with('category')->get();


        return view('pages.console.index', compact('categories', 'products'));
    }

    public function filterCategory(Request $request){
        $request->validate([
            'query' => 'required|integer', // Assuming category_id is an integer
        ]);
    
        $query = $request->get('query');
    
        // Fetch products where category_id matches the query
        $products = Product::where('category_id', $query)->get();
    
        // Return the products as JSON
        return response()->json($products);
    }

    public function getVariant(Request $request){
        $request->validate([
            'query' => 'required|integer', // Assuming category_id is an integer
        ]);
    
        $query = $request->get('query');

        // Fetch products where category_id matches the query
        $productsVariant = Product::where('parent_id', $query)->get();
    
        // Return the products as JSON
        return response()->json($productsVariant);
        
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
