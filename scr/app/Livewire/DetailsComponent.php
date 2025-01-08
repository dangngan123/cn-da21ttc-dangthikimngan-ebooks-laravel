<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use App\Models\Review;
use App\Models\OrderItem;
use App\Models\Coupon;

class DetailsComponent extends Component
{

    public $slug;
    public $qty;
    public $publisher;
    public $author;
    public $age;
    public $quantity;
    public $name;
    public $reguler_price;
    public $sale_price;
    public $order_item_id;


    public function mount($slug)
    {
        $this->slug = $slug;
        $this->qty = 1;
    }
    public function mount1($order_item_id)
    {
        $this->order_item_id = $order_item_id;
    }
    public function Store($product_id, $product_name, $product_price)
    {
        Cart::instance('cart')->add($product_id, $product_name, $this->qty, $product_price)->associate('App\Models\Product');
        //return redirect()->route('cart');
        $this->dispatch('refreshComponent')->to('carticon-component');
        flash('Mặt hàng đã được thêm vào  giỏ hàng.');
    }



    public function removefromWishlist($productId)
    {
        foreach (Cart::instance('wishlist')->content() as $witem) {
            if ($witem->id == $productId) {
                Cart::instance('wishlist')->remove($witem->rowId);
                $this->dispatch('refreshComponent')->to('wishlist-icon-component');
                flash('Mục danh sách mong muốn đã bị xóa.');
            }
        }
    }

    public function addtoWishlist($product_id, $product_name, $product_price)
    {

        Cart::instance('wishlist')->add($product_id, $product_name, 1, $product_price)->associate('App\Models\Product');
        $this->dispatch('refreshComponent')->to('wishlist-icon-component');
        flash('Mục danh sách mong muốn đã được thêm vào.');
    }

    public function QtyIncrease($quantity)
    {

        if ($quantity > $this->qty) {
            $this->qty++;
        } else {
            flash('Số lượng không đủ trong kho.');
        }
    }
    public function QtyDecrease()
    {
        if ($this->qty > 1) {
            $this->qty--;
        }
    }

    public function ProductQuickView($id)
    {
        $this->dispatch('product-quick-view');
        $product = Product::where('id', $id)->first();
        $this->name = $product->name;
        $this->reguler_price = $product->reguler_price;
        $this->sale_price = $product->sale_price;
    }

    public $selectedCoupon = null;
    public $showAllCoupons = false;

    // Phương thức để hiển thị chi tiết mã giảm giá
    public function showCouponDetails($couponId)
    {
        $this->selectedCoupon = Coupon::find($couponId);
    }
    public function closeCouponDetails()
    {
        $this->selectedCoupon = null;
        logger('Selected coupon has been set to null'); // Kiểm tra log trong storage/logs/laravel.log
    }
    public function toggleShowAll()
    {
        $this->showAllCoupons = !$this->showAllCoupons;
    }
















    public function render()
    {
        $product = Product::where("slug", $this->slug)->first();

        $image = $product->image;
        $images = json_decode($product->images) ?? [];
        array_splice($images, 0, 0, $image);

        $rproduct = Product::where("category_id", $product->category_id)->get();
        $nproducts = Product::latest()->take(3)->get();
        $categories = Category::get();

        // Giới hạn số lượng mã hiển thị khi không nhấn "Xem thêm"
        $coupons = $this->showAllCoupons ? Coupon::all() : Coupon::take(5)->get();
        $qproducts = Product::inRandomOrder()->take(4)->get();

        // Lấy đơn hàng đầu tiên có product_id tương ứng
        $orderItems = OrderItem::where('product_id', $product->id)->first();

        // Lấy danh sách đánh giá cho order_item_id, và chỉ lấy những đánh giá có trạng thái 'approved'
        // Lấy các đánh giá dựa trên order_item_id liên kết với sản phẩm
        $reviews = Review::whereHas('orderItem', function ($query) use ($product) {
            $query->where('product_id', $product->id);
        })->get();

        return view('livewire.details-component', [
            'product' => $product,
            'rproducts' => $rproduct,
            'nproducts' => $nproducts,
            'categories' => $categories,
            'images' => $images,
            'qproducts' => $qproducts,
            'reviews' => $reviews,
            'ordersItems' => $orderItems,
            'coupons' => $coupons
        ]);
    }
}
