<div>
    <div class="card">
        <!-- Form thêm/chỉnh sửa danh mục -->
        <div wire:ignore.self class="modal fade" id="couponModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{$titleForm}}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click.prevent="resetForm"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="row">
                                <form class="contact-form-style mt-30 mb-50" action="#" method="post">

                                    <div class="col-lg-6">
                                        <div class="input-style mb-10">
                                            <label>Mã giảm</label>
                                            <input name="order-id" placeholder="Nhập tên mã giảm..." type="text" class="square" wire:model="coupon_code">
                                            @error('name') <span class="error text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <style>
                                            /* Phong cách tổng thể cho khung */
                                            .styled-select {

                                                padding: 10px;
                                                background-color: rgb(255, 255, 255);

                                            }

                                            /* Nhãn (label) */
                                            .styled-select label {
                                                font-size: 14px;
                                                margin-bottom: 5px;
                                                display: block;
                                            }

                                            /* Dropdown */
                                            .styled-select select {
                                                width: 100%;
                                                padding: 8px;
                                                border: 1px solid #ccc;
                                                border-radius: 4px;
                                                font-size: 14px;
                                                background-color: #fff;
                                                color: #333;
                                                appearance: none;
                                                /* Ẩn mũi tên mặc định */
                                                -webkit-appearance: none;
                                                /* Safari */
                                                -moz-appearance: none;
                                                /* Firefox */
                                            }

                                            /* Thêm biểu tượng mũi tên tùy chỉnh */
                                            .styled-select {
                                                position: relative;
                                            }

                                            .styled-select::after {
                                                content: "▼";
                                                position: absolute;
                                                right: 15px;
                                                top: 50%;
                                                transform: translateY(-50%);
                                                font-size: 12px;

                                                pointer-events: none;
                                            }

                                            /* Lỗi hiển thị */
                                            .styled-select .error {
                                                font-size: 12px;
                                                color: #e74c3c;
                                                margin-top: 5px;
                                            }
                                        </style>
                                        <div class="input-style mb-10 styled-select">
                                            <label for="coupon_type">Loại giảm</label>
                                            <select name="coupon_type" id="coupon_type" class="square form-control" wire:model="coupon_type">
                                                <option value="">Chọn loại giảm...</option>
                                                <option value="fixed">Cố định</option>
                                                <option value="percent">Phần trăm</option>
                                            </select>
                                            @error('coupon_type')
                                            <span class="error text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>



                                        <div class="input-style mb-10 ">
                                            <label>Giá trị giảm</label>
                                            <input name="order-id" placeholder="Nhập giá trị giảm..." type="text" class="square" wire:model="coupon_value">
                                            @error('slug') <span class="error text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="input-style mb-10 ">
                                            <label>Giá hóa đơn</label>
                                            <input name="order-id" placeholder="Nhập giá hóa đơn..." type="text" class="square" wire:model="cart_value">
                                            @error('slug') <span class="error text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="input-style mb-10 ">
                                            <label>Ngày kết thúc</label>
                                            <input name="order-id" placeholder="Nhập ngày kết thúc..." type="date" class="square" wire:model="end_date">
                                            @error('slug') <span class="error text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        @if($editForm)
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click.prevent="resetForm">Close</button>
                        <button type="button" class="btn btn-primary" wire:click.prevent="updateCoupon">Cập nhật mã giảm</button>
                        @else
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click.prevent="resetForm">Close</button>
                        <button type="button" class="btn btn-primary" wire:click.prevent="addCoupon">Thêm mã giảm</button>
                        @endif
                    </div>


                </div>
            </div>
        </div>
        <!-- kết thúc thêm/chỉnh sửa danh mục -->























        <div class="card-header">
            <!-- nút thêm danh mục -->
            <div>
                <a href="#" class="btn-sm btn-primary ml-3" wire:click.prevent="showCouponModal">Thêm mã giảm</a>
            </div>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Mã giảm</th>
                            <th>Loại giảm</th>
                            <th>Giá trị giảm</th>
                            <th>Giá hóa đơn</th>
                            <th>Ngày kết thúc</th>
                            <th colspan="2" class="text-center">Thao tác</th>

                        </tr>
                    </thead>
                    <tbody>
                        @forelse($coupons as $index => $coupon)
                        <tr wire:key="coupon-{{ $coupon->id }}">
                            <td>{{$index+$coupons->firstItem()}}</td>
                            <td>{{$coupon->coupon_code}}</td>
                            <td>
                                @if($coupon->coupon_type === 'fixed')
                                Cố định
                                @elseif($coupon->coupon_type === 'percent')
                                Phần trăm
                                @else
                                Không xác định
                                @endif
                            </td>
                            <td>{{$coupon->coupon_value}}</td>

                            <td>{{$coupon->cart_value}}</td>
                            <td>{{$coupon->end_date}}</td>
                            <td>
                                @if(!$coupon->is_used)
                                <button class=" btn-success btn-sm" wire:click="showEditCoupon({{ $coupon->id }})">
                                    Chỉnh sửa
                                </button>
                                <button class=" btn-danger btn-sm" wire:click="deleteConfirmation({{ $coupon->id }})">
                                    Xóa
                                </button>
                                @else
                                <span class="badge bg-danger text-light">
                                    <i class="fa fa-check"></i> Đã sử dụng
                                </span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center text-danger">Không có mã nào</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $coupons->links() }}
            </div>
        </div>
    </div>
</div>