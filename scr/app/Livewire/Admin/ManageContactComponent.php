<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Contact;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Mail;

class ManageContactComponent extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $pagesize = 5;
    public $processing = false;

    public function changepageSize($size)
    {
        $this->pagesize = $size;
        $this->resetPage();
    }

    public function sendEmail($contactId)
    {
        $this->processing = true;

        try {
            // Lấy thông tin liên hệ
            $contact = Contact::find($contactId);

            if (!$contact) {
                session()->flash('error', 'Không tìm thấy thông tin liên hệ.');
                return;
            }

            // Gửi email
            Mail::raw(
                "Xin chào {$contact->name},\n\nCảm ơn bạn đã liên hệ với chúng tôi!",
                function ($message) use ($contact) {
                    $message->to($contact->email)
                        ->subject('Phản hồi từ đội ngũ hỗ trợ');
                }
            );

            // Cập nhật trạng thái thành "Đã xử lý"
            $contact->status = 1;
            $contact->save();

            // Thông báo thành công và trigger cập nhật UI
            session()->flash('success', 'Email đã được gửi thành công!');
            $this->dispatch('contact-updated');
        } catch (\Exception $e) {
            session()->flash('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        } finally {
            $this->processing = false;
        }
    }









    //Checkbox
    public $selectAll;
    public $selectedItems = [];

    public function updatedSelectAll($value)
    {
        // Nếu chọn tất cả, thêm toàn bộ ID slider vào mảng
        if ($value) {
            $this->selectedItems = Contact::pluck('id')->toArray();
        } else {
            // Nếu bỏ chọn, xóa sạch mảng
            $this->selectedItems = [];
        }
    }

    public function updatedSelectedItems()
    {
        // Kiểm tra nếu số lượng selected items bằng tổng số slider
        if (count($this->selectedItems) === count(Contact::pluck('id'))) {
            $this->selectAll = True;
        } else {
            $this->selectAll = False;
        }
    }
    //Xóa nhiều slider
    public function selecteDelete()
    {
        foreach ($this->selectedItems as $item) {
            $contact = Contact::find($item);
            $image_path = public_path('admin/slider/' . $contact->image);
            if (file_exists($image_path)) {
                unlink($image_path);
            }
            $contact->delete();
        }
        $this->selectAll = False;
        $this->selectedItems = [];
        flash('Slider đã được bị xóa.');
    }
    //hoạt động nhiều slider
    public function selecteActive($value)
    {
        foreach ($this->selectedItems as $item) {
            $contact = Contact::find($item);
            $contact->status = $value;
            $contact->save();
            $this->selectedItems = [];
            $this->selectAll = false;
        }
        flash('Slider đã được bật.');
    }
    //tắt nhiều slider
    public function selecteInactive($value)
    {
        foreach ($this->selectedItems as $item) {
            $contact = Contact::find($item);
            $contact->status = $value;
            $contact->save();
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

    public function render()
    {
        $contacts = Contact::orderBy('created_at', 'desc')->paginate($this->pagesize);
        return view('livewire.admin.manage-contact-component', ['contacts' => $contacts]);
    }
}
