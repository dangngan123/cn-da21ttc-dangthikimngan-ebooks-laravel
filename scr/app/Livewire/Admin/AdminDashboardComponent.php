<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Order;
use Carbon\Carbon;
use App\Models\Review;

use Livewire\WithPagination;

class AdminDashboardComponent extends Component
{
    use WithPagination;
    public $pagesize = 5;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        // Lấy dữ liệu đánh giá từ cơ sở dữ liệu
        $userRatings = [
            1 => Review::where('rating', 1)->count(),
            2 => Review::where('rating', 2)->count(),
            3 => Review::where('rating', 3)->count(),
            4 => Review::where('rating', 4)->count(),
            5 => Review::where('rating', 5)->count(),
        ];
        // Loại bỏ biến $pendingCount
        $canceledCount = Order::where('status', 'canceled')->count();
        $deliveredCount = Order::where('status', 'delivered')->count();
        $processingCount = Order::where('status', 'processing')->count();
        $shippedCount = Order::where('status', 'shipped')->count();

        $orders = Order::orderBy('created_at', 'DESC')->get()->take(10);
        $totalSales = Order::where('status', 'delivered')->count();
        $totalRevenue = Order::where('status', 'delivered')->sum('total');
        $todaySales = Order::where('status', 'delivered')
            ->whereDate('created_at', Carbon::today())->count();
        $todayRevenue = Order::where('status', 'delivered')
            ->whereDate('created_at', Carbon::today())->sum('total');
        // Lấy tổng số đơn hàng mỗi ngày trong tuần (7 ngày gần nhất)
        $ordersPerDay = [];
        for ($i = 0; $i < 7; $i++) {
            $day = Carbon::today()->subDays($i);
            $ordersPerDay[] = Order::whereDate('created_at', $day)->count();
        }
        return view('livewire.admin.admin-dashboard-component', [
            'orders' => $orders,
            'totalSales' => $totalSales,
            'totalRevenue' => $totalRevenue,
            'todaySales' => $todaySales,
            'todayRevenue' => $todayRevenue,
            'canceledCount' => $canceledCount,
            'deliveredCount' => $deliveredCount,
            'processingCount' => $processingCount,
            'shippedCount' => $shippedCount,
            'userRatings' => $userRatings,
            'ordersPerDay' => $ordersPerDay,
        ]);
    }
}
