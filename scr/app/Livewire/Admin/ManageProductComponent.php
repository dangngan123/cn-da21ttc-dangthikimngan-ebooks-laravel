<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Product;
use App\Models\Category;
use Livewire\WithPagination;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;
use App\Exports\ProductsExport;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Imports\ProductImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;


class ManageProductComponent extends Component
{
    use WithPagination;
    use WithFileUploads;



    protected $paginationTheme = 'bootstrap';
    public $pagesize = 10;
    public $delete_id;
    //add product
    public $name;
    public $slug;
    public $short_description;
    public $long_description;
    public $reguler_price;
    public $sale_price;
    public $quantity;
    public $publisher;
    public $author;
    public $age;
    public $image;
    public $images = [];
    public $category_id;
    public $is_hot = 0;



    public function changepageSize($size)
    {
        $this->pagesize  = $size;
        $this->resetPage();
    }







    //Slug
    public function generateSlug()
    {
        $this->slug = Str::slug($this->name);
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

    // Xử lý xóa khi được xác nhận
    public function delete()
    {
        $product = Product::find($this->delete_id);

        if ($product) {
            // Xóa ảnh chính
            try {
                $image_path = public_path('admin/product/' . $product->image);
                if (file_exists($image_path)) {
                    unlink($image_path);
                }
            } catch (\Exception $e) {
                // Bỏ qua lỗi nếu file không tồn tại
            }

            // Xóa các ảnh phụ
            try {
                $additional_images = explode(',', $product->images);
                foreach ($additional_images as $additional_image) {
                    $additional_image_path = public_path('admin/product/' . $additional_image);
                    if (file_exists($additional_image_path)) {
                        unlink($additional_image_path);
                    }
                }
            } catch (\Exception $e) {
                // Bỏ qua lỗi nếu file không tồn tại
            }
            $product->delete();
            flash('Sản phẩm đã được xóa thành công.');
        }
    }
    //Kết thúc xóa



    //add product
    public function showProductModal()
    {
        $this->dispatch('product-modal');
    }
    public function updated($filed)
    {
        $this->validateOnly($filed, [
            'name' => 'required',
            'short_description' => 'required',
            'long_description' => 'required',
            'reguler_price' => 'required',
            'sale_price' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png,gif,bmp',
            'images' => 'required',
            'quantity' => 'required',
            'publisher' => 'required',
            'author' => 'required',
            'age' => 'required|regex:/^[1-9][0-9]*\+?$/|min:1|max:18',
            'category_id' => 'required'

        ]);
    }

    public function addProduct()
    {
        $this->validate([
            'name' => 'required',
            'short_description' => 'required',
            'long_description' => 'required',
            'reguler_price' => 'required',
            'sale_price' => 'required',
            'quantity' => 'required',
            'publisher' => 'required',
            'author' => 'required',
            'age' => 'required|regex:/^[1-9][0-9]*\+?$/|min:1|max:18',
            'image' => 'required|mimes:jpg,jpeg,png,gif,bmp',
            'images' => 'required',
            'category_id' => 'required'
        ]);
        $product = new Product();
        $product->name = $this->name;
        $product->slug = $this->slug;
        $product->short_description = $this->short_description;
        $product->long_description = $this->long_description;
        $product->reguler_price = $this->reguler_price;
        $product->sale_price = $this->sale_price;
        $product->quantity = $this->quantity;
        $product->publisher = $this->publisher;
        $product->author = $this->author;
        $product->age = $this->age;
        $product->is_hot = $this->is_hot;
        $imageName = Carbon::now()->timestamp . '.' . $this->image->getClientOriginalExtension();
        $manager = new ImageManager(new Driver());
        $image = $manager->read($this->image->getRealPath());
        $image->resize(400, 400);
        $image->toPng()->save(public_path('admin/product/' . $imageName));
        $product->image = $imageName;

        // Additional images
        if ($this->images) {
            $imagesname = '';
            foreach ($this->images as $key => $image) {
                $imgName = Carbon::now()->timestamp . $key . '.' . $image->getClientOriginalExtension();
                $manager = new ImageManager(new Driver());
                $processedImage = $manager->read($image->getRealPath());
                $processedImage->resize(400, 400);
                $processedImage->toPng()->save(public_path('admin/product/' . $imgName));
                $imagesname = $imagesname ? $imagesname . ',' . $imgName : $imgName;
            }
            $product->images = $imagesname;
        }
        $product->category_id = $this->category_id;
        $product->save();
        $this->dispatch('product-modal');
        $this->resetForm();
        flash('Sản phẩm đã được thêm thành công.');
    }
    public $rand;
    public function resetForm()
    {
        $this->name = '';
        $this->slug = '';
        $this->short_description = '';
        $this->long_description = '';
        $this->reguler_price = '';
        $this->sale_price = '';
        $this->quantity = '';
        $this->publisher = '';
        $this->author = '';
        $this->age = '';
        $this->image = '';
        $this->images = '';
        $this->category_id = '';
        $this->is_hot = '';
        $this->rand++;
        $this->resetValidation();
    }
    public function hydratedrate()
    {
        $this->resetPage();
    }
    //edit product
    public $new_image;
    public $new_images = [];
    public $sid;
    public $editForm = false;

    public $titleForm = 'Thêm sản phẩm';
    public function showEditProduct($id)
    {
        $this->dispatch('product-modal');
        $this->titleForm = 'Cập nhật sản phẩm';
        $this->editForm = true;


        $product = Product::where('id', $id)->first();
        $this->name = $product->name;
        $this->slug = $product->slug;
        $this->short_description = $product->short_description;
        $this->long_description = $product->long_description;
        $this->reguler_price = $product->reguler_price;
        $this->sale_price = $product->sale_price;
        $this->quantity = $product->quantity;
        $this->publisher = $product->publisher;
        $this->author = $product->author;
        $this->age = $product->age;
        $this->is_hot = $product->is_hot;
        $this->category_id = $product->category_id;
        $this->new_image = $product->image;
        $this->new_images = explode(',', $product->images);
        $this->sid = $product->id;
    }

    //update product
    public function updateProduct()
    {
        $this->validate([
            'name' => 'required',
            'short_description' => 'required',
            'long_description' => 'required',
            'reguler_price' => 'required',
            'sale_price' => 'required',
            'quantity' => 'required',
            'publisher' => 'required',
            'author' => 'required',
            'age' => 'required|regex:/^[1-9][0-9]*\+?$/|min:1|max:18',
            'category_id' => 'required'
        ]);
        $product = Product::find($this->sid);
        $product->name = $this->name;
        $product->slug = $this->slug;
        $product->short_description = $this->short_description;
        $product->long_description = $this->long_description;
        $product->reguler_price = $this->reguler_price;
        $product->sale_price = $this->sale_price;
        $product->quantity = $this->quantity;
        $product->publisher = $this->publisher;
        $product->author = $this->author;
        $product->age = $this->age;
        $product->is_hot = $this->is_hot;
        $product->category_id = $this->category_id;
        if ($this->new_image && $this->new_image instanceof \Illuminate\Http\UploadedFile) {
            // Delete old image if exists
            $oldImagePath = public_path('admin/product/' . $product->image);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }

            // Process new main image
            $imageName = Carbon::now()->timestamp . '.' . $this->new_image->getClientOriginalExtension();
            $manager = new ImageManager(new Driver());
            $image = $manager->read($this->new_image->getRealPath());
            $image->resize(400, 400);
            $image->toPng()->save(public_path('admin/product/' . $imageName));
            $product->image = $imageName;
        }

        // Handle additional images update
        if ($this->new_images && is_array($this->new_images)) {
            $imagesName = '';
            foreach ($this->new_images as $key => $image) {
                if ($image instanceof \Illuminate\Http\UploadedFile) {
                    $imgName = Carbon::now()->timestamp . $key . '.' . $image->getClientOriginalExtension();
                    $manager = new ImageManager(new Driver());
                    $processedImage = $manager->read($image->getRealPath());
                    $processedImage->resize(400, 400);
                    $processedImage->toPng()->save(public_path('admin/product/' . $imgName));
                    $imagesName = $imagesName ? $imagesName . ',' . $imgName : $imgName;
                }
            }
            $product->images = $imagesName;
        }
        $product->save();
        $this->dispatch('product-modal');
        $this->resetForm();
        flash('Sản phẩm đã được cập nhật thành công.');
    }









