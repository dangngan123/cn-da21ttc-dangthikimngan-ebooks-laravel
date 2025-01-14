<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ManageStatisticsComponent extends Component
{
    public $startDate;
    public $endDate;
    public $filterType = 'custom';

    protected $listeners = ['dateRangeUpdated' => 'updateDateRange'];

    public function mount()
    {
        $this->startDate = now()->subWeek()->format('Y-m-d');
        $this->endDate = now()->format('Y-m-d');
    }
    public function updatedFilterType($value)
    {
        switch ($value) {
            case 'today':
                $this->startDate = now()->format('Y-m-d');
                $this->endDate = now()->format('Y-m-d');
                break;
            case 'week':
                $this->startDate = now()->startOfWeek()->format('Y-m-d');
                $this->endDate = now()->endOfWeek()->format('Y-m-d');
                break;
            case 'month':
                $this->startDate = now()->startOfMonth()->format('Y-m-d');
                $this->endDate = now()->endOfMonth()->format('Y-m-d');
                break;
            case 'custom':
            default:
                // Không thay đổi startDate và endDate trong trường hợp tùy chỉnh
                break;
        }
    }





    public function render()
    {
        $orders = Order::whereBetween('created_at', [
            $this->startDate . ' 00:00:00',
            $this->endDate . ' 23:59:59'
        ])->get();

        $products = Product::all();

        // Calculate statistics
        $statistics = [
            'revenue' => $orders->sum('total'),
            'orders_count' => $orders->count(),
            'products_count' => $products->count(),
            'low_stock_count' => $products->where('quantity', '<', 5)->count()
        ];

        // Get revenue data for chart
        $revenueData = Order::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('SUM(total) as daily_revenue')
        )
            ->whereBetween('created_at', [
                $this->startDate . ' 00:00:00',
                $this->endDate . ' 23:59:59'
            ])
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy('date')
            ->get();

        // Get product categories for pie chart
        $categoryData = Product::select('category_id', DB::raw('count(*) as count'))
            ->groupBy('category_id')
            ->with('category')
            ->get()
            ->map(function ($item) {
                return [
                    'count' => $item->count,
                    'category' => [
                        'name' => $item->category->name ?? 'Uncategorized'
                    ]
                ];
            });

        // Get daily order count data for the new chart
        $orderCountData = Order::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('count(*) as daily_order_count')
        )
            ->whereBetween('created_at', [
                $this->startDate . ' 00:00:00',
                $this->endDate . ' 23:59:59'
            ])
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy('date')
            ->get();
        $dailyOrdersData = Order::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('count(*) as order_count')
        )
            ->whereBetween('created_at', [
                $this->startDate . ' 00:00:00',
                $this->endDate . ' 23:59:59'
            ])
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy('date')
            ->get();







        return view('livewire.admin.manage-statistics-component', [
            'statistics' => $statistics,
            'revenueData' => $revenueData,
            'categoryData' => $categoryData,
            'orderCountData' => $orderCountData, // Pass the order count data to the view
            'dailyOrdersData' => $dailyOrdersData // Pass the daily orders data to the view
        ]);
    }
}
