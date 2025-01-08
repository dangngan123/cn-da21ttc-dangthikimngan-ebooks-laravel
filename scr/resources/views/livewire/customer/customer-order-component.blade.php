<div>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }

        .status-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 16px;
            font-size: 14px;
        }

        .carrier {
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .battery {
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 16px;
        }

        .back-button {
            border: none;
            background: none;
            padding: 8px;
            cursor: pointer;
        }

        .title {
            font-size: 20px;
            font-weight: 500;
        }

        .help-button {
            color: #0066cc;
            border: none;
            background: none;
            cursor: pointer;
        }

        .nav-icons {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            padding: 16px 24px;
            gap: 16px;
        }

        .nav-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 4px;
            position: relative;
        }

        .nav-icon {
            padding: 8px;
        }

        .nav-text {
            font-size: 14px;
        }

        .badge {
            position: absolute;
            top: -4px;
            right: -4px;
            background: #ff4444;
            color: white;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
        }

        .review-card {
            margin: 16px;
            padding: 16px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .review-title {
            font-size: 18px;
            font-weight: 500;
            margin-bottom: 16px;
        }

        .review-content {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .product-image {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 4px;
        }

        .product-info {
            flex: 1;
        }

        .product-name {
            font-weight: 500;
            margin-bottom: 4px;
        }

        .product-description {
            color: #666;
            font-size: 14px;
        }

        .review-button {
            background: #ff4444;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 14px;
            cursor: pointer;
        }

        .order-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-bottom: 15px;
            padding: 10px;
            background: #fff;
            /* Đảm bảo có nền trắng */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            /* Tạo hiệu ứng bóng mềm */
            overflow: hidden;
            /* Đảm bảo nội dung không tràn ra */
        }

        .order-card h5 {
            margin-bottom: 10px;
            font-weight: bold;
            color: #333;
        }

        img {
            max-width: 100%;
            height: auto;
            border-radius: 4px;
        }

        .btn-danger {
            font-size: 12px;
            padding: 5px 8px;
        }

        .btn-custom-small {
            font-size: 12px;
            /* Adjust font size */
            padding: 5px 10px;
            /* Adjust padding */
        }

        .btn.btn-sm {
            padding: 0.5rem 0.5rem;
            white-space: nowrap;
            font-size: 9px;
            background-color: #dc3545;
            border-color: #dc3545;
            color: white;
        }

        .btn-sm:hover {
            background-color: #bb2d3b;
            border-color: #b02a37;
        }

        #noOrdersMessage {
            display: none;
            text-align: center;
            padding: 50px 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100%;
            /* hoặc một giá trị tùy chỉnh */
        }

        .row {
            --bs-gutter-x: 0 !important;
        }

        .badge {
            position: absolute;
            top: -5px;
            right: -10px;
            background: #ff4444;
            color: white;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            font-size: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        .nav-icon {
            position: relative;
        }

        .gap-2 {
            gap: 8px;
            /* khoảng cách giữa các nút */
        }
    </style>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.html" rel="nofollow">Trang chủ</a>
                    <span></span> Sản phẩm
                    <span></span> Đơn hàng của bạn
                </div>
            </div>
        </div>

        <div class="page-content">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="header">
                            <div>Đơn hàng của bạn</div>
                            <!-- <button class="help-button">Trợ giúp</button> -->
                        </div>
                    </div>
                </div>

                <div class="nav-icons">
                    <div class="nav-item" data-status="all">
                        <div class="nav-icon">
                            <i class="bi bi-collection"></i>
                            <span class="badge" id="badge-all">0</span>
                        </div>
                        <div class="nav-text">Tất cả</div>
                    </div>
                    <div class="nav-item" data-status="processing">
                        <div class="nav-icon">
                            <i class="bi bi-hourglass-split"></i>
                            <span class="badge" id="badge-processing">0</span>
                        </div>
                        <div class="nav-text">Đang xử lý</div>
                    </div>
                    <div class="nav-item" data-status="shipped">
                        <div class="nav-icon">
                            <i class="bi bi-truck"></i>
                            <span class="badge" id="badge-shipped">0</span>
                        </div>
                        <div class="nav-text">Đang vận chuyển</div>
                    </div>
                    <div class="nav-item" data-status="delivered">
                        <div class="nav-icon">
                            <i class="bi bi-check-circle"></i>
                            <span class="badge" id="badge-delivered">0</span>
                        </div>
                        <div class="nav-text">Đã giao hàng</div>
                    </div>
                    <div class="nav-item" data-status="canceled">
                        <div class="nav-icon">
                            <i class="bi bi-x-circle"></i>
                            <span class="badge" id="badge-canceled">0</span>
                        </div>
                        <div class="nav-text">Đã bị hủy</div>
                    </div>
                </div>


                <section class="mt-50 mb-50">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="orders-list" id="ordersList">
                                    <div id="noOrdersMessage" style="display: none; text-align: center; padding: 50px 0;">
                                        <p>Bạn chưa có đơn hàng nào.</p>
                                        <img src="{{asset('assets/imgs/cart/ico_emptycart.svg')}}" alt="" width="150px">
                                    </div>

                                    @foreach($orderItems->groupBy('order_id') as $orderId => $items)
                                    <div class="order-card border rounded mb-3 p-3" data-status="{{ $items[0]->order->status }}">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h5>
                                                <a href="{{ url('/') }}" class="ml-2"><i class="fa fa-home"></i> Panda.com</a>
                                            </h5>

                                            <span class="text-muted">
                                                @php
                                                $status = $items[0]->order->status;
                                                @endphp

                                                @if($status == 'delivered')
                                                <span class="text-success">Đã giao hàng</span>
                                                @elseif($status == 'processing')
                                                <span class="text-warning">Đang xử lý</span>
                                                @elseif($status == 'shipped')
                                                <span class="text-primary">Đang vận chuyển</span>
                                                @elseif($status == 'canceled')
                                                <span class="text-danger">Đã bị hủy</span>
                                                @else
                                                <span class="text-warning">Đang xử lý</span>
                                                @endif
                                            </span>


                                        </div>

                                        @foreach($items as $ordersItem)
                                        <div class="row align-items-center mb-2">
                                            <div class="col-2">
                                                <img src="{{ asset('admin/product/'.$ordersItem->product->image) }}" alt="Product Image" class="img-fluid" style="width: 50px; height: auto;">
                                            </div>
                                            <div class="col-6">
                                                <h6><a href="{{ route('customer.orderdetails', $ordersItem->order->id) }}" style="color: black; text-decoration: none;">{{ $ordersItem->product->name }}</a></h6>


                                                <p class="text-muted font-xs">{{ $ordersItem->product->author }}</p>
                                            </div>
                                            <div class="col-2 text-center">
                                                <p>x{{$ordersItem->quantity}}</p>
                                            </div>
                                            <div class="col-2 text-end">
                                                <p> <span style="text-decoration: line-through; margin-right: 5px;">
                                                        {{($ordersItem->product->reguler_price) }}₫
                                                    </span>
                                                    {{ $ordersItem->price}}₫
                                                </p>
                                            </div>
                                        </div>

                                        <!-- Đưa các nút Đánh giá và Mua lại về gốc phải -->
                                        @if($ordersItem->order->status === 'delivered')
                                        @php
                                        // Kiểm tra xem đã có đánh giá cho sản phẩm này chưa
                                        $reviewed = \App\Models\Review::where('order_item_id', $ordersItem->id)->exists();
                                        @endphp

                                        <div class="text-end d-flex justify-content-end align-items-center gap-2">
                                            @if (!$reviewed)
                                            <a href="{{ route('customer.review', $ordersItem->id) }}" class="btn btn-sm btn-danger">Đánh giá</a>
                                            @else
                                            <button class="btn btn-sm btn-secondary" disabled>Đã đánh giá</button>
                                            @endif

                                            <a href="{{ route('details', $ordersItem->product->slug) }}" class="btn btn-sm" style="background-color: white; color: black; border: 1px solid black;">Mua lại</a>
                                        </div>
                                        @elseif($ordersItem->order->status === 'order')
                                        <button type="button" class="btn btn-sm btn-danger" wire:click.prevent="cancelOrder({{ $ordersItem->order->id }})">Hủy đơn hàng</button>
                                        @endif
                                        @endforeach

                                        <div class="cart-action text-end mt-3">
                                            <a class="btn btn-custom-small">

                                                Tổng số tiền ( {{ count($items) }} sản phẩm): {{($items[0]->order->total ) }}₫
                                            </a>
                                        </div>

                                        <br>
                                    </div>
                                    @endforeach



                                </div>
                            </div>
                        </div>
                    </div>
            </div>

            </section>

        </div>
</div>
</main>

<!-- JavaScript for Tab Navigation -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tabs = document.querySelectorAll('.nav-item');
        const orders = document.querySelectorAll('.order-card');
        const noOrdersMessage = document.getElementById('noOrdersMessage');

        tabs.forEach(tab => {
            tab.addEventListener('click', function() {
                const status = tab.getAttribute('data-status');

                // Remove active class from all tabs
                tabs.forEach(item => item.classList.remove('active'));
                // Add active class to the clicked tab
                tab.classList.add('active');

                // Show or hide orders based on the selected tab
                let visibleOrders = 0;
                orders.forEach(order => {
                    if (status === 'all' || order.getAttribute('data-status') === status) {
                        order.style.display = 'block';
                        visibleOrders++;
                    } else {
                        order.style.display = 'none';
                    }
                });

                // Show or hide the "No Orders" message
                if (visibleOrders === 0) {
                    noOrdersMessage.style.display = 'block';
                } else {
                    noOrdersMessage.style.display = 'none';
                }
            });
        });
    });
    document.addEventListener('DOMContentLoaded', function() {
        const orders = document.querySelectorAll('.order-card');
        const badges = {
            all: document.getElementById('badge-all'),
            processing: document.getElementById('badge-processing'),
            shipped: document.getElementById('badge-shipped'),
            delivered: document.getElementById('badge-delivered'),
            canceled: document.getElementById('badge-canceled'),
        };

        // Đếm số lượng đơn hàng theo trạng thái
        const orderCounts = {
            all: orders.length,
            processing: 0,
            shipped: 0,
            delivered: 0,
            canceled: 0,
        };

        orders.forEach(order => {
            const status = order.getAttribute('data-status');
            if (orderCounts[status] !== undefined) {
                orderCounts[status]++;
            }
        });

        // Cập nhật badge
        for (const [status, count] of Object.entries(orderCounts)) {
            if (badges[status]) {
                badges[status].textContent = count;
            }
        }
    });
</script>