    //Checkbox
    public $selectAll;
    public $selectedItems = [];

    public function updatedSelectAll($value)
    {
        // Nếu chọn tất cả, thêm toàn bộ ID slider vào mảng
        if ($value) {
            $this->selectedItems = product::pluck('id')->toArray();
        } else {
            // Nếu bỏ chọn, xóa sạch mảng
            $this->selectedItems = [];
        }
    }

    public function updatedSelectedItems()
    {
        // Kiểm tra nếu số lượng selected items bằng tổng số slider
        if (count($this->selectedItems) === count(product::pluck('id'))) {
            $this->selectAll = True;
        } else {
            $this->selectAll = False;
        }
    }
    //Xóa nhiều slider
    public function selecteDelete()
    {
        try {
            foreach ($this->selectedItems as $item) {
                $products = product::find($item);

                if ($products) {
                    // Xóa ảnh chính
                    try {
                        $image_path = public_path('admin/product/' . $products->image);
                        if (file_exists($image_path)) {
                            unlink($image_path);
                        }
                    } catch (\Exception $e) {
                        // Bỏ qua lỗi khi không tìm thấy file ảnh chính
                    }

                    // Xóa các ảnh phụ
                    try {
                        $additional_images = explode(',', $products->images);
                        foreach ($additional_images as $additional_image) {
                            if (!empty($additional_image)) {
                                $additional_image_path = public_path('admin/product/' . $additional_image);
                                if (file_exists($additional_image_path)) {
                                    unlink($additional_image_path);
                                }
                            }
                        }
                    } catch (\Exception $e) {
                        // Bỏ qua lỗi khi không tìm thấy file ảnh phụ
                    }

                    // Xóa sản phẩm trong database
                    $products->delete();
                }
            }

            $this->selectAll = false;
            $this->selectedItems = [];
            flash('Sản phẩm đã được xóa thành công.');
        } catch (\Exception $e) {
            flash('Có lỗi xảy ra khi xóa sản phẩm: ' . $e->getMessage())->error();
        }
    }
    // //hoạt động nhiều slider
    // public function selecteActive($value)
    // {
    //     foreach ($this->selectedItems as $item) {
    //         $products = product::find($item);
    //         $products->status = $value;
    //         $products->save();
    //         $this->selectedItems = [];
    //         $this->selectAll = false;
    //     }
    //     flash('Slider đã được bật.');
    // }
    // //tắt nhiều slider
    // public function selecteInactive($value)
    // {
    //     foreach ($this->selectedItems as $item) {
    //         $products = product::find($item);
    //         $products->status = $value;
    //         $products->save();
    //         $this->selectedItems = [];
    //         $this->selectAll = false;
    //     }
    //     flash('Slider đã được tắt.');
    // }

