<?php

namespace App\Imports;

use App\Models\Product;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ProductImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        try {
            // Kiểm tra xem các trường bắt buộc có tồn tại không
            if (empty($row['ten_san_pham'])) {
                Log::error('Thiếu tên sản phẩm ở dòng: ', $row);
                return null; // Bỏ qua dòng này nếu thiếu thông tin
            }

            // Xử lý ảnh chính
            $imagePath = null;
            if (!empty($row['anh_chinh'])) {
                $imagePath = $this->downloadImage($row['anh_chinh']);
            }

            // Xử lý ảnh phụ
            $additionalImages = '';
            if (!empty($row['anh_phu'])) {
                $additionalImages = $this->downloadAdditionalImages($row['anh_phu']);
            }

            // Tạo sản phẩm mới
            return new Product([
                'name' => $row['ten_san_pham'],
                'short_description' => $row['mo_ta_ngan'] ?? '',
                'long_description' => $row['mo_ta_dai'] ?? '',
                'publisher' => $row['nha_xuat_ban'] ?? '',
                'author' => $row['tac_gia'] ?? '',
                'age' => $row['do_tuoi'] ?? '',
                'reguler_price' => is_numeric($row['gia_goc']) ? $row['gia_goc'] : 0,
                'sale_price' => is_numeric($row['giam_gia']) ? $row['giam_gia'] : 0,
                'quantity' => is_numeric($row['so_luong']) ? (int)$row['so_luong'] : 0,
                'image' => $imagePath ?? '',
                'images' => $additionalImages,
                'category_id' => $row['danh_muc'] ?? null,
                'slug' => Str::slug($row['ten_san_pham']),
            ]);
        } catch (\Exception $e) {
            Log::error('Lỗi khi import dòng: ' . json_encode($row) . ' - Error: ' . $e->getMessage());
            return null; // Bỏ qua dòng lỗi và tiếp tục với dòng tiếp theo
        }
    }

    protected function downloadImage($url)
    {
        try {
            if (empty($url)) {
                return '';
            }

            // Kiểm tra URL hợp lệ
            if (!filter_var($url, FILTER_VALIDATE_URL)) {
                Log::error('URL ảnh không hợp lệ: ' . $url);
                return '';
            }

            $response = Http::timeout(30)->get($url);

            if ($response->successful()) {
                $imageName = uniqid('image_') . '.jpg';
                $path = public_path('admin/product/' . $imageName);

                file_put_contents($path, $response->body());
                return $imageName;
            }

            Log::error('Không thể tải ảnh từ URL: ' . $url);
            return '';
        } catch (\Exception $e) {
            Log::error('Lỗi khi tải ảnh: ' . $url . ' - ' . $e->getMessage());
            return '';
        }
    }

    protected function downloadAdditionalImages($urls)
    {
        try {
            if (empty($urls)) {
                return '';
            }

            $imageNames = [];
            $urlArray = array_filter(array_map('trim', explode(',', $urls)));

            foreach ($urlArray as $imageUrl) {
                $downloadedImage = $this->downloadImage($imageUrl);
                if ($downloadedImage) {
                    $imageNames[] = $downloadedImage;
                }
            }

            return implode(',', $imageNames);
        } catch (\Exception $e) {
            Log::error('Lỗi khi tải ảnh phụ: ' . $e->getMessage());
            return '';
        }
    }
}
