<?php


namespace App\Livewire;

use App\Models\Shiping;
use Livewire\Component;
use Vanthao03596\HCVN\Models\District;
use Vanthao03596\HCVN\Models\Province;
use Vanthao03596\HCVN\Models\Ward;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Transaction;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Mail\OrderConfirmedMail;
use Illuminate\Support\Facades\Mail;






class CheckoutComponent extends Component

{
    public $address_type;
    public $name;

    public $phone;
    public $province;
    public $district;
    public $ward;
    public $address;

    public $delete_id;

    public $shipping_id;



    public $couponCode =  '';  // Khởi tạo là chuỗi rỗng


    public $discount;
    public $subtotalAfterDiscount;
    public $totalAfterDiscount;

    public $shippingCost;

    public $additional_info;

    public $paymentmode;

    public $thanhyou;

    public $status;
























    public function showShipingModal()
    {
        $this->dispatch('shipping-modal');
    }

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
        $this->dispatch('shipping-modal');
        flash('Đã thêm địa chỉ giao hàng thành công!');
    }


    public function resetForm()
    {
        $this->address_type = '';
        $this->name = '';
        $this->status = '';
        $this->phone;
        $this->province = '';
        $this->district = '';
        $this->ward = '';
        $this->address = '';
        $this->shipping_id = '';
        $this->status = '';
        $this->titleForm = "Thêm địa chỉ";
        $this->resetValidation();
    }
    public $editForm = false;
    public $titleForm = "Thêm địa chỉ";
    public $sid;
    public function showEditShipping($id)
    {
        $this->dispatch('shipping-modal');
        $this->titleForm = "Chỉnh sửa địa chỉ";
        $this->editForm = true;

        $shipping = Shiping::where('id', $id)->first();
        $this->address_type = $shipping->address_type;
        $this->name = $shipping->name;
        $this->phone = $shipping->phone;
        $this->address = $shipping->address;
        $this->province = $shipping->province;
        $this->district = $shipping->district;
        $this->ward = $shipping->ward;
        $this->address = $shipping->address;
        $this->shipping_id = $shipping->id;
        $this->status = $shipping->status;
        $this->sid = $shipping->id;
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
        $shipping->status = $status;
        $shipping->save();


        $this->resetForm();
        $this->dispatch('shipping-modal');
        flash('Đã cập nhật địa chỉ giao hàng thành công!');
    }



    public function calculateDiscount()
    {
        if (session()->has('coupon')) {
            if (session()->get('coupon')['coupon_type'] == 'fixed') {
                $this->discount = session()->get('coupon')['coupon_value'];
            } else {
                $this->discount = (Cart::instance('cart')->subtotal() * session()->get('coupon')['coupon_value']) / 100;
            }
            $this->subtotalAfterDiscount = Cart::instance('cart')->subtotal() - $this->discount;



            $this->totalAfterDiscount = $this->subtotalAfterDiscount;
        }
    }
    public function applyShippingCharge($province)
    {
        if ($province == 'Tỉnh Trà Vinh')
            $this->shippingCost = 20.00;
        else {
            $this->shippingCost = 40.00;
        }
    }




    public function placeOrder()
    {
        $shipping = Shiping::where('user_id', Auth::user()->id)->where('address_type', $this->address_type)->first();
        if ($shipping) {
            $order = new Order();
            $order->user_id = Auth::user()->id;
            $order->subtotal = session()->get('checkout')['subtotal'];
            $order->discount = session()->get('checkout')['discount'];
            $order->shipping_cost = $this->shippingCost;
            $order->total = session()->get('checkout')['total'] + $this->shippingCost;
            $order->name = $shipping->name;
            $order->phone = $shipping->phone;
            $order->email = Auth::user()->email;
            $order->province = $shipping->province;
            $order->district = $shipping->district;
            $order->ward = $shipping->ward;
            $order->address = $shipping->address;
            $order->additional_info = $this->additional_info;
            $order->status = 'order';
            $order->save();

            foreach (Cart::instance('cart')->content() as $item) {
                $orderitems = new OrderItem();
                $orderitems->order_id = $order->id;
                $orderitems->product_id = $item->id;
                $orderitems->price = $item->price;
                $orderitems->quantity = $item->qty;
                $orderitems->save();
            }


            $orderitems->save();
            Product::where('id', $item->id)->update(['quantity' => DB::raw('quantity - ' . $item->qty)]);


            $this->validate([
                'paymentmode' => 'required'
            ]);



            if ($this->paymentmode == 'COD') {
                $transaction = new Transaction();
                $transaction->user_id = Auth::user()->id;
                $transaction->order_id = $order->id;
                $transaction->payment_type = "cod";
                $transaction->status = "pending";
                $transaction->save();
            }


            $this->thanhyou = 1;
            Cart::instance('cart')->destroy();
            session()->forget('checkout');

            Mail::to($order->email)->send(new OrderConfirmedMail($order));
        } else {
            flash('Không tìm thấy thông tin vận chuyển');
        }
    }

    public function varifyCheckout()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        } elseif ($this->thanhyou) {
            return redirect()->route('thankyou');
        } elseif (!session()->get('checkout')) {
            return redirect()->route('cart');
        } elseif (!Cart::instance('cart')->count() > 0) {
            return redirect()->route('cart');
        }
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


        if (session()->has('coupon')) {
            if (Cart::instance('cart')->subtotal() < session()->get('coupon')['cart_value']) {
                session()->forget('coupon');
            } else {
                $this->calculateDiscount();
            }
        }
        $this->varifyCheckout();


        $districts = District::all();
        $provinces = Province::all();
        $wards = Ward::all();
        $shippings = Shiping::where('user_id', Auth::user()->id)->get();
        return view('livewire.checkout-component', [
            'districts' => $districts,
            'provinces' => $provinces,
            'wards' => $wards,
            'shippings' => $shippings
        ]);
    }
}
