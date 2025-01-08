<?php

namespace App\Livewire\Customer;

use Livewire\Component;
use Vanthao03596\HCVN\Models\District;
use Vanthao03596\HCVN\Models\Province;
use Vanthao03596\HCVN\Models\Ward;
use App\Models\Shiping;
use Illuminate\Support\Facades\Auth;

class CustomerAddressComponent extends Component
{
    public $province;
    public $district;
    public $ward;
    public $shippingCost;
    public $address;
    public $address_type;
    public $name;
    public $phone;
    public $shipping_id;
    public $province_id;
    public $district_id;
    public $ward_id;
    public $delete_id;
    public $shipping;
    public $status;

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'address_type' => 'required',
            'name' => 'required|string|max:20',
            'phone' => 'required|string|min:10|max:10', // đảm bảo phone là chuỗi
            'province' => 'required',
            'district' => 'required',
            'ward' => 'required',
            'address' => 'required',
            'status' => 'required',
        ]);
    }

    public function addShipping()
    {
        $this->validate([
            'address_type' => 'required',
            'name' => 'required|string|max:20',
            'phone' => 'required|string|min:10|max:10',
            'province' => 'required',
            'district' => 'required',
            'ward' => 'required',
            'address' => 'required',
        ]);

        // Đảm bảo 'status' luôn được thiết lập (mặc định là 0 nếu không có giá trị)
        $status = $this->status ?? 0; // Mặc định là 0 nếu không có giá trị

        $shipping = new Shiping();
        $shipping->user_id = Auth::id();
        $shipping->address_type = $this->address_type;
        $shipping->name = $this->name;
        $shipping->phone = $this->phone;
        $shipping->province = $this->province;
        $shipping->district = $this->district;
        $shipping->ward = $this->ward;
        $shipping->address = $this->address;
        $shipping->status = $status;  // Sử dụng giá trị của $status
        $shipping->save();

        $this->reset();
        $this->dispatch('hide-shipping-modal');
        flash('Đã thêm địa chỉ giao hàng thành công!');
    }


    // Lắng nghe sự kiện từ JavaScript (sự kiện 'deleteConfirmed')
    protected $listeners = [
        'deleteConfirmed' => 'deleteShipping',
        'refreshComponent' => '$refresh'
    ];
    public function deleteConfirmation($id)
    {
        $this->delete_id = $id;
        // Phát sự kiện để hiển thị hộp thoại xác nhận xóa trong JavaScript
        $this->dispatch('show-delete-confirmation');
    }

    // Xử lý xóa khi được xác nhận
    public function deleteShipping()
    {
        $shipping = Shiping::find($this->delete_id);

        if ($shipping) {
            $shipping->delete();
            $this->dispatch('ShippingDeleted');
        } else {
            // Nếu không tìm thấy shipping
            $this->dispatch('DeleteFailed');
        }
    }

    public function showShipingModal()
    {
        $this->dispatch('add-show-shipping-modal');
    }

    public function ShowUpdateShippingInfo($id)
    {
        $this->dispatch('show-update-shipping-modal');
        $this->updateShipInfo($id);
    }

    public function updateShipInfo($id)
    {
        $shipping = Shiping::where('id', $id)->first();
        $this->address_type = $shipping->address_type;
        $this->name = $shipping->name;
        $this->phone = $shipping->phone;
        $this->address = $shipping->address;
        $this->province = $shipping->province;
        $this->district = $shipping->district;
        $this->ward = $shipping->ward;
        $this->address = $shipping->address;
        $shipping->status = $this->status;
        $this->shipping_id = $shipping->id;
    }

    public function updateShipping()
    {
        $this->validate([
            'address_type' => 'required',
            'name' => 'required|string|max:20',
            'phone' => 'required|string|min:10|max:10',
            'province' => 'required',
            'district' => 'required',
            'ward' => 'required',
            'address' => 'required',
        ]);

        // Đảm bảo 'status' luôn được thiết lập (mặc định là 0 nếu không có giá trị)
        $status = $this->status ?? 0; // Mặc định là 0 nếu không có giá trị

        $shipping = Shiping::find($this->shipping_id);
        $shipping->user_id = Auth::id();
        $shipping->address_type = $this->address_type;
        $shipping->name = $this->name;
        $shipping->phone = $this->phone;
        $shipping->province = $this->province;
        $shipping->district = $this->district;
        $shipping->ward = $this->ward;
        $shipping->address = $this->address;
        $shipping->status = $status; // Sử dụng giá trị của $status
        $shipping->save();

        $this->reset();
        $this->dispatch('update-hide-shipping-modal');
        flash('Đã cập nhật địa chỉ giao hàng thành công!');
    }



    public function updateStatus($checked)
    {
        // Kiểm tra nếu địa chỉ này được chọn làm mặc định (checked = true)
        if ($checked) {
            // Đặt tất cả các địa chỉ khác của người dùng thành không mặc định
            Shiping::where('user_id', Auth::user()->id)
                ->update(['status' => 0]);

            // Đặt status của địa chỉ hiện tại thành mặc định (status = 1)
            $this->status = 1;
        } else {
            // Nếu không được chọn làm mặc định, set status = 0
            $this->status = 0;
        }

        // Cập nhật địa chỉ với status mới
        Shiping::where('id', $this->shipping_id)
            ->update(['status' => $this->status]);
    }








    public function render()
    {


        $districts = District::all();
        $provinces = Province::all();
        $wards = Ward::all();
        $shippings = Shiping::where('user_id', Auth::user()->id)->get();
        return view('livewire.customer.customer-address-component', [
            'districts' => $districts,
            'provinces' => $provinces,
            'wards' => $wards,
            'shippings' => $shippings,
        ]);
    }
}
