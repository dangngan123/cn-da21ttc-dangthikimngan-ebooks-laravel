<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Coupon;
use Livewire\WithPagination;
use App\Models\Order; // Thêm model Order để kiểm tra việc sử dụng coupon

class ManageCouponsComponent extends Component
{
    use WithPagination;

    public $pagesize = 5;
    protected $paginationTheme = 'bootstrap';
    public $coupon;
    public $coupon_code;
    public $coupon_type;
    public $coupon_value;
    public $cart_value;
    public $end_date;
    public $delete_id;
    //Hiển thị trang
    public function changepageSize($size)
    {
        $this->pagesize  = $size;
        $this->resetPage();
    }

    private function isCouponUsed($couponId)
    {
        // Kiểm tra xem coupon có trong bất kỳ đơn hàng nào không
        $coupon = Coupon::find($couponId);
        if (!$coupon) return false;

        // Kiểm tra trực tiếp xem mã giảm giá này đã được sử dụng trong đơn hàng nào chưa
        return Order::where('coupon_id', $coupon->coupon_code)->exists();
    }


    // Xác nhận xóa
    protected $listeners = [
        'deleteConfirmed' => 'delete',
        'refreshComponent' => '$refresh'
    ];
    public function deleteConfirmation($id)
    {
        $this->delete_id = $id;
        // Phát sự kiện để hiển thị hộp thoại xác nhận xóa trong JavaScript
        $this->dispatch('show-delete-confirmation');
    }



    function delete()
    {
        try {
            $coupon = Coupon::find($this->delete_id);

            if ($coupon) {
                $coupon->delete();
                flash()->addSuccess('Mã giảm giá đã được xóa thành công.');
            } else {
              
            }
        } catch (\Exception $e) {
            flash()->addError('Có lỗi xảy ra khi xóa mã giảm giá');
        }
    }

    //Thêm slider
    public function showCouponModal()
    {
        $this->dispatch('coupon-modal');
    }

    public function updated($filed)
    {
        $this->validateOnly($filed, [
            'coupon_code' => 'required',
            'coupon_type' => 'required',
            'coupon_value' => 'required',
            'cart_value' => 'required',
            'end_date' => 'required',
        ]);
    }

    public function addCoupon()
    {
        $this->validate([
            'coupon_code' => 'required',
            'coupon_type' => 'required',
            'coupon_value' => 'required',
            'cart_value' => 'required',
            'end_date' => 'required',
        ]);
        $coupon = new Coupon();
        $coupon->coupon_code = $this->coupon_code;
        $coupon->coupon_type = $this->coupon_type;
        $coupon->coupon_value = $this->coupon_value;
        $coupon->cart_value = $this->cart_value;
        $coupon->end_date = $this->end_date;
        $coupon->save();
        $this->dispatch('coupon-modal');
        $this->resetForm();
        flash('Mã giảm giá đã được thêm thành công.');
    }
    //Reset form
    public function resetForm()
    {
        $this->coupon_code = '';
        $this->coupon_type = '';
        $this->coupon_value = '';
        $this->cart_value = '';
        $this->end_date = '';
        $this->editForm = false;
        $this->titleForm = "Thêm mã giảm giá";
        $this->resetValidation();
    }


    //Chỉnh sửa slider
    public $editForm = false;
    public $titleForm = "Thêm mã giảm giá";
    public $sid;
    public function showEditCoupon($id)
    {
        // Kiểm tra nếu mã giảm giá đã được sử dụng
        if ($this->isCouponUsed($id)) {
            flash('Không thể chỉnh sửa mã giảm giá này vì đã được sử dụng trong đơn hàng.')->error();
            return;
        }

        $this->dispatch('coupon-modal');
        $this->titleForm = "Chỉnh sửa mã giảm giá";
        $this->editForm = true;

        $coupon = Coupon::find($id);
        if ($coupon) {
            $this->coupon_code = $coupon->coupon_code;
            $this->coupon_type = $coupon->coupon_type;
            $this->coupon_value = $coupon->coupon_value;
            $this->cart_value = $coupon->cart_value;
            $this->end_date = $coupon->end_date;
            $this->sid = $coupon->id;
        }
    }


    public function updateCoupon()
    {

        $this->validate([
            'coupon_code' => 'required',
            'coupon_type' => 'required',
            'coupon_value' => 'required',
            'cart_value' => 'required',
            'end_date' => 'required',
        ]);
        $coupon = Coupon::find($this->sid);
        $coupon->coupon_code = $this->coupon_code;
        $coupon->coupon_type = $this->coupon_type;
        $coupon->coupon_value = $this->coupon_value;
        $coupon->cart_value = $this->cart_value;
        $coupon->end_date = $this->end_date;
        $coupon->save();
        $this->dispatch('coupon-modal');
        $this->resetForm();

        flash('Mã giảm giá được cập nhật thành công.');
    }









    public function render()
    {
        $coupons = Coupon::paginate($this->pagesize);
        // Thêm thông tin về việc sử dụng cho mỗi coupon
        $coupons->getCollection()->transform(function ($coupon) {
            $coupon->is_used = $this->isCouponUsed($coupon->id);
            return $coupon;
        });
        return view('livewire.admin.manage-coupons-component', ['coupons' => $coupons]);
    }
}
