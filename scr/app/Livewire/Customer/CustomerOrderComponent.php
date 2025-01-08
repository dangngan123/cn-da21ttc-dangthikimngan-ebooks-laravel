<?php

namespace App\Livewire\Customer;

use Livewire\Component;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Review;

class CustomerOrderComponent extends Component
{
    public function cancelOrder($orderId)
    {
        $order = Order::find($orderId);

        if ($order && $order->status === 'order') {
            $order->status = 'canceled'; // Cập nhật trạng thái thành 'canceled'
            $order->save();

            session()->flash('message', 'Đơn hàng đã được hủy thành công.');
        } else {
            session()->flash('error', 'Không thể hủy đơn hàng này.');
        }
    }

    public function render()
    {

        $orderItems = OrderItem::get();

        $products = Product::all();
        $orders = Order::all();
        $reviews = Review::all();

        return view('livewire.customer.customer-order-component', ['orders' => $orders], ['orderItems' => $orderItems], ['products' => $products], ['reviews' => $reviews]);
    }
}
