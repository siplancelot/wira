<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransactionStockDTRequest;
use App\Http\Requests\StoreTransactionStockHDRequest;
use App\Models\TransactionStockDT;
use App\Models\TransactionStockHD;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionStockController extends Controller
{
    public function inputTransactionStockHd(StoreTransactionStockHDRequest $request){
        $transactionStockHD = DB::transaction(function() use ($request) {
            $validated = $request->validated();

            TransactionStockHD::create($validated);
        });

        return response()->json($transactionStockHD, 201);
    }

    public function inputTransactionStockDt(StoreTransactionStockDTRequest $request){
        $transactionStockDT = DB::transaction(function() use ($request) {
            $validated = $request->validated();

            TransactionStockDT::create($validated);
        });

        return response()->json($transactionStockDT, 201);
    }
}
