<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\select;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("pages.report.report");
    }

    public function reportIncome(){
        Carbon::setLocale('id');

        $sevenDaysAgo = Carbon::now()->subDays(7)->startOfDay();
        $sevenDaysAgoBar = collect(range(6, 0, -1))
            ->map(fn($day) => Carbon::now()->subDays($day)->locale('id')->isoFormat('LL'))
            ->toArray();
        $actualDates = collect(range(6, 0, -1))
            ->map(fn($day) => Carbon::now()->subDays($day)->toDateString()) // 'Y-m-d'
            ->toArray();

        $totalDataPie = DB::table('wira.vorder_dt')
            ->select(
                'category_name',
                DB::raw('SUM(total) as total_products')
            )
            ->where('created_at', '>=', $sevenDaysAgo)
            ->groupBy('category_name')
            ->get();

        $dataBar = DB::table('wira.vincomes')
            ->select(
                'income_category_name',
                DB::raw('SUM(total) as total_products'),
                DB::raw('DATE(created_at) as date')
            )
            ->where('created_at', '>=', $sevenDaysAgo)
            ->groupBy('income_category_name', 'date')
            ->get();
        
        $totalDataBar = [
            'labels' => $sevenDaysAgoBar, // Keep day names for labels
            'datasets' => $dataBar->groupBy('income_category_name')->map(fn($items, $category) => [
                'label' => $category,
                'data' => collect($actualDates)->map(fn($date) =>
                    $items->where('date', $date)->sum('total_products') ?? 0
                )->toArray(),
                'backgroundColor' => $this->getCategoryColor($category), // Customize the color
                'borderColor' => 'rgba(75, 192, 192, 1)',
                'borderWidth' => 1,
            ])->values()->toArray()
        ];

        $totalOrder = DB::table('order_hd')->count();

        $totalSales = DB::table('order_hd')->select('total_product')->sum('total_product');

        $totalIncomes = DB::table('incomes')->select('total')->sum('total');

        $incomeHistories = DB::table('order_hd')->select('created_at', 'total_product', 'total_price')->get();

        $otherIncomes = DB::table('incomes')
            ->join('income_categories', 'incomes.income_category_id', '=', 'income_categories.id')
            ->select('incomes.created_at', 'incomes.total', 'income_categories.name')
            ->whereNot('income_categories.name', 'Penjualan Produk')
            ->get();

        $revenueByProducts = DB::table('wira.vorder_dt')
            ->selectRaw('created_at, product_name, total, sell_price * total AS revenue, buy_price * total AS capital, sell_price * total - buy_price * total AS profit')
            ->get();
        
        $profits = DB::table('wira.vorder_dt')
            ->selectRaw('sell_price * total - buy_price * total AS profit')
            ->get();

        $totalProfit = $profits->sum('profit');

        return view("pages.report.income", compact('totalDataPie', 'totalDataBar', 'totalOrder', 'totalSales', 'totalIncomes', 'incomeHistories', 'otherIncomes', 'revenueByProducts', 'totalProfit'));
    }

    public function getCategoryColor($category) {
        switch ($category) {
            case 'Penjualan Produk':
                return 'rgba(255, 99, 132, 0.2)';
                break;
            case 'Tip':
                return 'rgba(54, 162, 235, 0.2)';
                break;
            case 'Lain - lain':
                return 'rgba(255, 206, 86, 0.2)';
                break;
            default:
                return 'rgba(75, 192, 192, 0.2)';
                break;
        }
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
