## Xây dựng website bán sách trực tuyến ##
### Giảng viên hướng dẫn ###
  - Đoàn Phước Miền
  - Email: antonio86doan@gmail.com
  - Điện thoại: 0978962954
### Sinh viên thực hiện ###
  - Đặng Thị Kim Ngân
  - Email: iamkimngan197@gmail.com
  - Số điện thoại: 0795405536
### BÁO CÁO TIẾN ĐỘ ###
- Cài đặt công cụ hỗ trợ làm đồ án:
   + Visual Studio Code
   + Xampp
- Thực hiện công việc của tuần 1:
  - Tìm hiểu và đọc tài liệu về công nghệ PHP, MySQL và framework Laravel.
  - Phân tích yêu cầu hệ thống
  - Thiết kế cơ sở dữ liệu
  - Cài đặt và cấu hình XAMPP: https://sourceforge.net/projects/xampp/files/XAMPP%20Windows/8.2.12/xampp-windows-x64-8.2.12-0-VS16-installer.exe
  - Cài đặt composer: https://getcomposer.org/Composer-Setup.exe
  - Cài đặt dự án Laravel: composer create-project laravel/laravel <tên dự án>
# HƯỚNG DẪN CÀI ĐẶT DỰ ÁN

## Yêu Cầu Hệ Thống
Để chạy được dự án này, bạn cần đảm bảo hệ thống đáp ứng các yêu cầu sau:
- **PHP** 8.2
- **Laravel** 11
- **Livewire** 3.0
- **Composer**
- **MySQL**
- **Git**

## Các Bước Cài Đặt

### 1. Clone Project
Sử dụng lệnh sau để clone dự án từ GitHub:
```bash
git clone https://github.com/dangngan123/cn-da21ttc-dangthikimngan-ebooks-laravel.git
cd cn-da21ttc-dangthikimngan-ebooks-laravel
```

### 2. Cài Đặt Dependencies
Cài đặt các gói phụ thuộc của PHP và JavaScript:
```bash
composer install
npm install
npm run dev
```

### 3. Cấu Hình Môi Trường
Tạo file `.env` từ file mẫu và tạo key ứng dụng:
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Run Migrations
Chạy migrations để tạo các bảng trong cơ sở dữ liệu:
```bash
php artisan migrate
```

### 5. Run Server
Khởi động server Laravel:
```bash
php artisan serve
```
Truy cập ứng dụng tại: [http://localhost:8000](http://localhost:8000)

---

## Cấu Hình Google Login
Để cấu hình chức năng đăng nhập bằng Google, thực hiện các bước sau:

1. Truy cập **Google Cloud Console**: [https://console.cloud.google.com](https://console.cloud.google.com).
2. Tạo một **Project** mới.
3. Vào mục **Credentials** -> **Create Credentials** -> **OAuth Client ID**.
4. Thiết lập **OAuth consent screen**.
5. Tạo **OAuth Client ID** cho **Web application**.
6. Thêm redirect URI:
   ```
   http://localhost:8000/auth/google/callback
   ```
7. Sao chép **Client ID** và **Client Secret** và dán vào file `.env`:
   ```env
   GOOGLE_CLIENT_ID=your-client-id
   GOOGLE_CLIENT_SECRET=your-client-secret
   GOOGLE_REDIRECT_URI=http://localhost:8000/auth/google/callback
   ```

---

### Nếu Gặp Lỗi Permissions
Chạy lệnh sau để sửa lỗi quyền:
```bash
chmod -R 777 storage
chmod -R 777 bootstrap/cache
