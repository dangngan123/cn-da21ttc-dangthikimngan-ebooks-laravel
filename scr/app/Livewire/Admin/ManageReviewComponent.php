<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Order;
use App\Models\Review;
use Livewire\WithPagination;

class ManageReviewComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $pagesize = 5;
    public function changepageSize($size)
    {
        $this->pagesize  = $size;
        $this->resetPage();
    }
    public function updateOrderStatus($id, $status)
    {
        $review = Review::find($id);
        if ($review) {
            $review->status = $status;
            $review->save();
            flash('Trạng thái đánh giá của khách hàng đã được cập nhật thành công');
        } else {
            flash('error', 'Order not found.');
        }
    }
    //Checkbox
    public $selectAll;
    public $selectedItems = [];

    public function updatedSelectAll($value)
    {
        // Nếu chọn tất cả, thêm toàn bộ ID review vào mảng
        if ($value) {
            $this->selectedItems = Review::pluck('id')->toArray();
        } else {
            // Nếu bỏ chọn, xóa sạch mảng
            $this->selectedItems = [];
        }
    }

    public function updatedSelectedItems()
    {
        // Kiểm tra nếu số lượng selected items bằng tổng số review
        if (count($this->selectedItems) === count(Review::pluck('id'))) {
            $this->selectAll = True;
        } else {
            $this->selectAll = False;
        }
    }
    //Xóa nhiều review
    public function selecteDelete()
    {
        foreach ($this->selectedItems as $item) {
            $review = Review::find($item);
            $image_path = public_path('admin/review/' . $review->image);
            if (file_exists($image_path)) {
                unlink($image_path);
            }
            $review->delete();
        }
        $this->selectAll = False;
        $this->selectedItems = [];
        flash('đánh giá đã được bị xóa.');
    }
    //hoạt động nhiều review
    public function selecteActive()
    {
        foreach ($this->selectedItems as $item) {
            $review = Review::find($item);
            $review->status = 'approved';
            $review->save();
            $this->selectedItems = [];
            $this->selectAll = false;
        }
        flash('Đánh giá đã được xác nhận.');
    }
    //tắt nhiều review
    public function selecteInactive()
    {
        foreach ($this->selectedItems as $item) {
            $review = Review::find($item);
            $review->status = 'rejected';
            $review->save();
            $this->selectedItems = [];
            $this->selectAll = false;
        }
        flash('Đánh giá đã bị hủy.');
    }



    //Chọn màu cho review
    public function isColor($reviewId)
    {
        if ($this->selectAll == false) {
            if (in_array($reviewId, $this->selectedItems)) {
                return 'bg-1';
            } else {
                return '';
            }
        } else {
            return 'bg-1';
        }
    }

    public function render()
    {

        $reviews = Review::with('product')->paginate(10);
        $this->resetPage();
        return view('livewire.admin.manage-review-component', ['reviews' => $reviews]);
    }
}
