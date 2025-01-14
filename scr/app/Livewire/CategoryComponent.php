<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\Product;
use Livewire\WithPagination;
use App\Models\Review;
use Illuminate\Support\Facades\Log;

class CategoryComponent extends Component
{
    use WithPagination;



    public $slug;
    public $selectedAges = [];
    public $pagesize = 12;



    public $orderBy = 'Mặc định';

    protected $paginationTheme = 'bootstrap';


    public function mount($slug)
    {
        $this->slug = $slug;
        $this->priceRange = [];
    }


    public function changepageSize($size)
    {
        $this->pagesize = $size;
    }
    public function changeOrderBy($order)

    {
        $this->orderBy = $order;
    }

    public $min_price = 0;
    public $max_price = 700;

    public $priceRange = [];


    public function updatedPriceRange()
    {
        Log::info('Price Range Updated:', $this->priceRange);
    }



    public function render()
    {

        $categories = Category::get();
        $category = Category::where('slug', $this->slug)->first();

        // Chỉ tạo query 1 lần
        $query = Product::where('category_id', $category->id)
            ->whereBetween('sale_price', [$this->min_price, $this->max_price]);
        // Debug để kiểm tra giá trị của priceRange



        // Thêm điều kiện lọc theo giá
        if (!empty($this->priceRange)) {
            $query->where(function ($q) {
                foreach ($this->priceRange as $range) {
                    list($minPrice, $maxPrice) = explode('-', $range);
                    $q->orWhere(function ($query) use ($minPrice, $maxPrice) {
                        $query->where('sale_price', '>=', $minPrice)
                            ->where('sale_price', '<=', $maxPrice);
                    });
                }
            });
        }

        // Thêm điều kiện lọc theo tuổi 
        if (!empty($this->selectedAges)) {
            $query->where(function ($q) {
                foreach ($this->selectedAges as $ageRange) {
                    list($minAge, $maxAge) = explode('-', $ageRange);
                    $q->orWhereBetween('age', [$minAge, $maxAge]);
                }
            });
        }



        $cateroryName = $category->name;




        if ($this->orderBy == 'Giá thấp') {
            $query->where('category_id', $category->id)->whereBetween('sale_price', [$this->min_price, $this->max_price])
                ->orderBy('sale_price', 'ASC');
        } elseif ($this->orderBy == 'Giá cao') {
            $query->where('category_id', $category->id)->whereBetween('sale_price', [$this->min_price, $this->max_price])
                ->orderBy('sale_price', 'DESC');
        } elseif ($this->orderBy == 'Sản phẩm mới') {
            $query->where('category_id', $category->id)->whereBetween('sale_price', [$this->min_price, $this->max_price])
                ->orderBy('created_at', 'DESC');
        } else {
            $query->where('category_id', $category->id)->whereBetween('sale_price', [$this->min_price, $this->max_price]);
        }



        $products = $query->paginate($this->pagesize);

        $nproducts = Product::latest()->take(3)->get();
        $reviews = Review::all();
        return view('livewire.category-component', [
            'categories' => $categories,
            'products' => $products,
            'nproducts' => $nproducts,
            'cateroryName' => $cateroryName,
            'reviews' => $reviews
        ]);
    }
}
