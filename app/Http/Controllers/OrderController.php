<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInputOrderDTRequest;
use App\Http\Requests\StoreInputOrderHDRequest;
use App\Models\OrderDt;
use Illuminate\Http\Request;

use App\Models\OrderHd;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;

class OrderController extends Controller
{
    private function getDateRangeData(string $range): array
    {
        Carbon::setLocale('id');

        switch ($range) {
            case 'today':
                $startDate = Carbon::today()->startOfDay();
                $endDate = Carbon::now()->endOfDay();
                $days = 1;
                break;
            case 'yesterday':
                $startDate = Carbon::yesterday()->startOfDay();
                $endDate = Carbon::yesterday()->endOfDay();
                $days = 1;
                break;
            case '30days':
                $startDate = Carbon::now()->subDays(29)->startOfDay();
                $endDate = Carbon::now()->endOfDay();
                $days = 30;
                break;
            case '7days':
                $startDate = Carbon::now()->subDays(6)->startOfDay();
                $endDate = Carbon::now()->endOfDay();
                $days = 7;
                break;
            default:
                throw new InvalidArgumentException('Invalid date range provided');
        }

        // Generate actual dates based on the range
        if ($range === 'yesterday') {
            $actualDates = [Carbon::yesterday()->toDateString()];
        } elseif ($range === 'today') {
            $actualDates = [Carbon::today()->toDateString()];
        } else {
            $actualDates = collect(range($days - 1, 0))
                ->map(fn ($day) => Carbon::now()->subDays($day)->toDateString())
                ->values()
                ->toArray();
        }

        return [
            'startDate' => $startDate,
            'endDate' => $endDate,
            'actualDates' => $actualDates,
            'days' => $days,
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orderhd = OrderHd::orderByDesc('id')->get();

        return view("pages.transaction.order.index", compact('orderhd'));
    }

    public function displayByDate(Request $request) {
        $range = $request->get('range', '30days');
        $dateData = $this->getDateRangeData($range);

        $orderhd = OrderHd::whereBetween('created_at', [$dateData['startDate'], $dateData['endDate']])
            ->orderByDesc('id')
            ->get();

        return view("pages.transaction.order.index", compact('orderhd'));
    }

    public function detailOrder(Request $request){
        $request->validate([
            'query' => 'required|integer', // Assuming query is an integer
        ]);
    
        $query = $request->get('query');
    
        // Fetch orders where order_hd_id matches the query
        $orderdt = OrderDt::with('product')->where('order_hd_id', $query)->get();
    
        // Return the orders as JSON
        return response()->json($orderdt);
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
