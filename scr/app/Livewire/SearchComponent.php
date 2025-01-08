<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\Product;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Log;

class SearchComponent extends Component
{
    use WithPagination;

    public $pagesize = 12;
    public $orderBy = 'Mặc định';
    public $priceRange = [];
    public $min_price = 0;
    public $max_price = 700;
    public $search;
    public $search_term;

    protected $paginationTheme = 'bootstrap';

    public function mount()
    {
        $this->fill(request()->only('search'));

        // Redirect to home if search term is empty
        if (empty($this->search)) {
            return redirect()->route('home');
        }

        $this->search_term = '%' . $this->search . '%';
    }

    public function changepageSize($size)
    {
        $this->pagesize = $size;
    }

    public function changeOrderBy($order)
    {
        $this->orderBy = $order;
    }

    public function updatedPriceRange()
    {
        Log::info('Price Range Updated:', $this->priceRange);
    }

    public function render()
    {
        $categories = Category::get();

        $query = Product::query();

        // Apply price range filters
        if (!empty($this->priceRange)) {
            $query->where(function ($q) {
                foreach ($this->priceRange as $range) {
                    list($minPrice, $maxPrice) = explode('-', $range);
                    $minPrice = (int)$minPrice;
                    $maxPrice = (int)$maxPrice;

                    $q->orWhere(function ($query) use ($minPrice, $maxPrice) {
                        $query->where('sale_price', '>=', $minPrice)
                            ->where('sale_price', '<=', $maxPrice);
                    });
                }
            });
        }

        // Apply search term to multiple fields (name, author, publisher)
        $query->where(function ($q) {
            if ($this->search_term) {
                $q->where('name', 'like', $this->search_term)
                    ->orWhere('author', 'like', $this->search_term)
                    ->orWhere('publisher', 'like', $this->search_term);
            }
        });

        // Apply ordering logic based on user selection
        switch ($this->orderBy) {
            case 'Giá thấp':
                $query->orderBy('sale_price', 'ASC');
                break;
            case 'Giá cao':
                $query->orderBy('sale_price', 'DESC');
                break;
            case 'Sản phẩm mới':
                $query->orderBy('created_at', 'DESC');
                break;
            default:
                // Default ordering if no specific order is selected
                break;
        }

        // Apply price range filter
        $query->whereBetween('sale_price', [$this->min_price, $this->max_price]);

        // Get paginated results
        $products = $query->paginate($this->pagesize);

        // Get latest 3 products for the "new products" section
        $nproducts = Product::latest()->take(3)->get();

        return view('livewire.search-component', [
            'categories' => $categories,
            'products' => $products,
            'nproducts' => $nproducts
        ]);
    }
}
