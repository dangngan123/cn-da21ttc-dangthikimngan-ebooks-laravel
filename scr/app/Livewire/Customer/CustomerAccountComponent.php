<?php

namespace App\Livewire\Customer;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;

class CustomerAccountComponent extends Component
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
        'new_avatar' => 'nullable|image|max:1024', // Tối đa 1MB
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
        $this->avatar = $this->user->avatar;
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
        $this->user->additional_info = $this->additional_info;


        // Xử lý upload avatar
        if ($this->new_avatar) {
            // Xóa avatar cũ nếu có
            if ($this->user->avatar && file_exists(public_path('customer/avatar/' . $this->user->avatar))) {
                unlink(public_path('customer/avatar/' . $this->user->avatar));
            }
            // Upload avatar mới
            $avatarName = time() . '.' . $this->new_avatar->getClientOriginalExtension();
            $this->user->avatar = $avatarName;
            $this->new_avatar->move(public_path('customer/avatar'), $avatarName);
        } elseif ($this->avatar) {
            $new_avatar = time() . '.' . $this->avatar->extension();
            $this->user->avatar = $new_avatar;
            $manager = new ImageManager(new Driver());
            $image = $manager->read($this->avatar);
            $image->resize(400, 400);
            $image->toPng()->save(base_path('customer/avatar/' . $new_avatar));
        }

        $this->user->save();

        session()->flash('message', 'Cập nhật thông tin thành công!');
    }



    public function render()
    {
        return view('livewire.customer.customer-account-component');
    }
}