    //Chọn màu cho slider
    public function isColor($sliderId)
    {
        if ($this->selectAll == false) {
            if (in_array($sliderId, $this->selectedItems)) {
                return 'bg-1';
            } else {
                return '';
            }
        } else {
            return 'bg-1';
        }
    }
    // Phương thức để xóa ảnh
    public function removeImage($type, $index = null)
    {
        if ($type === 'main') {
            $this->image = null;
            $this->new_image = null;
        }

        if ($type === 'additional' && $index !== null) {
            // Xóa ảnh phụ tại vị trí $index
            unset($this->images[$index]);
            unset($this->new_images[$index]);
        }
    }

    //Xuất excel
    public function export()
    {
        // return Excel::download(new SlidersExport, 'sliders.xlsx');
        return (new ProductsExport($this->selectedItems))->download('products.xlsx');
    }


    public function updateIsHot($checked)
    {
        $this->is_hot = $checked ? 1 : 0;
    }






    public $file;
    public function import()
    {
        try {
            $this->validate([
                'file' => 'required|file|mimes:xlsx,xls|max:10240',
            ]);

            if ($this->file) {
                Excel::import(new ProductImport, $this->file);

                session()->flash('message', 'Nhập dữ liệu thành công!');
                $this->file = null;
            }
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            session()->flash('error', 'Lỗi dữ liệu: ' . implode(", ", array_map(function ($failure) {
                return "Dòng {$failure->row()}: {$failure->errors()[0]}";
            }, $e->failures())));
        } catch (\Exception $e) {
            session()->flash('error', 'Có lỗi xảy ra khi nhập dữ liệu: ' . $e->getMessage());
            Log::error('Import error: ' . $e->getMessage());
        }
    }




























    //Tìm kiếm
    public $search;
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatedStatusFilter()
    {
        $this->resetPage();
    }

    public $statusFilter = '';

    public $page = 1; // Thêm thuộc tính này

    public function render()
    {
        $query = Product::query();

        // Áp dụng bộ lọc trạng thái nếu có
        if ($this->statusFilter == 'in_stock') {
            $query->where('quantity', '>', 5);
        } elseif ($this->statusFilter == 'low_stock') {
            $query->whereBetween('quantity', [1, 5]);
        } elseif ($this->statusFilter == 'out_of_stock') {
            $query->where('quantity', 0);
        }

        // Áp dụng bộ lọc tìm kiếm nếu có
        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        // Lấy danh mục
        $categories = Category::all();

        // Phân trang các sản phẩm đã lọc
        $products = $query->paginate($this->pagesize); // Giữ các tham số truy vấn khi phân trang

        return view('livewire.admin.manage-product-component', [
            'products' => $products,
            'categories' => $categories,
        ]);
    }
}
