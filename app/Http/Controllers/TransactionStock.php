<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransactionStockDTRequest;
use App\Http\Requests\StoreTransactionStockHDRequest;
use App\Models\Transaction_stock_dt;
use App\Models\Transaction_stock_hd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionStock extends Controller
{
    public function inputTransactionStockHd(StoreTransactionStockHDRequest $request){
        $transactionStockHD = DB::transaction(function() use ($request) {
            $validated = $request->validated();

            return Transaction_stock_hd::create($validated);
        });

        return response()->json($transactionStockHD, 201);
    }

    public function inputTransactionStockDt(StoreTransactionStockDTRequest $request){
        $transactionStockDT = DB::transaction(function() use ($request) {
            $validated = $request->validated();

            return Transaction_stock_dt::create($validated);
        });

        return response()->json($transactionStockDT, 201);
    }
}
