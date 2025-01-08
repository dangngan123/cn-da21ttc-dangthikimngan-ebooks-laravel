<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Contact;
use Illuminate\Support\Facades\Log;

class ContactComponent extends Component
{
    public $name;
    public $email;
    public $telephone;
    public $subject;
    public $message;

    public function submit()
    {
        try {
            // Debug data trước khi validate
            Log::info('Form Data:', [
                'name' => $this->name,
                'email' => $this->email,
                'telephone' => $this->telephone,
                'subject' => $this->subject,
                'message' => $this->message
            ]);

            $this->validate([
                'name' => 'required|min:3',
                'email' => 'required|email',
                'telephone' => 'required|regex:/^[0-9]{10,11}$/',
                'subject' => 'required|min:5',
                'message' => 'required|min:10'
            ]);

            // Debug sau khi validate
            Log::info('Validation passed');

            $contact = Contact::create([
                'name' => $this->name,
                'email' => $this->email,
                'telephone' => $this->telephone,
                'subject' => $this->subject,
                'message' => $this->message,
            ]);

            // Debug kết quả tạo contact
            Log::info('Contact created:', ['contact_id' => $contact->id]);

            session()->flash('success', 'Gửi tin nhắn thành công!');
            $this->reset();
            $this->dispatch('contactSubmitted');
        } catch (\Exception $e) {
            Log::error('Contact Error: ' . $e->getMessage());
            Log::error($e->getTraceAsString());
            session()->flash('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.contact-component');
    }
}
