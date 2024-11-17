<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 400px; /* Chiều rộng của form */
            margin-top: 100px; /* Khoảng cách từ trên xuống */
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .text-center {
            color: gray; /* Màu xám cho tiêu đề */
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="text-center">Đăng Nhập</h2>
    <form action="login.php" method="POST">
        <div class="mb-3">
            <label for="username" class="form-label">Tên Người Dùng:</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mật Khẩu:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary w-100">Đăng Nhập</button>
        </div>
        <div class="mt-3 text-center">
         <a href="{{ route('signup') }}">Chưa có tài khoản? Đăng ký ngay!</a>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>