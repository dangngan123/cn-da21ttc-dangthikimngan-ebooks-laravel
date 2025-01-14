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
### HƯỚNG DẪN CÀI ĐẶT DỰ ÁN
#### Yêu Cầu Hệ Thống
  - PHP 8.2
  - Composer
  - MySQL
  - Git
  - li
#### Các Bước Cài Đặt
  - Clone Project
  - git clone https://github.com/dangngan123/cn-da21ttc-dangthikimngan-ebooks-laravel.git
  - cd cn-da21ttc-dangthikimngan-ebooks-laravel
### Cài Đặt Dependencies
  'composer install'
  'npm install'
  'npm run dev'
### Cấu hình môi trường
  'cp .env.example .env'
  'php artisan key:generate'
### Run migrations
 'php artisan migrate'
### Run server
 'php artisan serve'
 'http://localhost:8000'
### Cấu Hình Google Login
 - Truy cập Google Cloud Console
 - Tạo project mới
 - Vào Credentials -> Create Credentials -> OAuth Client ID
 - Thiết lập OAuth consent screen
 - Tạo OAuth Client ID cho Web application
 - Thêm redirect URI: http://localhost:8000/auth/google/callback
 - Copy Client ID và Client Secret vào file .env:
 - GOOGLE_CLIENT_ID=your-client-id
 - GOOGLE_CLIENT_SECRET=your-client-secret
 - GOOGLE_REDIRECT_URI=http://localhost:8000/auth/google/callback
### Nếu gặp lỗi permissions
 - chmod -R 777 storage
 - chmod -R 777 bootstrap/cache
