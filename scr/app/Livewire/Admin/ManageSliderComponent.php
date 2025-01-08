<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Slider;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;
use App\Exports\SlidersExport;
use Maatwebsite\Excel\Facades\Excel;

class ManageSliderComponent extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $delete_id;
    public $pagesize = 5;

    //add slider
    public $top_title;
    public $slug;
    public $title;
    public $sub_title;
    public $link;
    public $offer;
    public $image;
    public $start_date;
    public $end_date;
    public $status;
    public $type;


    //Hiển thị trang
    public function changepageSize($size)
    {
        $this->pagesize = $size;
        $this->resetPage();
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
        $slider = Slider::find($this->delete_id);

        if ($slider) {
            $image_path = public_path('admin/slider/' . $slider->image);
            if (file_exists($image_path)) {
                unlink($image_path);
            }
            $slider->delete();
            flash('Slider đã được xóa thành công.');
        }
    }
    // Kết thúc xác nhận xóa



    //Thêm slider
    public function showSliderModal()
    {
        $this->dispatch('rafa-modal');
    }

    public function updated($filed)
    {
        $this->validateOnly($filed, [
            'top_title' => 'required',
            'slug' => 'required',
            'title' => 'required',
            'sub_title' => 'required',
            'link' => 'required',
            'offer' => 'required',
            'image' => 'required|mimes:jpeg,png',
            'start_date' => 'required',
            'end_date' => 'required',
            'status' => 'required',
        ]);
    }

    public function addSlider()
    {
        $this->validate([
            'top_title' => 'required',
            'slug' => 'required',
            'title' => 'required',
            'sub_title' => 'required',
            'link' => 'required',
            'offer' => 'required',
            'image' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'status' => 'required',
        ]);
        $slider = new Slider();
        $slider->top_title = $this->top_title;
        $slider->slug = $this->slug;
        $slider->title = $this->title;
        $slider->sub_title = $this->sub_title;
        $slider->link = $this->link;
        $slider->offer = $this->offer;
        $slider->start_date = $this->start_date;
        $slider->end_date = $this->end_date;
        $slider->status = $this->status;
        $slider->type = 'slider';
        if ($this->image) {
            $image_name = time() . '.' . $this->image->extension();
            $slider->image =  $image_name;
            $manager = new ImageManager(new Driver());
            $image = $manager->read($this->image);
            $image->resize(400, 400);
            $image->toPng()->save(base_path('public/admin/slider/' . $image_name));
        }
        $slider->save();
        $this->dispatch('rafa-modal');
        $this->resetForm();
        flash('Slider đã được thêm thành công.');
    }
    public $rand;
    //Reset form
    public function resetForm()
    {
        $this->top_title = '';
        $this->slug = '';
        $this->title = '';
        $this->sub_title = '';
        $this->link = '';
        $this->offer = '';
        $this->image = '';
        $this->start_date = '';
        $this->end_date = '';
        $this->status = '';
        $this->rand++;
        $this->new_image = '';
        $this->editForm = false;
        $this->titleForm = "Thêm slider";
        $this->resetValidation();
    }

    //Slug
    public function generateSlug()
    {
        $this->slug = Str::slug($this->top_title);
    }
    //
    // public function hydrate()
    // {
    //     $this->resetPage();
    // }

    //Chỉnh sửa slider
    public $editForm = false;
    public $titleForm = "Thêm slider";
    public $new_image;
    public $sid;
    public function showEditSlider($id)
    {
        $this->dispatch('rafa-modal');
        $this->titleForm = "Chỉnh sửa slider";
        $this->editForm = true;

        $slider = Slider::where('id', $id)->first();
        $this->top_title = $slider->top_title;
        $this->slug = $slider->slug;
        $this->title = $slider->title;
        $this->sub_title = $slider->sub_title;
        $this->link = $slider->link;
        $this->offer = $slider->offer;
        $this->new_image = $slider->image;
        $this->start_date = $slider->start_date;
        $this->end_date = $slider->end_date;
        $this->status = $slider->status;
        $this->new_image = $slider->image;
        $this->sid = $slider->id;
    }
    public function updateSlider()
    {

        $this->validate([
            'top_title' => 'required',
            'slug' => 'required',
            'title' => 'required',
            'sub_title' => 'required',
            'link' => 'required',
            'offer' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'status' => 'required',
        ]);
        $slider = Slider::find($this->sid);
        $slider->top_title = $this->top_title;
        $slider->slug = $this->slug;
        $slider->title = $this->title;
        $slider->sub_title = $this->sub_title;
        $slider->link = $this->link;
        $slider->offer = $this->offer;
        $slider->start_date = $this->start_date;
        $slider->end_date = $this->end_date;
        $slider->status = $this->status;
        if ($this->image) {
            $image_path = public_path('admin/slider/' . $slider->image);
            if (file_exists($image_path)) {
                unlink($image_path);
            }
            $image_name = time() . '.' . $this->image->extension();
            $slider->image =  $image_name;
            $manager = new ImageManager(new Driver());
            $image = $manager->read($this->image);
            $image->resize(400, 400);
            $image->toPng()->save(base_path('public/admin/slider/' . $image_name));
        }
        $slider->save();
        $this->dispatch('rafa-modal');
        $this->resetForm();
        flash('Slider được chỉnh sửa.');
    }

    //Checkbox
    public $selectAll;
    public $selectedItems = [];

    public function updatedSelectAll($value)
    {
        // Nếu chọn tất cả, thêm toàn bộ ID slider vào mảng
        if ($value) {
            $this->selectedItems = Slider::pluck('id')->toArray();
        } else {
            // Nếu bỏ chọn, xóa sạch mảng
            $this->selectedItems = [];
        }
    }

    public function updatedSelectedItems()
    {
        // Kiểm tra nếu số lượng selected items bằng tổng số slider
        if (count($this->selectedItems) === count(Slider::pluck('id'))) {
            $this->selectAll = True;
        } else {
            $this->selectAll = False;
        }
    }
    //Xóa nhiều slider
    public function selecteDelete()
    {
        foreach ($this->selectedItems as $item) {
            $slider = Slider::find($item);
            $image_path = public_path('admin/slider/' . $slider->image);
            if (file_exists($image_path)) {
                unlink($image_path);
            }
            $slider->delete();
        }
        $this->selectAll = False;
        $this->selectedItems = [];
        flash('Slider đã được bị xóa.');
    }
    //hoạt động nhiều slider
    public function selecteActive($value)
    {
        foreach ($this->selectedItems as $item) {
            $slider = Slider::find($item);
            $slider->status = $value;
            $slider->save();
            $this->selectedItems = [];
            $this->selectAll = false;
        }
        flash('Slider đã được bật.');
    }
    //tắt nhiều slider
    public function selecteInactive($value)
    {
        foreach ($this->selectedItems as $item) {
            $slider = Slider::find($item);
            $slider->status = $value;
            $slider->save();
            $this->selectedItems = [];
            $this->selectAll = false;
        }
        flash('Slider đã được tắt.');
    }



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
    //Xuất excel
    public function export()
    {
        // return Excel::download(new SlidersExport, 'sliders.xlsx');
        return (new SlidersExport($this->selectedItems))->download('sliders.xlsx');
    }














    //Tìm kiếm
    public $search;
    public function updatingSearch()
    {
        $this->resetPage();
    }





    public function render()
    {
        $sliders = Slider::whereAny(['top_title', 'title', 'sub_title', 'link', 'offer'], 'like', '%' . $this->search . '%')
            ->paginate($this->pagesize);
        $this->resetPage();
        return view('livewire.admin.manage-slider-component', ['sliders' => $sliders]);
    }
}
