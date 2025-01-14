<?php

namespace App\Livewire;

use App\Models\Slider;
use Livewire\Component;
use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\DB;
use App\Models\Saletimer;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;


class HomeComponent extends Component
{
    public $count = 24;

    public function Store($product_id, $product_name, $product_price)
    {
        Cart::instance('cart')->add($product_id, $product_name, 1, $product_price)->associate('App\Models\Product');
        //return redirect()->route('cart');
        $this->dispatch('refreshComponent')->to('carticon-component');
        flash('Mặt hàng đã được thêm vào  giỏ hàng.');
    }



    public function loadMore()
    {
        $this->count += 12;
    }


    public function showAdminAlert()
    {
        // Lưu thông báo vào session
        flash()->error('Lỗi: Admin không thể thêm sản phẩm vào giỏ hàng!');
    }
    public function render()
    {
        $best_sellers = DB::table('products')
            ->leftJoin('order_items', 'products.id', '=', 'order_items.product_id')
            ->selectRaw('products.id,SUM(order_items.quantity) as total')
            ->groupBy('products.id')
            ->orderBy('total', 'DESC')
            ->take(8)
            ->get();
        foreach ($best_sellers as $best_seller) {
            $product = Product::findOrFail($best_seller->id);
            $bestproducts[] = $product;
        }

        $sliders = Slider::whereDate('start_date', '<=', Carbon::now('Asia/Ho_Chi_Minh')->toDateString())
            ->whereDate('end_date', '>=', Carbon::now('Asia/Ho_Chi_Minh')->toDateString())
            ->where('status', 1)
            ->where('type', 'slider')
            ->get();




        $categories = Category::where('status', 1)->get();
        $products = Product::limit($this->count)->get();
        $pcategories = Category::latest()->limit(8)->get();
        $nproducts = Product::latest()->limit(8)->get();

        $saletimerproducts = Product::whereBetween('sale_price', [50, 100])->limit(12)->get();
        $saletimer = Saletimer::find(1);



        // if (Auth::check()) {
        //     Cart::instance('cart')->restore(Auth::user()->email);
        //     Cart::instance('wishlist')->restore(Auth::user()->email);
        // }
        $productReviews = Review::whereIn('order_item_id', function ($query) use ($product) {
            $query->select('id')
                ->from('order_items')
                ->where('product_id', $product->id);
        })->get();


        return view('livewire.home-component', [
            'sliders' => $sliders,
            'categories' => $categories,
            'products' => $products,
            'pcategories' => $pcategories,
            'nproducts' => $nproducts,
            'bestproducts' => $bestproducts,
            'saletimerproducts' => $saletimerproducts,
            'saletimer' => $saletimer,
            'productReviews' => $productReviews,

        ]);
    }
}
