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
    public $replyMessage = '';
    public $showReplyModal = false;
    public $selectedContactId;

    protected $rules = [
        'replyMessage' => 'required|min:10'
    ];

    public function openReplyModal($contactId)
    {
        $this->selectedContactId = $contactId;
        $this->replyMessage = ''; // Reset message khi mở modal mới
        $this->showReplyModal = true;
    }

    public function closeReplyModal()
    {
        $this->showReplyModal = false;
        $this->replyMessage = '';
        $this->selectedContactId = null;
    }


    public function sendEmail($contactId)
    {
        $this->validate();

        $this->processing = true;

        try {
            $contact = Contact::find($contactId);

            if (!$contact) {
                session()->flash('error', 'Không tìm thấy thông tin liên hệ. Vui lòng kiểm tra lại.');
                return;
            }

            // Cập nhật nội dung thư với cách diễn đạt lịch sự và chuyên nghiệp hơn
            $emailContent = "
            Kính gửi {$contact->name},
    
            Cảm ơn bạn đã liên hệ với chúng tôi. Chúng tôi rất vui khi được hỗ trợ bạn.
    
            {$this->replyMessage}
    
            Nếu bạn có bất kỳ câu hỏi nào thêm, đừng ngần ngại liên hệ lại với chúng tôi. 
    
            Trân trọng,
            Đội ngũ hỗ trợ của chúng tôi
            ";

            Mail::raw($emailContent, function ($message) use ($contact) {
                $message->to($contact->email)
                    ->subject('Phản hồi từ Đội ngũ Hỗ trợ');
            });

            $contact->status = 1;
            $contact->save();

            session()->flash('success', 'Email phản hồi đã được gửi thành công! Chúng tôi sẽ tiếp tục hỗ trợ bạn trong thời gian sớm nhất.');
            $this->closeReplyModal();
            $this->dispatch('contact-updated');
        } catch (\Exception $e) {
            session()->flash('error', 'Có lỗi xảy ra khi gửi email: ' . $e->getMessage());
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
