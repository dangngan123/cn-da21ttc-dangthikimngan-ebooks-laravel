<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\Product;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Log;

class ShopComponent extends Component
{
    use WithPagination;


    public $pagesize = 12;

    public $selectedAges = [];

    public $orderBy = 'Mặc định';

    protected $paginationTheme = 'bootstrap';
    public function changepageSize($size)
    {
        $this->pagesize = $size;
    }

    public $min_price = 0;
    public $max_price = 700;

    public $priceRange = [];

    public function changeOrderBy($order)

    {
        $this->orderBy = $order;
    }
    public function mount()
    {
        $this->priceRange = [];
    }
    public function updatedPriceRange()
    {
        Log::info('Price Range Updated:', $this->priceRange);
    }


    public function render()
    {
        $categories = Category::get();

        $query = Product::query();

        // Debug để kiểm tra giá trị của priceRange



        if (!empty($this->priceRange)) {
            $query->where(function ($q) {
                foreach ($this->priceRange as $range) {
                    list($minPrice, $maxPrice) = explode('-', $range);

                    // Chuyển đổi sang số nguyên thay vì float
                    $minPrice = (int)$minPrice;
                    $maxPrice = (int)$maxPrice;

                    $q->orWhere(function ($query) use ($minPrice, $maxPrice) {
                        $query->where('sale_price', '>=', $minPrice)
                            ->where('sale_price', '<=', $maxPrice);
                    });
                }
            });
        }


        // Kiểm tra nếu có giá trị độ tuổi được chọn
        if (!empty($this->selectedAges)) {
            $query->where(function ($q) {
                foreach ($this->selectedAges as $ageRange) {
                    // Phân tách khoảng tuổi từ giá trị checkbox
                    list($minAge, $maxAge) = explode('-', $ageRange);

                    // Áp dụng điều kiện whereBetween cho từng khoảng tuổi
                    $q->orWhereBetween('age', [$minAge, $maxAge]);
                }
            });
        }



        if ($this->orderBy == 'Giá thấp') {
            $query->whereBetween('sale_price', [$this->min_price, $this->max_price])
                ->orderBy('sale_price', 'ASC');
        } elseif ($this->orderBy == 'Giá cao') {
            $query->whereBetween('sale_price', [$this->min_price, $this->max_price])
                ->orderBy('sale_price', 'DESC');
        } elseif ($this->orderBy == 'Sản phẩm mới') {
            $query->whereBetween('sale_price', [$this->min_price, $this->max_price])
                ->orderBy('created_at', 'DESC');
        } else {
            $query->whereBetween('sale_price', [$this->min_price, $this->max_price]);
        }

        $products = $query->paginate($this->pagesize);

        $nproducts = Product::latest()->take(3)->get();

        return view('livewire.shop-component', [
            'categories' => $categories,
            'products' => $products,
            'nproducts' => $nproducts
        ]);
    }
}
