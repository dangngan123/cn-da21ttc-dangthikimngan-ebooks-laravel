<div>
    <div class="card">
        <div class="card-header">
            <div class="shop-product-fillter mb-0">

                <!-- Tìm kiếm  -->
                <div class="sidebar-widget widget_search bg-1">
                    <div class="search-form">
                        <form action="#">
                            <input type="text" placeholder="Tìm kiếm…" wire:model.live="search">
                            <!-- <button type="submit"> <i class="fi-rs-search"></i> </button> -->
                        </form>
                    </div>
                </div>

                <!-- Lọc sản phẩm -->
                <div class="sort-by-product-area">
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
                                <li><a href="#" wire:click.prevent="selecteActive(1)"><i class="fi-rs-thumbs-up mr-5"></i>Bật</a></li>
                                <li><a href="#" wire:click.prevent="selecteInactive(0)"><i class="fi-rs-thumbs-down mr-5"></i>Tắt</a></li>
                                <li><a href="#" wire:click.prevent="export"><i class="fi-rs-download mr-5"></i>Export</a></li>

                            </ul>
                        </div>
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
                        <tr>
                            <!-- <th><input type="checkbox" wire:model.live="selectAll" class="small-checkbox"></th> -->
                            <th>STT</th>
                            <th><input type="checkbox" wire:model.live="selectAll" class="small-checkbox"></th>
                            <th>Mã khách hàng</th>
                            <th>Tên khách hàng</th>
                            <th>Đánh giá</th>
                            <th>Bình luận</th>
                            <th>Ngày đánh giá</th>
                            <th>Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reviews as $index => $review)
                        <tr class="text-center">
                            <!-- <td class="small-checkbox">
                                <input type="checkbox" wire:model.live="selectedItems" value="{{ $review->id }}">
                            </td> -->
                            <td>{{$index+$reviews->firstItem()}}</td>
                            <td class="small-checkbox">
                                <input type="checkbox" wire:model.live="selectedItems" value="{{ $review->id }}">
                            </td>
                            <td class="text-center">#{{$review->user->id}}</td>
                            <td>{{$review->user->name}}</td>
                            <td>{{$review->rating}}</td>
                            <td>{{$review->comment}}</td>
                            <td>{{$review->created_at}}</td>
                            <td>
                                <div class="dropdown">
                                    <button
                                        class="btn btn-secondary dropdown-toggle"
                                        type="button"
                                        id="dropdownMenuButton"
                                        data-bs-toggle="dropdown"
                                        aria-expanded="false"
                                        {{ in_array($review->status, ['rejected', 'approved']) ? 'disabled' : '' }}>
                                        @switch($review->status)
                                        @case('pending')
                                        Đang xử lý
                                        @break
                                        @case('approved')
                                        Đã xác nhận
                                        @break
                                        @case('rejected')
                                        Đã bị hủy
                                        @break
                                        @endswitch
                                    </button>

                                    @if (!in_array($review->status, ['rejected', 'approved']))
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <li>
                                            <a
                                                class="dropdown-item"
                                                href="#"
                                                wire:click.prevent="updateOrderStatus({{ $review->id }}, 'approved')">
                                                Đã xác nhận
                                            </a>
                                        </li>
                                        <li>
                                            <a
                                                class="dropdown-item"
                                                href="#"
                                                wire:click.prevent="updateOrderStatus({{ $review->id }}, 'rejected')">
                                                Đã bị hủy
                                            </a>
                                        </li>
                                    </ul>
                                    @endif
                                </div>
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $reviews->links() }}
            </div>
        </div>
    </div>
</div>