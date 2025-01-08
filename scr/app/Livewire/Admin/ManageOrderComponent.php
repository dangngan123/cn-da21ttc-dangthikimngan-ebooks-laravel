<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Order;
use Livewire\WithPagination;
use App\Exports\OrdersExport;
use Maatwebsite\Excel\Facades\Excel;






class ManageOrderComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';


    public $pagesize = 5;
    //Hiển thị trang
    public function changepageSize($size)
    {
        $this->pagesize  = $size;
        $this->resetPage();
    }


    public function updateOrderStatus($id, $status)
    {
        $order = Order::find($id);
        if ($order) {
            $order->status = $status;
            $order->save();
            flash('Trạng thái đơn hàng đã được cập nhật thành công');
        } else {
            flash('error', 'Order not found.');
        }
    }















    //Checkbox
    public $selectAll;
    public $selectedItems = [];


    public function updatedSelectAll($value)
    {
        // Nếu chọn tất cả, thêm toàn bộ ID slider vào mảng
        if ($value) {
            $this->selectedItems = Order::pluck('id')->toArray();
        } else {
            // Nếu bỏ chọn, xóa sạch mảng
            $this->selectedItems = [];
        }
    }

    public function updatedSelectedItems()
    {
        // Kiểm tra nếu số lượng selected items bằng tổng số slider
        if (count($this->selectedItems) === count(Order::pluck('id'))) {
            $this->selectAll = True;
        } else {
            $this->selectAll = False;
        }
    }
    //Xóa nhiều slider
    public function selecteDelete()
    {
        foreach ($this->selectedItems as $item) {
            $order = Order::find($item);
            $image_path = public_path('admin/slider/' . $order->image);
            if (file_exists($image_path)) {
                unlink($image_path);
            }
            $order->delete();
        }
        $this->selectAll = False;
        $this->selectedItems = [];
        flash('Slider đã được bị xóa.');
    }
    //Chọn màu cho slider
    public function isColor($sliderId)
    {
        if ($this->selectAll == false) {
            if (in_array($sliderId, $this->selectedItems)) {
                return 'bg-1';
            } else {
                return '';
            }
        } else {
            return 'bg-1';
        }
    }

    //Xuất excel
    public function export()
    {
        // return Excel::download(new SlidersExport, 'sliders.xlsx');
        return (new OrdersExport($this->selectedItems))->download('orders.xlsx');
    }



    //modal
    public function productDetailModal()
    {
        $this->dispatch('product-detail-modal');
    }




















    //Search
    public $search;
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public $statusFilter = '';

    public $page = 1; // Thêm thuộc tính này


    public function render()
    {
        $query = Order::query();

        // Áp dụng bộ lọc trạng thái nếu có
        if ($this->statusFilter == 'processing') {
            $query->where('status', 'processing');
        } elseif ($this->statusFilter == 'shipped') {
            $query->where('status', 'shipped');
        } elseif ($this->statusFilter == 'delivered') {
            $query->where('status', 'delivered');
        } elseif ($this->statusFilter == 'cancelled') {
            $query->where('status', 'cancelled');
        }

    

        $orders = Order::where(function ($query) {
            $query->where('id', 'like', '%' . $this->search . '%')
                ->orWhere('name', 'like', '%' . $this->search . '%')
                ->orWhere('email', 'like', '%' . $this->search . '%')
                ->orWhere('phone', 'like', '%' . $this->search . '%')
                ->orWhere('status', 'like', '%' . $this->search . '%');
        })
            ->orderByRaw("FIELD(status, 'canceled', 'delivered') ASC")
            ->orderBy('created_at', 'desc')
            ->paginate($this->pagesize);

        $this->resetPage();


        return view('livewire.admin.manage-order-component', ['orders' => $orders]);
    }
}
