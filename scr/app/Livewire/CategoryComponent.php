<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\Product;
use Livewire\WithPagination;

class CategoryComponent extends Component
{
    use WithPagination;



    public $slug;
    public $selectedAges = [];
    public $pagesize = 12;



    public $orderBy = 'featured';

    protected $paginationTheme = 'bootstrap';


    public function mount($slug)
    {
        $this->slug = $slug;
    }


    public function changepageSize($size)
    {
        $this->pagesize = $size;
    }

    public $min_price = 0;
    public $max_price = 700;

    public function changeOrderBy($order)

    {
        $this->orderBy = $order;
    }



    public function render()
    {

        $categories = Category::get();
        $category = Category::where('slug', $this->slug)->first();




        $cateroryName = $category->name;


        $query = Product::query();

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

        return view('livewire.category-component', [
            'categories' => $categories,
            'products' => $products,
            'nproducts' => $nproducts,
            'cateroryName' => $cateroryName
        ]);
    }
}
