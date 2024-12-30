<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreIncomeRequest;
use App\Http\Requests\StoreOutcomeRequest;
use App\Models\Income;
use App\Models\IncomeCategory;
use App\Models\Outcome;
use App\Models\OutcomeCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function viewIncome(){
        $incomes = Income::with('incomeCategory')->paginate(5);
        return view('pages.transaction.income.index', compact('incomes'));
    }

    public function viewOutcome(){
        $outcomes = Outcome::with('outcomeCategory')->paginate(5);
        return view('pages.transaction.outcome.index', compact('outcomes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createIncome()
    {
        $incomeCategories = IncomeCategory::all();

        return view('pages.transaction.income.create', compact('incomeCategories'));
    }

    public function createOutcome()
    {
        $outcomeCategories = OutcomeCategory::all();

        return view('pages.transaction.outcome.create', compact('outcomeCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeIncome(StoreIncomeRequest $request)
    {
        DB::transaction(function () use ($request) {
            $validated = $request->validated();

            if ($validated['description'] !== '--') {
                $validated['no_reference'] = 0;
            }

            Income::create($validated);
        });

        return redirect()->route('incomeview')->with('success', 'Income created successfully');
    }

    public function storeOutcome(StoreOutcomeRequest $request)
    {
        DB::transaction(function () use ($request) {
            $validated = $request->validated();

            if ($validated['description'] !== '--') {
                $validated['no_reference'] = 0;
            }

            Outcome::create($validated);
        });

        return redirect()->route('outcomeview')->with('success', 'Outcome created successfully');
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
