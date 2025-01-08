<div>
    <div class="container-fluid">
        <!-- Filter Section -->
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Lọc Dữ Liệu</h5>
                <div class="row align-items-center">
                    <div class="col-md-3">
                        <select wire:model="filterType" class="form-select">
                            <option value="custom">Tùy chỉnh</option>
                            <option value="today">Hôm nay</option>
                            <option value="week">Tuần này</option>
                            <option value="month">Tháng này</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <input type="date" wire:model="startDate" class="form-control" />
                    </div>
                    <div class="col-md-3">
                        <input type="date" wire:model="endDate" class="form-control" />
                    </div>
                    <!-- No need for render button -->
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="row">
            <div class="col-md-3">
                <div class="card bg-info text-white mb-4">
                    <div class="card-body">
                        <h6 class="text-uppercase mb-2">Doanh Thu</h6>
                        <h2 class="mb-0">{{ number_format($statistics['revenue'],2) }} đ</h2>
                        <!-- <a href="#" class="text-white">Chi tiết →</a> -->
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body">
                        <h6 class="text-uppercase mb-2">Đơn Hàng</h6>
                        <h2 class="mb-0">{{ $statistics['orders_count'] }}</h2>

                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body">
                        <h6 class="text-uppercase mb-2">Sản Phẩm</h6>
                        <h2 class="mb-0">{{ $statistics['products_count'] }}</h2>

                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-warning text-white mb-4">
                    <div class="card-body">
                        <h6 class="text-uppercase mb-2">Sản Phẩm Sắp Hết Hàng</h6>
                        <h2 class="mb-0">{{ $statistics['low_stock_count'] }}</h2>

                    </div>
                </div>
            </div>
        </div>

        <!-- Charts -->
        <div class="row">
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Doanh Thu</h5>
                    </div>
                    <div class="card-body">
                        <div id="revenueChart" style="height: 300px;"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Phân Bố Sản Phẩm Theo Danh Mục</h5>
                    </div>
                    <div class="card-body">
                        <div id="categoryChart" style="height: 100px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Thống Kê Đơn Hàng</h5>
                </div>
                <div class="card-body">
                    <div id="ordersChart" style="height: 300px;"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- New Chart: Daily Orders Count -->
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Số Lượng Đơn Hàng Theo Ngày</h5>
                </div>
                <div class="card-body">
                    <div id="dailyOrdersChart" style="height: 300px;"></div>
                </div>
            </div>
        </div>
    </div>
   


    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        // Revenue Chart
        var revenueOptions = {
            series: [{
                name: 'Doanh Thu',
                data: @json($revenueData -> pluck('daily_revenue') -> toArray())
            }],
            chart: {
                type: 'line',
                height: 400
            },
            xaxis: {
                categories: @json($revenueData -> pluck('date') -> toArray())
            },
            stroke: {
                curve: 'smooth'
            },
            yaxis: {
                labels: {
                    formatter: function(value) {
                        return new Intl.NumberFormat('vi-VN', {
                            style: 'currency',
                            currency: 'VND',
                            maximumFractionDigits: 0
                        }).format(value);
                    }
                }
            },
            tooltip: {
                y: {
                    formatter: function(value) {
                        return new Intl.NumberFormat('vi-VN', {
                            style: 'currency',
                            currency: 'VND',
                            maximumFractionDigits: 0
                        }).format(value);
                    }
                }
            }
        };

        var categoryOptions = {
            series: @json($categoryData -> pluck('count') -> toArray()),
            chart: {
                type: 'pie',
                height: 260 // Change this value to make the chart larger
            },
            labels: @json($categoryData -> pluck('category.name') -> toArray()),
            colors: ["#FF5733", "#33FF57", "#3357FF", "#FF33A1", "#FFC300", "#DAF7A6"], // Custom colors for the categories
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 100
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }],
            title: {
                align: 'center',
                style: {
                    fontSize: '18px',
                    fontWeight: 'bold',
                    color: '#333'
                }
            },
            tooltip: {
                y: {
                    formatter: function(value) {
                        return value + ' sản phẩm'; // Custom tooltip showing the product count
                    }
                },
                theme: 'dark' // Dark theme for tooltips
            },
            legend: {
                position: 'top',
                labels: {
                    colors: ['#333'], // Dark color for legend text
                    useSeriesColors: false
                }
            }
        };

        // Orders Count Chart
        var ordersOptions = {
            series: [{
                name: 'Đơn Hàng',
                data: @json($orderCountData -> pluck('daily_order_count') -> toArray()) // Số lượng đơn hàng theo ngày
            }],
            chart: {
                type: 'bar',
                height: 300
            },
            xaxis: {
                categories: @json($orderCountData -> pluck('date') -> toArray()) // Các ngày
            },
            title: {
                text: 'Số Lượng Đơn Hàng',
                align: 'center',
                style: {
                    fontSize: '18px',
                    fontWeight: 'bold',
                    color: '#333'
                }
            },
            yaxis: {
                title: {
                    text: 'Số Đơn Hàng'
                }
            },
            tooltip: {
                y: {
                    formatter: function(value) {
                        return value + ' đơn hàng'; // Hiển thị số lượng đơn hàng trong tooltip
                    }
                }
            },
            colors: ['#FF5733'], // Màu của các cột trong biểu đồ
            plotOptions: {
                bar: {
                    horizontal: false, // Cột đứng
                    endingShape: 'rounded' // Các đầu cột tròn
                }
            }
        };
        // Daily Orders Count Chart
        var dailyOrdersOptions = {
            series: [{
                name: 'Số Lượng Đơn Hàng',
                data: @json($dailyOrdersData -> pluck('order_count') -> toArray()) // Số lượng đơn hàng mỗi ngày
            }],
            chart: {
                type: 'line',
                height: 300
            },
            xaxis: {
                categories: @json($dailyOrdersData -> pluck('date') -> toArray()) // Các ngày
            },
            title: {
                text: 'Số Lượng Đơn Hàng Theo Ngày',
                align: 'center',
                style: {
                    fontSize: '18px',
                    fontWeight: 'bold',
                    color: '#333'
                }
            },
            yaxis: {
                title: {
                    text: 'Số Đơn Hàng'
                }
            },
            tooltip: {
                y: {
                    formatter: function(value) {
                        return value + ' đơn hàng'; // Hiển thị số lượng đơn hàng trong tooltip
                    }
                }
            },
            stroke: {
                curve: 'smooth' // Lượn sóng mượt mà
            }
        };
       
        // Khởi tạo biểu đồ khi tài liệu đã được tải xong
        document.addEventListener('DOMContentLoaded', function() {
            var dailyOrdersChart = new ApexCharts(document.querySelector("#dailyOrdersChart"), dailyOrdersOptions);
            dailyOrdersChart.render();
        });

        // Reinitialize charts when Livewire updates
        document.addEventListener('livewire:update', function() {
            var dailyOrdersChart = new ApexCharts(document.querySelector("#dailyOrdersChart"), dailyOrdersOptions);
            dailyOrdersChart.render();
        });


        // Khởi tạo biểu đồ khi tài liệu đã được tải xong
        document.addEventListener('DOMContentLoaded', function() {
            var ordersChart = new ApexCharts(document.querySelector("#ordersChart"), ordersOptions);
            ordersChart.render();
        });

        // Reinitialize charts when Livewire updates
        document.addEventListener('livewire:update', function() {
            var ordersChart = new ApexCharts(document.querySelector("#ordersChart"), ordersOptions);
            ordersChart.render();
        });


        // Khởi tạo biểu đồ khi tài liệu đã được tải xong
        document.addEventListener('DOMContentLoaded', function() {
            var ordersChart = new ApexCharts(document.querySelector("#ordersChart"), ordersOptions);
            ordersChart.render();
        });

        // Reinitialize charts when Livewire updates
        document.addEventListener('livewire:update', function() {
            var ordersChart = new ApexCharts(document.querySelector("#ordersChart"), ordersOptions);
            ordersChart.render();
        });


        // Initialize the category distribution chart
        document.addEventListener('DOMContentLoaded', function() {
            var categoryChart = new ApexCharts(document.querySelector("#categoryChart"), categoryOptions);
            categoryChart.render();
        });

        // Reinitialize charts when Livewire updates
        document.addEventListener('livewire:update', function() {
            var categoryChart = new ApexCharts(document.querySelector("#categoryChart"), categoryOptions);
            categoryChart.render();
        });
        // Initialize charts when document is ready
        document.addEventListener('DOMContentLoaded', function() {
            var revenueChart = new ApexCharts(document.querySelector("#revenueChart"), revenueOptions);
            var categoryChart = new ApexCharts(document.querySelector("#categoryChart"), categoryOptions);

            revenueChart.render();
            categoryChart.render();
        });

        // Reinitialize charts when Livewire updates
        document.addEventListener('livewire:update', function() {
            var revenueChart = new ApexCharts(document.querySelector("#revenueChart"), revenueOptions);
            var categoryChart = new ApexCharts(document.querySelector("#categoryChart"), categoryOptions);

            revenueChart.render();
            categoryChart.render();
        });
    </script>
    @endpush
</div>