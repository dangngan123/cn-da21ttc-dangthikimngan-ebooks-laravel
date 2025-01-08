<div>

    <div class="card">
        <div class="card-header">
            <div class="shop-product-fillter mb-0">
                <div class="totall-product">
                    <div class="sidebar-widget widget_search bg-1">
                        <div class="search-form">
                            <form action="#">
                                <input type="text" placeholder="Search…" wire:model.live="search">
                                <!-- <button type="submit"> <i class="fi-rs-search"></i> </button> -->
                            </form>
                        </div>
                    </div>
                </div>
                <div class="sort-by-product-area align-items-center">

                    <div class="sort-by-cover mr-10">
                        <div class="sort-by-product-wrap bg-3">
                            <div class="sort-by">
                                <span><i class="fi-rs-apps"></i>Đã chọn:</span>
                            </div>
                            <div class="sort-by-dropdown-wrap">
                                <span> {{count($selectedItems)}} <i class="fi-rs-angle-small-down"></i></span>
                            </div>
                        </div>
                        <div class="sort-by-dropdown">
                            <ul class="menu">
                                <li><a href="#" wire:click.prevent="selecteDelete"><i class="fi-rs-trash"></i> Xóa</a></li>
                                <!-- <li><a href="#" wire:click.prevent="selecteActive(1)"><i class="fi-rs-thumbs-up mr-5"></i>Bật</a></li>
                                <li><a href="#" wire:click.prevent="selecteInactive(0)"><i class="fi-rs-thumbs-down mr-5"></i>Tắt</a></li> -->
                                <li><a href="#" wire:click.prevent="export"><i class="fi-rs-download mr-5"></i>Export</a></li>

                            </ul>
                        </div>
                    </div>

                    <div class="d-flex align-items-center">
                        <label class="me-3" style="font-size: 14px; line-height: 1.5;">
                            <!-- Thêm icon vào trong khung -->
                            <div style="position: relative;">
                                <select class="form-control" wire:model.live="statusFilter" style="border-radius: 5px; background-color: #f1f1f1; color: #333; font-size: 14px; padding-left: 30px;">
                                    <option value="">Tất cả</option>
                                    <option value="processing">Đang xử lý</option>
                                    <option value="shipped">Đã vận chuyểnchuyển</option>
                                    <option value="delivered">Đã giao hàng</option>
                                    <option value="cancelled">Đã bị hủy</option>
                                </select>
                                <!-- Đặt icon vào vị trí tuyệt đối bên trong -->
                                <i class="fa-solid fa-filter" style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%); font-size: 18px; color: #007bff;"></i>
                            </div>
                        </label>
                    </div>













                    <div class="sort-by-cover">
                        <div class="sort-by-product-wrap bg-3">
                            <div class="sort-by">
                                <span><i class="fi-rs-apps-sort"></i>Hiển thị:</span>
                            </div>
                            <div class="sort-by-dropdown-wrap">
                                <span> {{$pagesize}} <i class="fi-rs-angle-small-down"></i></span>
                            </div>
                        </div>
                        <div class="sort-by-dropdown">
                            <ul>
                                <li><a class="{{ $pagesize == 12 ? 'active' : '' }}" href="#" wire:click.prevent="changepageSize(12)">12</a></li>
                                <li><a class="{{ $pagesize == 24 ? 'active' : '' }}" href="#" wire:click.prevent="changepageSize(24)">24</a></li>
                                <li><a class="{{ $pagesize == 36 ? 'active' : '' }}" href="#" wire:click.prevent="changepageSize(36)">36</a></li>
                                <li><a class="{{ $pagesize == 48 ? 'active' : '' }}" href="#" wire:click.prevent="changepageSize(48)">48</a></li>
                                <li><a class="{{ $pagesize == 50 ? 'active' : '' }}" href="#" wire:click.prevent="changepageSize(50)">50</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr class="text-center">
                            <th><input type="checkbox" wire:model.live="selectAll" class="small-checkbox"></th>
                            <th>STT</th>
                            <th>Mã đơn hàng</th>
                            <th>Tên</th>
                            <!-- <th>Email</th> -->
                            <th>Phone</th>
                            <th>Địa chỉ</th>
                            <th style="color:  #F15412;">Tổng số tiền</th>
                            <th>Ngày đặt hàng</th>
                            <th colspan="2" class="text-center">Trạng thái</th>



                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $index=> $order)
                        <tr class="{{$this->isColor($order->id)}} text-center">
                            <td class="small-checkbox">
                                <input type="checkbox" wire:model.live="selectedItems" value="{{ $order->id }}">
                            </td>
                            <td>{{$index+$orders->firstItem()}}</td>
                            <td>#{{$order->id}}</td>
                            <td>{{$order->name}}</td>
                            <!-- <td>{{$order->email}}</td> -->
                            <td>{{$order->phone}}</td>

                            <td>{{$order->province}}, {{$order->district}}, {{$order->ward}}</td>
                            <td style="color:  #F15412;">{{$order->total}}đ</td>
                            <!-- <td>{{$order->additional_info }}</td> -->
                            <td>{{$order->created_at}}</td>

                            <style>
                                /* Make the button and text inside the button smaller */
                                .dropdown .btn.btn-secondary {
                                    font-size: 10px;
                                    /* Adjust the font size */
                                    padding: 4px 8px;
                                    /* Adjust padding to make the button smaller */
                                }

                                /* Make the dropdown items' text smaller */
                                .dropdown-menu .dropdown-item {
                                    font-size: 10px;
                                    /* Adjust the font size of the dropdown items */
                                }
                            </style>

                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false" {{ in_array($order->status, ['canceled', 'delivered']) ? 'disabled' : '' }}>
                                        @switch($order->status)
                                        @case('processing')
                                        Đang xử lý
                                        @break
                                        @case('shipped')
                                        Đang vận chuyển
                                        @break
                                        @case('delivered')
                                        Đã giao hàng
                                        @break
                                        @case('canceled')
                                        Đã bị hủy
                                        @break
                                        @default
                                        Đã đặt hàng
                                        @endswitch
                                    </button>
                                    @if (!in_array($order->status, ['canceled', 'delivered']))
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <li><a class="dropdown-item" href="#" wire:click.prevent="updateOrderStatus({{ $order->id }}, 'processing')">Đang xử lý</a></li>
                                        <li><a class="dropdown-item" href="#" wire:click.prevent="updateOrderStatus({{ $order->id }}, 'shipped')">Đã vận chuyển</a></li>
                                        <li><a class="dropdown-item" href="#" wire:click.prevent="updateOrderStatus({{ $order->id }}, 'delivered')">Đã giao hàng</a></li>
                                        <li><a class="dropdown-item" href="#" wire:click.prevent="updateOrderStatus({{ $order->id }}, 'canceled')">Đã bị hủy</a></li>
                                    </ul>

                                    @endif
                                </div>
                            </td>
                            <td>
                                <a href="{{ route('admin.orderdetails', ['order_id' => $order->id]) }}" style="font-size: 12px; white-space: nowrap;  color:rgb(177, 6, 6);">Chi tiết
                                </a>
                            </td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="12" class="text-center text-danger">Không có đơn hàng nào</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $orders->links() }}
            </div>
        </div>
    </div>
</div>