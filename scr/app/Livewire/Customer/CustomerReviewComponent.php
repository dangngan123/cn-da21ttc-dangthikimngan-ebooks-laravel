<?php

namespace App\Livewire\Customer;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\OrderItem;
use App\Models\Review;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CustomerReviewComponent extends Component
{
    use WithFileUploads;

    public $order_item_id;
    public $rating;
    public $comment;
    public $images = [];
    public $status;
    public $review;
    public $new_image;
    public $new_images = [];

    public function mount($order_item_id)
    {
        $orderItem = OrderItem::find($order_item_id);

        if (!$orderItem || $orderItem->status) {
            abort(404, 'Không tìm thấy sản phẩm hoặc đã đánh giá.');
        }

        $this->order_item_id = $order_item_id;

        $this->review = Review::where('order_item_id', $order_item_id)
            ->where('user_id', Auth::user()->id)
            ->first();

        if ($this->review) {
            $this->rating = $this->review->rating;
            $this->comment = $this->review->comment;
            $this->images = $this->review->images ? explode(',', $this->review->images) : [];
        }
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'rating' => 'required|numeric|min:1|max:5',
            'comment' => 'required|string',
            'images' => 'nullable|array', // Cho phép null hoặc array
            'images.*' => 'image|max:1024', // Validate từng ảnh nếu có
        ]);

        // Kiểm tra nếu có ảnh thì số lượng ảnh phải từ 1 đến 5
        if (!empty($this->images) && (count($this->images) < 1 || count($this->images) > 5)) {
            $this->addError('images', 'Bạn có thể tải lên từ 1 đến 5 ảnh.');
            return;
        }
    }

    public function addReview()
    {
        // Validate các trường bắt buộc
        $this->validate([
            'rating' => 'required|numeric|min:1|max:5',
            'comment' => 'required|string',
            'images' => 'nullable|array', // Cho phép null hoặc array
            'images.*' => 'image|max:1024',
        ]);

        // Kiểm tra nếu có ảnh thì số lượng ảnh phải từ 1 đến 5
        if (!empty($this->images) && (count($this->images) < 1 || count($this->images) > 5)) {
            $this->addError('images', 'Bạn có thể tải lên từ 1 đến 5 ảnh.');
            return;
        }

        $review = new Review();
        $review->user_id = Auth::user()->id;
        $review->order_item_id = $this->order_item_id;
        $review->rating = $this->rating;
        $review->comment = $this->comment;
        $review->status = 'pending';

        // Xử lý ảnh nếu có
        if (!empty($this->images)) {
            // Ensure directory exists
            $path = public_path('admin/review');
            if (!is_dir($path)) {
                mkdir($path, 0775, true);
            }

            $imagesname = [];
            foreach ($this->images as $key => $image) {
                $imgName = Carbon::now()->timestamp . $key . '.' . $image->getClientOriginalExtension();

                // Use Intervention Image
                $manager = new ImageManager(new Driver());
                $img = $manager->read($image->getRealPath());
                $img->resize(800, 800, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });

                $img->save($path . '/' . $imgName);
                $imagesname[] = $imgName;
            }

            $review->images = implode(',', $imagesname);
        }

        $review->save();

        // Update OrderItem status
        $orderItem = OrderItem::find($this->order_item_id);
        $orderItem->save();

        $this->resetForm();
        session()->flash('message', 'Cảm ơn bạn đã đánh giá sản phẩm!');
        return redirect()->route('customer.orders'); 
    }

    public function resetForm()
    {
        $this->rating = '';
        $this->images = [];
        $this->comment = '';
        $this->resetValidation();
    }

    public function removeImage($type, $index = null)
    {
        if ($type === 'main') {
            if (file_exists(public_path('admin/review/' . $this->images))) {
                unlink(public_path('admin/review/' . $this->images));
            }
            $this->images = null;
        }

        if ($type === 'additional' && $index !== null) {
            $imagePath = public_path('admin/review/' . $this->images[$index]);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
            unset($this->images[$index]);
            $this->images = array_values($this->images);
        }
    }

    public function render()
    {
        $orderItem = OrderItem::find($this->order_item_id);
        $reviews = Review::where('order_item_id', $this->order_item_id)->get();

        return view('livewire.customer.customer-review-component', [
            'orderItem' => $orderItem,
            'reviews' => $reviews,
        ]);
    }
}
