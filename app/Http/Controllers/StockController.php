<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateStockRequest;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stocks = Stock::with('product')->get();

        return view('pages.stock.stock', compact('stocks'));
    }

    public function detail(){
        return view('pages.stock.detail');
    }

    public function getOneDataStock(Request $request){
        $request->validate([
            'query' => 'required|integer', 
        ]);
    
        $query = $request->get('query');
    
        $stock = Stock::where('product_id', $query)->get();
    
        // Return the stock as JSON
        return response()->json($stock);
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
    public function update(UpdateStockRequest $request, Stock $stock)
    {
        $stock = DB::transaction(function() use ($request, $stock) {     
            $validated = $request->validated();

            return $stock->update($validated);
        });

        return response()->json($stock);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
