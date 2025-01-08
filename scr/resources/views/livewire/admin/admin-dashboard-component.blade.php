<div>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.html" rel="nofollow">Home</a>
                    <span></span> My Account
                </div>
            </div>
        </div>
        <section class="pt-10 pb-10">
            <div class="container">
                <div class="row">
                    <div class="col-lg-30 m-auto">
                        <div class="row  g-1">
                            <div class="col-md-2">
                                <div class="dashboard-menu">
                                    <ul class="nav flex-column" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="dashboard-tab" data-bs-toggle="tab" href="#dashboard" role="tab" aria-controls="dashboard" aria-selected="false"><i class="fi-rs-settings-sliders mr-10"></i>Dashboard</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="slider-tab" data-bs-toggle="tab" href="#slider" role="tab" aria-controls="slider" aria-selected="false"><i class="fa-regular fa-image"></i> Slider</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="category-tab" data-bs-toggle="tab" href="#category" role="tab" aria-controls="category" aria-selected="false"><i class="fa-solid fa-list"></i> Danh mục</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="product-tab" data-bs-toggle="tab" href="#product" role="tab" aria-controls="product" aria-selected="true"><i class="fa-solid fa-box"></i> Sản phẩm</a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link" id="order-tab" data-bs-toggle="tab" href="#order" role="tab" aria-controls="order" aria-selected="true"><i class="fa-solid fa-cart-shopping"></i> Đơn hàng</a>
                                        </li>


                                        <li class="nav-item">
                                            <a class="nav-link" id="coupons-tab" data-bs-toggle="tab" href="#coupons" role="tab" aria-controls="coupons" aria-selected="true"><i class="fa-solid fa-tag"></i> Giảm giá</a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link" id="customer-tab" data-bs-toggle="tab" href="#customer" role="tab" aria-controls="customer" aria-selected="true"><i class="fa-solid fa-user"></i> Khách hàng</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="review-tab" data-bs-toggle="tab" href="#review" role="tab" aria-controls="review" aria-selected="true"><i class="fa-solid fa-star"></i> Đánh giá</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="true"><i class="fa-solid fa-address-book"></i> Liên hệ</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="statistics-tab" data-bs-toggle="tab" href="#statistics" role="tab" aria-controls="statistics" aria-selected="true"><i class="fa-solid fa-chart-line"></i> Thống kê</a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link" href="login.html"><i class="fi-rs-sign-out mr-10"></i>Logout</a>
                                        </li>

                                    </ul>
                                </div>
                            </div>

                            <div class="col-md-10">
                                <div class="tab-content dashboard-content">
                                    <div class="tab-pane fade active show" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                                        <div class="content">
                                            <style>
                                                .content {
                                                    padding-top: 40px;
                                                    padding-bottom: 40px;
                                                }

                                                .icon-stat {
                                                    display: block;
                                                    overflow: hidden;
                                                    position: relative;
                                                    padding: 15px;
                                                    margin-bottom: 1em;
                                                    background-color: #fff;
                                                    border-radius: 4px;
                                                    border: 1px solid #ddd;
                                                }

                                                .icon-stat-label {
                                                    display: block;
                                                    color: #999;
                                                    font-size: 13px;
                                                }

                                                .icon-stat-value {
                                                    display: block;
                                                    font-size: 28px;
                                                    font-weight: 600;
                                                }

                                                .icon-stat-visual {
                                                    position: relative;
                                                    top: 22px;
                                                    display: inline-block;
                                                    width: 32px;
                                                    height: 32px;
                                                    border-radius: 4px;
                                                    text-align: center;
                                                    font-size: 16px;
                                                    line-height: 30px;
                                                }

                                                .bg-primary {
                                                    color: #fff;
                                                    background: #d74b4b;
                                                }

                                                .bg-secondary {
                                                    color: #fff;
                                                    background: #6685a4;
                                                }

                                                .icon-stat-footer {
                                                    padding: 10px 0 0;
                                                    margin-top: 10px;
                                                    color: #aaa;
                                                    font-size: 12px;
                                                    border-top: 1px solid #eee;
                                                }
                                            </style>
                                            <div class="container">
                                                <div class="row">
                                                    <!-- Pending -->
                                                    <div class="col-md-3 col-sm-6">
                                                        <div class="icon-stat">
                                                            <div class="row">
                                                                <div class="col-xs-8 text-left">
                                                                    <span class="icon-stat-label">Tổng doanh thu</span>
                                                                    <span class="icon-stat-value">{{$totalRevenue}}đ</span>
                                                                </div>
                                                                <div class="col-xs-4 text-center">
                                                                    <i class="fa fa-dollar icon-stat-visual bg-primary"></i>
                                                                </div>
                                                            </div>
                                                            <div class="icon-stat-footer">
                                                                <i class="fa fa-clock-o"></i> Đã cập nhật
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Processing -->
                                                    <div class="col-md-3 col-sm-6">
                                                        <div class="icon-stat">
                                                            <div class="row">
                                                                <div class="col-xs-8 text-left">
                                                                    <span class="icon-stat-label">Tổng doanh số</span>
                                                                    <span class="icon-stat-value">{{$totalSales}}</span>
                                                                </div>
                                                                <div class="col-xs-4 text-center">
                                                                    <i class="fa fa-gift icon-stat-visual bg-secondary"></i>
                                                                </div>
                                                            </div>
                                                            <div class="icon-stat-footer">
                                                                <i class="fa fa-clock-o"></i> Đã cập nhật
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Doanh thu hôm nay -->
                                                    <div class="col-md-3 col-sm-6">
                                                        <div class="icon-stat">
                                                            <div class="row">
                                                                <div class="col-xs-8 text-left">
                                                                    <span class="icon-stat-label">Doanh thu hôm nay</span>
                                                                    <span class="icon-stat-value">{{$todayRevenue}}đ</span>
                                                                </div>
                                                                <div class="col-xs-4 text-center">
                                                                    <i class="fa fa-dollar icon-stat-visual bg-primary"></i>
                                                                </div>
                                                            </div>
                                                            <div class="icon-stat-footer">
                                                                <i class="fa fa-clock-o"></i> Đã cập nhật
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Hôm nay bán hàng -->
                                                    <div class="col-md-3 col-sm-6">
                                                        <div class="icon-stat">
                                                            <div class="row">
                                                                <div class="col-xs-8 text-left">
                                                                    <span class="icon-stat-label">Hôm nay bán hàng</span>
                                                                    <span class="icon-stat-value">{{$todaySales}}</span>
                                                                </div>
                                                                <div class="col-xs-4 text-center">
                                                                    <i class="fa fa-gift icon-stat-visual bg-secondary"></i>
                                                                </div>
                                                            </div>
                                                            <div class="icon-stat-footer">
                                                                <i class="fa fa-clock-o"></i> Đã cập nhật
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="container">
                                                <div class="row justify-content-center">
                                                    <!-- Biểu đồ Processing -->
                                                    <div class="col-md-3 col-sm-4 mb-4">
                                                        <div class="card">
                                                            <div class="card-header text-center">
                                                                <h6>Đang xử lý</h6>
                                                            </div>
                                                            <div class="card-body">
                                                                <canvas id="processingChart" style="width: 100%; height: 200px;"></canvas>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Biểu đồ Shipped -->
                                                    <div class="col-md-3 col-sm-4 mb-4">
                                                        <div class="card">
                                                            <div class="card-header text-center">
                                                                <h6>Đang vận chuyển</h6>
                                                            </div>
                                                            <div class="card-body">
                                                                <canvas id="shippedChart" style="width: 100%; height: 200px;"></canvas>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Biểu đồ Delivered -->
                                                    <div class="col-md-3 col-sm-4 mb-4">
                                                        <div class="card">
                                                            <div class="card-header text-center">
                                                                <h6>Đã giao hàng</h6>
                                                            </div>
                                                            <div class="card-body">
                                                                <canvas id="deliveredChart" style="width: 100%; height: 200px;"></canvas>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Biểu đồ Canceled -->
                                                    <div class="col-md-3 col-sm-4 mb-4">
                                                        <div class="card">
                                                            <div class="card-header text-center">
                                                                <h6>Đã hủy</h6>
                                                            </div>
                                                            <div class="card-body">
                                                                <canvas id="canceledChart" style="width: 100%; height: 200px;"></canvas>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="container mt-5">
                                                <div class="row justify-content-center">
                                                    <!-- Biểu đồ Tổng số đơn hàng mỗi ngày -->
                                                    <div class="col-md-6 col-sm-12 mb-4">
                                                        <div class="card">
                                                            <div class="card-header text-center">
                                                                <h6>Tổng số đơn hàng mỗi ngày</h6>
                                                            </div>
                                                            <div class="card-body">
                                                                <canvas id="ordersPerDayChart" style="width: 100%; height: 300px;"></canvas>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Biểu đồ Đánh giá của người dùng -->
                                                    <div class="col-md-6 col-sm-12 mb-4">
                                                        <div class="card">
                                                            <div class="card-header text-center">
                                                                <h6>Đánh giá của người dùng</h6>
                                                            </div>
                                                            <div class="card-body">
                                                                <canvas id="ratingChart" style="width: 100%; height: 300px;"></canvas>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>


                                    </div>
















                                    <div class="tab-pane fade" id="slider" role="tabpanel" aria-labelledby="slider-tab">
                                        @livewire('admin.manage-slider-component')
                                    </div>


                                    <div class="tab-pane fade" id="category" role="tabpanel" aria-labelledby="category-tab">
                                        @livewire('admin.manage-category-component')
                                    </div>

                                    <div class="tab-pane fade" id="product" role="tabpanel" aria-labelledby="product-tab">
                                        @livewire('admin.manage-product-component')
                                    </div>

                                    <div class="tab-pane fade" id="order" role="tabpanel" aria-labelledby="order-tab">
                                        @livewire('admin.manage-order-component')
                                    </div>

                                    <div class="tab-pane fade" id="customer" role="tabpanel" aria-labelledby="customer-tab">
                                        @livewire('admin.manage-customers-component')
                                    </div>


                                    <div class="tab-pane fade" id="coupons" role="tabpanel" aria-labelledby="coupons-tab">
                                        @livewire('admin.manage-coupons-component')
                                    </div>

                                    <div class="tab-pane fade" id="statistics" role="tabpanel" aria-labelledby=" statistics-tab">
                                        @livewire('admin.manage-statistics-component')
                                    </div>

                                    <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
                                        @livewire('admin.manage-review-component')
                                    </div>

                                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                        @livewire('admin.manage-contact-component')
                                    </div>







                                </div>
                            </div>














                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const totalOrders = @json($canceledCount + $deliveredCount + $processingCount + $shippedCount); // Tổng số đơn hàng

        // Biểu đồ Đang xử lý
        const processingCtx = document.getElementById('processingChart');
        new Chart(processingCtx.getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: ['Đang xử lý', 'Khác'],
                datasets: [{
                    data: [@json($processingCount), totalOrders - @json($processingCount)],
                    backgroundColor: ['rgba(54, 162, 235, 0.7)', 'rgba(200, 200, 200, 0.7)'],
                    borderColor: ['rgba(54, 162, 235, 1)', 'rgba(200, 200, 200, 1)'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                    },
                },
            },
        });

        // Biểu đồ Đã giao
        const shippedCtx = document.getElementById('shippedChart');
        new Chart(shippedCtx.getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: ['Đang vận chuyển', 'Khác'],
                datasets: [{
                    data: [@json($shippedCount), totalOrders - @json($shippedCount)],
                    backgroundColor: ['rgba(75, 192, 192, 0.7)', 'rgba(200, 200, 200, 0.7)'],
                    borderColor: ['rgba(75, 192, 192, 1)', 'rgba(200, 200, 200, 1)'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                    },
                },
            },
        });

        // Biểu đồ Đã giao hàng
        const deliveredCtx = document.getElementById('deliveredChart');
        new Chart(deliveredCtx.getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: ['Đã giao hàng', 'Khác'],
                datasets: [{
                    data: [@json($deliveredCount), totalOrders - @json($deliveredCount)],
                    backgroundColor: ['rgba(153, 102, 255, 0.7)', 'rgba(200, 200, 200, 0.7)'],
                    borderColor: ['rgba(153, 102, 255, 1)', 'rgba(200, 200, 200, 1)'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                    },
                },
            },
        });

        // Biểu đồ Đã hủy
        const canceledCtx = document.getElementById('canceledChart');
        new Chart(canceledCtx.getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: ['Đã hủy', 'Khác'],
                datasets: [{
                    data: [@json($canceledCount), totalOrders - @json($canceledCount)],
                    backgroundColor: ['rgba(255, 99, 132, 0.7)', 'rgba(200, 200, 200, 0.7)'],
                    borderColor: ['rgba(255, 99, 132, 1)', 'rgba(200, 200, 200, 1)'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                    },
                },
            },
        });
    });














    document.addEventListener('DOMContentLoaded', function() {
        // Biểu đồ Đang xử lý
        const totalOrders = @json($canceledCount + $deliveredCount + $processingCount + $shippedCount); // Tổng số đơn hàng

        // Đánh giá của người dùng (Giả sử dữ liệu đánh giá từ backend)
        const userRatings = @json($userRatings); // Dữ liệu đánh giá, giả sử là một mảng với số lượng đánh giá của từng điểm
        const ratingLabels = ['0 sao', '1 sao', '2 sao', '3 sao', '4 sao', '5 sao']; // Các mức đánh giá
        const ratingData = [userRatings[0] || 0, userRatings[1] || 0, userRatings[2] || 0, userRatings[3] || 0, userRatings[4] || 0, userRatings[5] || 0]; // Số lượng đánh giá tương ứng

        // Biểu đồ đánh giá
        const ratingCtx = document.getElementById('ratingChart');
        new Chart(ratingCtx.getContext('2d'), {
            type: 'bar',
            data: {
                labels: ratingLabels, // Các mức đánh giá
                datasets: [{
                    label: 'Số lượng đánh giá',
                    data: ratingData, // Số lượng đánh giá cho mỗi mức
                    backgroundColor: 'rgba(75, 192, 192, 0.7)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false, // Không hiển thị legend cho biểu đồ này
                    },
                    tooltip: {
                        enabled: true, // Hiển thị tooltip khi di chuột vào các thanh
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true, // Đảm bảo trục y bắt đầu từ 0
                        min: 0, // Đặt giá trị tối thiểu cho trục y
                        max: 5 // Đặt giá trị tối đa cho trục y
                    }
                }
            },
        });
    });











    document.addEventListener('DOMContentLoaded', function() {
        // Dữ liệu từ Livewire
        const ordersPerDay = @json($ordersPerDay); // Tổng số đơn hàng mỗi ngày trong tuần

        // Các ngày trong tuần
        const daysOfWeek = ['Chủ nhật', 'Thứ 2', 'Thứ 3', 'Thứ 4', 'Thứ 5', 'Thứ 6', 'Thứ 7'];

        // Biểu đồ
        const ctx = document.getElementById('ordersPerDayChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: daysOfWeek, // Các ngày trong tuần
                datasets: [{
                    label: 'Tổng số đơn hàng',
                    data: ordersPerDay, // Số lượng đơn hàng mỗi ngày
                    backgroundColor: 'rgba(75, 192, 192, 0.7)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false // Không hiển thị legend
                    },
                    tooltip: {
                        enabled: true // Hiển thị tooltip
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true // Đảm bảo trục y bắt đầu từ 0
                    }
                }
            }
        });
    });
</script>