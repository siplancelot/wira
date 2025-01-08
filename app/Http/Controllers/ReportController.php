<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("pages.report.report");
    }

    private function getDateRangeData(string $range): array
    {
        Carbon::setLocale('id');

        switch ($range) {
            case 'today':
                $startDate = Carbon::today()->startOfDay();
                $endDate = Carbon::now()->endOfDay();
                $labels = [Carbon::now()->locale('id')->isoFormat('LL')];
                break;
            case 'yesterday':
                $startDate = Carbon::yesterday()->startOfDay();
                $endDate = Carbon::yesterday()->endOfDay();
                $labels = [Carbon::yesterday()->locale('id')->isoFormat('LL')];
                break;
            case '30days':
                $startDate = Carbon::now()->subDays(30)->startOfDay();
                $endDate = Carbon::now()->endOfDay();
                $labels = collect(range(29, 0, -1))
                    ->map(fn($day) => Carbon::now()->subDays($day)->locale('id')->isoFormat('LL'))
                    ->toArray();
                break;
            case '7days':
            default:
                $startDate = Carbon::now()->subDays(7)->startOfDay();
                $endDate = Carbon::now()->endOfDay();
                $labels = collect(range(6, 0, -1))
                    ->map(fn($day) => Carbon::now()->subDays($day)->locale('id')->isoFormat('LL'))
                    ->toArray();
                break;
        }

        if ($range === 'yesterday') {
            $actualDates = [Carbon::yesterday()->toDateString()];
        } else {
            $actualDates = collect(range(count($labels) - 1, 0, -1))
                ->map(fn($day) => Carbon::now()->subDays($day)->toDateString())
                ->toArray();
        }

        return [
            'startDate' => $startDate,
            'endDate' => $endDate,
            'labels' => $labels,
            'actualDates' => $actualDates,
        ];
    }

    public function reportIncome(Request $request){
        $range = $request->input('range', '7days');
        $dateData = $this->getDateRangeData($range);

        $totalDataPie = DB::table('wira.vorder_dt')
            ->select(
                'category_name',
                DB::raw('SUM(total) as total_products')
            )
            ->whereBetween('created_at', [$dateData['startDate'], $dateData['endDate']])
            ->groupBy('category_name')
            ->get();

        $dataBar = DB::table('wira.vincomes')
            ->select(
                'income_category_name',
                DB::raw('SUM(total) as total_products'),
                DB::raw('DATE(created_at) as date')
            )
            ->whereBetween('created_at', [$dateData['startDate'], $dateData['endDate']])
            ->groupBy('income_category_name', 'date')
            ->get();
        
        $totalDataBar = [
            'labels' => $dateData['labels'], // Keep day names for labels
            'datasets' => $dataBar->groupBy('income_category_name')->map(fn($items, $category) => [
                'label' => $category,
                'data' => collect($dateData['actualDates'])->map(fn($date) =>
                    $items->where('date', $date)->sum('total_products') ?? 0
                )->toArray(),
                'backgroundColor' => $this->getCategoryColor($category), // Customize the color
                'borderColor' => 'rgba(75, 192, 192, 1)',
                'borderWidth' => 1,
            ])->values()->toArray()
        ];

        $totalOrder = DB::table('order_hd')
            ->whereBetween('created_at', [$dateData['startDate'], $dateData['endDate']])
            ->count();

        $totalSales = DB::table('order_hd')
            ->select('total_product')
            ->whereBetween('created_at', [$dateData['startDate'], $dateData['endDate']])
            ->sum('total_product');

        $totalIncomes = DB::table('incomes')
            ->select('total')
            ->whereBetween('created_at', [$dateData['startDate'], $dateData['endDate']])
            ->sum('total');

        $incomeHistories = DB::table('order_hd')
            ->select('created_at', 'total_product', 'total_price')
            ->whereBetween('created_at', [$dateData['startDate'], $dateData['endDate']])
            ->orderByDesc('created_at')
            ->get();

        $otherIncomes = DB::table('incomes')
            ->join('income_categories', 'incomes.income_category_id', '=', 'income_categories.id')
            ->select('incomes.created_at', 'incomes.total', 'income_categories.name')
            ->whereBetween('incomes.created_at', [$dateData['startDate'], $dateData['endDate']])
            ->whereNot('income_categories.name', 'Penjualan Produk')
            ->orderByDesc('created_at')
            ->get();

        $revenueByProducts = DB::table('wira.vorder_dt')
            ->selectRaw('created_at, product_name, total, sell_price * total AS revenue, buy_price * total AS capital, sell_price * total - buy_price * total AS profit')
            ->whereBetween('created_at', [$dateData['startDate'], $dateData['endDate']])
            ->orderByDesc('created_at')
            ->get();
        
        $profits = DB::table('wira.vorder_dt')
            ->selectRaw('sell_price * total - buy_price * total AS profit')
            ->whereBetween('created_at', [$dateData['startDate'], $dateData['endDate']])
            ->get();

        $totalProfit = $profits->sum('profit');

        return view("pages.report.income", compact('totalDataPie', 'totalDataBar', 'totalOrder', 'totalSales', 'totalIncomes', 'incomeHistories', 'otherIncomes', 'revenueByProducts', 'totalProfit'));
    }

    public function reportOutcome(Request $request){
        $range = $request->input('range', '7days');
        $dateData = $this->getDateRangeData($range);

        $totalDataPie = DB::table('wira.vtransaction_stock_dt')
            ->select(
                'category_name',
                DB::raw('SUM(total) as total_products')
            )
            ->whereBetween('created_at', [$dateData['startDate'], $dateData['endDate']])
            ->groupBy('category_name')
            ->get();

        $dataBar = DB::table('wira.voutcomes')
            ->select(
                'outcome_category_name',
                DB::raw('SUM(total) as total_products'),
                DB::raw('DATE(created_at) as date')
            )
            ->whereBetween('created_at', [$dateData['startDate'], $dateData['endDate']])
            ->groupBy('outcome_category_name', 'date')
            ->get();
        
        $totalDataBar = [
            'labels' => $dateData['labels'], // Keep day names for labels
            'datasets' => $dataBar->groupBy('outcome_category_name')->map(fn($items, $category) => [
                'label' => $category,
                'data' => collect($dateData['actualDates'])->map(fn($date) =>
                    $items->where('date', $date)->sum('total_products') ?? 0
                )->toArray(),
                'backgroundColor' => $this->getCategoryColor($category), // Customize the color
                'borderColor' => 'rgba(75, 192, 192, 1)',
                'borderWidth' => 1,
            ])->values()->toArray()
        ];

        $totalRestocks = DB::table('transaction_stock_hd')
            ->whereBetween('created_at', [$dateData['startDate'], $dateData['endDate']])
            ->count();

        $totalOrder = DB::table('transaction_stock_dt')
            ->select('total')
            ->whereBetween('created_at', [$dateData['startDate'], $dateData['endDate']])
            ->sum('total');

        $totalOutcomes = DB::table('outcomes')
            ->select('total')
            ->whereBetween('created_at', [$dateData['startDate'], $dateData['endDate']])
            ->sum('total');

        $outcomeHistories = DB::table('transaction_stock_hd')
            ->select('created_at', 'total', 'price')
            ->whereBetween('created_at', [$dateData['startDate'], $dateData['endDate']])
            ->orderByDesc('created_at')
            ->get();

        $otherOutcomes = DB::table('outcomes')
            ->join('outcome_categories', 'outcomes.outcome_category_id', '=', 'outcome_categories.id')
            ->select('outcomes.created_at', 'outcomes.total', 'outcome_categories.name')
            ->whereBetween('outcomes.created_at', [$dateData['startDate'], $dateData['endDate']])
            ->whereNot('outcome_categories.name', 'Pembelian Produk')
            ->orderByDesc('created_at')
            ->get();
        
        $outcomeByProducts = DB::table('wira.vtransaction_stock_dt')
            ->select('created_at', 'product_name', 'total', 'price')
            ->whereBetween('created_at', [$dateData['startDate'], $dateData['endDate']])
            ->orderByDesc('created_at')
            ->get();

        return view("pages.report.outcome", compact('totalDataPie', 'totalDataBar', 'totalOrder', 'totalRestocks', 'totalOutcomes', 'outcomeHistories', 'otherOutcomes', 'outcomeByProducts'));
    }

    public function getCategoryColor($category) {
        switch ($category) {
            case 'Penjualan Produk':
                return 'rgba(255, 99, 132, 0.2)';
                break;
            case 'Tip':
                return 'rgba(54, 162, 235, 0.2)';
                break;
            case 'Pembelian Produk':
                return 'rgba(255, 99, 132, 0.2)';
                break;
            case 'Service / Perbaikan':
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
