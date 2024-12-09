<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInputOrderDTRequest;
use App\Http\Requests\StoreInputOrderHDRequest;
use App\Models\OrderDt;
use Illuminate\Http\Request;

use App\Models\OrderHd;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("pages.transaction.order.index");
    }

    public function inputOrderHd(StoreInputOrderHDRequest $request){
        $orderHD = DB::transaction(function() use ($request) {
            $validated = $request->validated();

            return OrderHd::create($validated);
        });

        return response()->json([
            'id' => $orderHD->id
        ], 201);
    }

    public function inputOrderDt(StoreInputOrderDTRequest $request){
        $orderDT = DB::transaction(function() use ($request) {
            $validated = $request->validated();

            return OrderDt::create($validated);
        });

        return response()->json($orderDT, 201);
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
