<?php

namespace App\Livewire;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Models\Coupon;
use Carbon\Carbon;

class CartComponent extends Component
{



    public $couponCode =  '';  // Khởi tạo là chuỗi rỗng


    public $discount;
    public $subtotalAfterDiscount;
    public $totalAfterDiscount;



    protected $listeners = ['refreshComponent' => '$refresh'];
    public function increaseQuantity($id)
    {
        $product = Cart::instance('cart')->get($id);


        $myproduct = Product::where('id', $product->id)->first();



        if ($myproduct->quantity > $product->qty) {
            $qty = $product->qty + 1;
            Cart::instance('cart')->update($id, $qty);
        } else {
            flash()->error('Số lượng không đủ trong kho.');
        }
        $this->dispatch('refreshComponent')->to('carticon-component');
    }

    public function decreaseQuantity($id)
    {
        try {
            $product = Cart::instance('cart')->get($id);
            $qty = $product->qty - 1;
            Cart::instance('cart')->update($id, $qty);
            $this->dispatch('refreshComponent')->to('carticon-component');
        } catch (\Exception $e) {
        }
    }


    public function destroy($id)
    {
        Cart::instance('cart')->remove($id);
        flash('Mặt hàng trong giỏ hàng đã bị xóa.');


        $this->dispatch('refreshComponent')->to('carticon-component');
    }
    public function ClearCart()
    {
        Cart::instance('cart')->destroy();
        flash('Tất cả giỏ hàng đã bị xóa.');
        $this->dispatch('refreshComponent')->to('carticon-component');
    }

    public function checkout()
    {
        // Kiểm tra nếu người dùng đã đăng nhập
        if (Auth::check()) {
            // Kiểm tra số lượng sản phẩm trong giỏ hàng trước khi thanh toán
            foreach (Cart::instance('cart')->content() as $item) {
                $product = Product::find($item->id);  // Lấy sản phẩm từ DB
                if ($product && $product->quantity < $item->qty) {
                    // Nếu số lượng trong giỏ hàng vượt quá số lượng trong kho
                    session()->flash('error_message', "Sản phẩm '{$product->name}' không đủ số lượng trong kho hiện số lượng trong chỉ có '{$product->quantity}' sản phẩm.");
                    return redirect()->route('cart');  // Quay lại trang giỏ hàng để sửa lại
                }
            }

            // Nếu không có lỗi, tiếp tục thanh toán
            return redirect()->route('checkout');
        } else {
            // Nếu chưa đăng nhập, điều hướng đến trang đăng nhập
            return redirect()->route('login');
        }
    }


    public function applyCouponCode()
    {
        // Kiểm tra xem mã giảm giá đã được áp dụng trong session chưa
        if (session()->has('coupon')) {
            session()->flash('error_message', 'Mã giảm giá đã được áp dụng cho đơn hàng này.');
            return;
        }

        // Kiểm tra xem mã giảm giá có hợp lệ không
        $coupon = Coupon::where('coupon_code', $this->couponCode)
            ->where('end_date', '>=', Carbon::today())
            ->where('cart_value', '<=', Cart::instance('cart')->subtotal())
            ->first();

        if (!$coupon) {
            session()->flash('error_message', 'Mã giảm giá không hợp lệ hoặc đã hết hạn.');
            return;
        }

        // Lưu thông tin mã giảm giá vào session
        session()->put('coupon', [
            'coupon_code' => $coupon->coupon_code,
            'coupon_type' => $coupon->coupon_type,
            'coupon_value' => $coupon->coupon_value,
            'cart_value' => $coupon->cart_value,
            'end_date' => $coupon->end_date,
        ]);

        // Tính toán giảm giá sau khi áp dụng mã giảm giá
        $this->calculateDiscount();

        // Thông báo mã giảm giá đã được áp dụng thành công
        session()->flash('success_message', 'Mã giảm giá đã được áp dụng.');
    }


    public function calculateDiscount()
    {
        if (session()->has('coupon')) {
            $coupon = session()->get('coupon');

            if ($coupon['coupon_type'] == 'fixed') {
                $this->discount = $coupon['coupon_value'];
            } elseif ($coupon['coupon_type'] == 'percent') {
                $this->discount = (Cart::instance('cart')->subtotal() * $coupon['coupon_value']) / 100;
            }

            // Đảm bảo không trừ giảm giá vượt quá giá trị giỏ hàng
            $this->discount = min($this->discount, Cart::instance('cart')->subtotal());
            $this->subtotalAfterDiscount = Cart::instance('cart')->subtotal() - $this->discount;
            $this->totalAfterDiscount = $this->subtotalAfterDiscount;
        }
    }

    public function setAmountForCheckout()
    {
        if (session()->has('coupon')) {
            session()->put('checkout', [
                'discount' => $this->discount,
                'subtotal' => $this->subtotalAfterDiscount,
                'total' => $this->totalAfterDiscount,
            ]);
        } else {
            session()->put('checkout', [
                'discount' => 0,
                'subtotal' => Cart::instance('cart')->subtotal(),
                'total' => Cart::instance('cart')->total(),
            ]);
        }
    }



    public function Store($product_id, $product_name, $product_price)
    {
        // Kiểm tra mã giảm giá trước khi thêm sản phẩm
        if (!session()->has('coupon')) {
            session()->flash('error_message', 'Vui lòng áp dụng mã giảm giá trước khi thêm sản phẩm.');
            return;
        }

        // Thêm sản phẩm vào giỏ hàng
        Cart::instance('cart')->add($product_id, $product_name, 1, $product_price)->associate('App\Models\Product');
        $this->dispatch('refreshComponent')->to('carticon-component');
        flash('Mặt hàng đã được thêm vào giỏ hàng.');
    }




    public function render()
    {
        if (Auth::check()) {
            Cart::instance('cart')->store(Auth::user()->email);
            Cart::instance('wishlist')->store(Auth::user()->email);
        }



        // Kiểm tra mã giảm giá hiện tại trong session
        if (session()->has('coupon')) {
            if (Cart::instance('cart')->subtotal() < session()->get('coupon')['cart_value']) {
                session()->forget('coupon'); // Xóa mã giảm giá nếu không hợp lệ
                session()->flash('error_message', 'Giỏ hàng không đủ điều kiện cho mã giảm giá.');
            } else {
                $this->calculateDiscount(); // Tính lại giảm giá
            }
        }

        // Chuẩn bị dữ liệu cho phiên thanh toán
        $this->setAmountForCheckout();

        // Lấy danh sách sản phẩm ngẫu nhiên
        $products = Product::inRandomOrder()->take(12)->get();

        return view('livewire.cart-component', [
            'products' => $products,
        ]);
    }
}
