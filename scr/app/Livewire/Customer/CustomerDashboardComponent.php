<?php

namespace App\Livewire\Customer;

use Livewire\Component;
use Livewire\WithFileUploads;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;
use Illuminate\Support\Facades\Auth;
use Vanthao03596\HCVN\Models\District;
use Vanthao03596\HCVN\Models\Province;
use Vanthao03596\HCVN\Models\Ward;
use App\Models\Shiping;

class CustomerDashboardComponent extends Component
{
    use WithFileUploads;
    public $name;
    public $email;
    public $current_password;
    public $password;
    public $password_confirmation;
    public $avatar;
    public $additional_info;
    public $user;
    public $new_avatar;

    protected $rules = [
        'name' => 'required|min:3',
        'email' => 'required|email',
        'current_password' => 'required_with:password',
        'password' => 'nullable|min:8|confirmed',
       
    ];

    protected $messages = [
        'name.required' => 'Vui lòng nhập họ tên',
        'name.min' => 'Họ tên phải có ít nhất 3 ký tự',
        'email.required' => 'Vui lòng nhập email',
        'email.email' => 'Email không hợp lệ',
    ];

    public function mount()
    {
        $this->user = Auth::user();
        $this->name = $this->user->name;
        $this->email = $this->user->email;
       
    }

    public function updateProfile()
    {
        $this->validate();

        // Kiểm tra email đã tồn tại
        if ($this->email !== $this->user->email) {
            $this->validate([
                'email' => 'unique:users,email,' . $this->user->id,
            ]);
        }
        // Cập nhật thông tin cơ bản
        $this->user->name = $this->name;
        $this->user->email = $this->email;
        $this->user->save();

        session()->flash('message', 'Cập nhật thông tin thành công!');
    }



    public function render()
    {

        return view('livewire.customer.customer-dashboard-component');
    }
}
