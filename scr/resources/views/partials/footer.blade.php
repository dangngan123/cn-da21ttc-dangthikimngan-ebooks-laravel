<footer class="bg-light text-dark mt-4 pt-5 pb-4">
    <div class="container">
        <div class="row">
            <!-- Logo và thông tin công ty -->
            <div class="col-md-4 mb-4">
                <img src="/path/to/logo.png" alt="Fahasa Logo" class="img-fluid mb-3" style="max-width: 150px;">
                <p class="no-wrap">Lầu 5, 387-389 Hai Bà Trưng, Quận 3, TP HCM</p>
                <p class="no-wrap">Công Ty Cổ Phần Phát Hành Sách TP HCM - FAHASA</p>
                <p class="no-wrap">60 - 62 Lê Lợi, Quận 1, TP. HCM, Việt Nam</p>
                <p class="no-wrap">Fahasa.com nhận đặt hàng trực tuyến và giao hàng tận nơi. KHÔNG hỗ trợ đặt mua và nhận hàng trực tiếp tại văn phòng cũng như tất cả Hệ Thống Fahasa trên toàn quốc.</p>
                <img src="/path/to/bct-logo.png" alt="Bộ Công Thương" class="img-fluid" style="max-width: 50px;">
            </div>

            <!-- Các cột dịch vụ, hỗ trợ, tài khoản -->
            <div class="col-md-2 mb-4">
                <h5 class="fw-bold text-uppercase letter-spacing">DỊCH VỤ</h5>
                <ul class="list-unstyled">
                    <li><a href="#">Điều khoản sử dụng</a></li>
                    <li><a href="#">Chính sách bảo mật thông tin cá nhân</a></li>
                    <li><a href="#">Chính sách bảo mật thanh toán</a></li>
                    <li><a href="#">Giới thiệu Fahasa</a></li>
                    <li><a href="#">Hệ thống trung tâm - nhà sách</a></li>
                </ul>
            </div>

            <div class="col-md-2 mb-4">
                <h5 class="fw-bold text-uppercase letter-spacing">HỖ TRỢ</h5>
                <ul class="list-unstyled">
                    <li><a href="#">Chính sách đổi - trả - hoàn tiền</a></li>
                    <li><a href="#">Chính sách bảo hành - bồi hoàn</a></li>
                    <li><a href="#">Chính sách vận chuyển</a></li>
                    <li><a href="#">Chính sách khách sỉ</a></li>
                </ul>
            </div>

            <div class="col-md-2 mb-4">
                <h5 class="fw-bold text-uppercase letter-spacing">TÀI KHOẢN CỦA TÔI</h5>
                <ul class="list-unstyled">
                    <li><a href="#">Đăng nhập/Tạo mới tài khoản</a></li>
                    <li><a href="#">Thay đổi địa chỉ khách hàng</a></li>
                    <li><a href="#">Chi tiết tài khoản</a></li>
                    <li><a href="#">Lịch sử mua hàng</a></li>
                </ul>
            </div>
        </div>

        <!-- Phần liên hệ sẽ nằm dưới các cột trên -->
        <div class="row mt-4">
            <div class="col-md-12">
                <h5 class="fw-bold text-uppercase letter-spacing">LIÊN HỆ</h5>
                <p class="no-wrap">60-62 Lê Lợi, Q.1, TP. HCM</p>
                <p class="no-wrap">Email: <a href="mailto:cskh@fahasa.com.vn">cskh@fahasa.com.vn</a></p>
                <p class="no-wrap">Điện thoại: 1900636467</p>
            </div>
        </div>

        <hr>

        <!-- Icon mạng xã hội và ứng dụng thanh toán -->
        <div class="row">
            <div class="col-md-6 mb-3">
                <a href="#" class="me-3"><i class="bi bi-facebook"></i></a>
                <a href="#" class="me-3"><i class="bi bi-instagram"></i></a>
                <a href="#" class="me-3"><i class="bi bi-twitter"></i></a>
                <a href="#" class="me-3"><i class="bi bi-youtube"></i></a>
                <a href="#" class="me-3"><i class="bi bi-tumblr"></i></a>
                <a href="#" class="me-3"><i class="bi bi-pinterest"></i></a>
            </div>
            <div class="col-md-6 text-end">
                <img src="/path/to/google-play.png" alt="Google Play" class="img-fluid me-3" style="max-width: 120px;">
                <img src="/path/to/app-store.png" alt="App Store" class="img-fluid" style="max-width: 120px;">
            </div>
        </div>

        <div class="row text-center mt-3">
            <p class="small text-muted no-wrap">Giấy chứng nhận Đăng ký Kinh doanh số 0304132047 do Sở Kế hoạch và Đầu tư TP.HCM cấp</p>
        </div>
    </div>
</footer>

<style>
    .letter-spacing {
        letter-spacing: 1px; /* Tăng khoảng cách chữ */
    }

    .letter-spacing a {
        letter-spacing: 0.5px; /* Khoảng cách chữ cho các liên kết */
    }

    .text-uppercase {
        text-transform: uppercase; /* Làm chữ in hoa */
    }

    /* Ngăn không cho các đoạn văn bản xuống dòng */
    .no-wrap {
        white-space: nowrap; /* Ngăn việc xuống dòng tự động */
        overflow: hidden;
        text-overflow: ellipsis; /* Thêm dấu chấm nếu văn bản dài quá */
    }

    /* Đảm bảo các cột dịch vụ, hỗ trợ, tài khoản nằm trong một dòng */
    .row {
        display: flex;
        flex-wrap: wrap; /* Cho phép các cột gãy xuống dòng nếu không đủ không gian */
    }

    /* Cột liên hệ sẽ nằm dưới các cột trên */
    .row.mt-4 {
        margin-top: 30px;
    }
</style>
