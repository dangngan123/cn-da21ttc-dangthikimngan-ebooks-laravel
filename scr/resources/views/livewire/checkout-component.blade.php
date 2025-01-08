<div>
    @include('livewire.app-shipping-modal')
    @include('livewire.update-shipping-modal')
    <style>
        .radio-inputs {
            display: flex;
            justify-content: center;
            align-items: center;
            /* max-width: 350px; */
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        .radio-inputs>* {
            margin: 6px;
        }

        .radio-input:checked+.radio-tile {
            border-color: #2260ff;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
            color: #2260ff;
        }

        .radio-input:checked+.radio-tile:before {
            transform: scale(1);
            opacity: 1;
            background-color: #2260ff;
            border-color: #2260ff;
        }

        .radio-input:checked+.radio-tile .radio-icon svg {
            fill: #2260ff;
        }

        .radio-input:checked+.radio-tile .radio-label {
            color: #2260ff;
        }

        .radio-input:focus+.radio-tile {
            border-color: #2260ff;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1), 0 0 0 4px #b5c9fc;
        }

        .radio-input:focus+.radio-tile:before {
            transform: scale(1);
            opacity: 1;
        }

        .radio-tile {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 80px;
            min-height: 80px;
            border-radius: 0.5rem;
            border: 2px solid #b5bfd9;
            background-color: #fff;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
            transition: 0.15s ease;
            cursor: pointer;
            position: relative;
        }

        .radio-tile:before {
            content: "";
            position: absolute;
            display: block;
            width: 0.75rem;
            height: 0.75rem;
            border: 2px solid #b5bfd9;
            background-color: #fff;
            border-radius: 50%;
            top: 0.25rem;
            left: 0.25rem;
            opacity: 0;
            transform: scale(0);
            transition: 0.25s ease;
        }

        .radio-tile:hover {
            border-color: #2260ff;
        }

        .radio-tile:hover:before {
            transform: scale(1);
            opacity: 1;
        }

        .radio-icon svg {
            width: 2rem;
            height: 2rem;
            fill: #494949;
        }

        .radio-label {
            color: #707070;
            transition: 0.375s ease;
            text-align: center;
            font-size: 13px;
        }

        .radio-input {
            clip: rect(0 0 0 0);
            -webkit-clip-path: inset(100%);
            clip-path: inset(100%);
            height: 1px;
            overflow: hidden;
            position: absolute;
            white-space: nowrap;
            width: 1px;
        }
    </style>

    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('home') }}" rel="nofollow">Trang chủ</a>
                    <span></span><a href="{{ route('shop') }}" rel="nofollow">Sản phẩm</a>
                    <span></span>Thanh toán
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">

                <from action="" wire:submit.prevent="placeOrder">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-25 d-flex justify-content-between aligns-items-center">
                                <h4>Chi Tiết Vận Chuyển</h4>
                                <style>
                                    .custom-btn {
                                        background-color: #F15412;
                                        /* Màu nền */
                                        color: white;
                                        /* Màu chữ */
                                        border: none;
                                        /* Bỏ viền nút */
                                        padding: 10px 20px;
                                        /* Khoảng cách bên trong nút */
                                        text-align: center;
                                        /* Canh giữa chữ trong nút */
                                        font-size: 14px;
                                        /* Kích thước chữ */
                                        border-radius: 5px;
                                        /* Góc bo tròn */
                                        transition: background-color 0.3s ease;
                                        /* Hiệu ứng chuyển màu khi hover */
                                    }

                                    .custom-btn:hover {
                                        background-color: #F15412;
                                        /* Màu nền khi hover */
                                    }
                                </style>
                                <button class="btn btn btn-sm" wire:click.prevent="showShipingModal()">Thêm Địa Chỉ Mới</button>










                            </div>
                            <div class="row">
                                <div class="col-lg-12 mb-sm-15">

                                    @foreach($shippings as $shipping)
                                    <div class="toggle_info mb-5">
                                        <div class="row d-flex align-items-center">
                                            <div class="col-6 col-md-4">
                                                <div class="radio-inputs" wire:click="applyShippingCharge('{{$shipping->province}}')">
                                                    <label>
                                                        <input class="radio-input" type="radio" name="engine" value="{{$shipping->address_type}}" wire:model="address_type">
                                                        <span class="radio-tile">
                                                            <span class="radio-icon">
                                                                <img src="{{asset('/')}}assets/imgs/cart/home.png" alt="" style="width: 50px; ">
                                                            </span>
                                                            <span class="radio-label">{{ucwords($shipping->address_type)}}</span>
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-4">
                                                @if($shipping->status == 1)
                                                <p style="font-size: 14px; background-color:rgb(12, 227, 12); color: #333; padding: 5px 10px; border-radius: 15px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); display: inline-block;">
                                                    Mặc định
                                                </p>
                                                @endif

                                                <p style="font-size: 14px;">Tên: {{$shipping->name}}</p>
                                                <p style="font-size: 14px;">Phone: {{$shipping->phone}}</p>
                                                <p style="font-size: 14px;">Địa Chỉ: {{$shipping->province}},{{$shipping->district}},{{$shipping->ward}}</p>
                                                <p style="font-size: 14px;">Tên Đường, Tòa Nhà, Số Nhà: {{$shipping->address}}</p>
                                            </div>
                                            <div class="col-6 col-md-4 text-center">
                                                <a href="#" wire:click.prevent="deleteConfirmation({{$shipping->id}})"><i class="fi-rs-trash mr-10"></i> </a>
                                                <a href="#" wire:click.prevent="ShowUpdateShippingInfo({{$shipping->id}})"><i class="fi-rs-pencil mr-10"></i></a>



                                            </div>
                                        </div>
                                    </div>
                                    @endforeach

                                </div>

                            </div>

                            <form method="post">


                                <div class="mb-10">
                                    <h5 style=" margin-top: 10px; font-size: 18px; margin-bottom: 10px;">Thông Tin Khác</h5>
                                </div>
                                <div class="form-group mb-30">
                                    <textarea rows="5" placeholder="Ghi chú" wire:model="additional_info"></textarea>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <div class="order_review">
                                <div class="mb-20">
                                    <h4>Đơn Đặt Hàng Của Bạn</h4>
                                </div>
                                <div class="table-responsive order_table text-center">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th colspan="2">Kiểm Tra Lại Đơn Hàng</th>
                                                <th>Giá</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach(Cart::instance('cart')->content() as $item)
                                            <tr>
                                                <td class="image product-thumbnail"><img src="{{ asset('admin/product/'.$item->model->image) }}" alt="#"></td>
                                                <td>
                                                    <h5><a href="product-details.html">{{ $item->model->name}}</a> <span class="product-qty"> x {{$item->qty}}</span></h5>
                                                </td>
                                                <td>{{$item->model->sale_price}}đ</td>
                                            </tr>
                                            @endforeach

                                            @if(Session::has('coupon'))
                                            <tr>
                                                <th> Tổng Giỏ Hàng</th>
                                                <td class="product-subtotal" colspan="2">{{Cart::instance('cart')->subtotal()}}đ</td>
                                            </tr>
                                            <tr>
                                                <th>Mã ({{session()->get('coupon')['coupon_code']}}) Giảm Giá</th>
                                                <td class="product-subtotal" colspan="2">- {{number_format($discount,2)}}đ</td>
                                            </tr>
                                            <tr></tr>

                                            @if($shippingCost)
                                            <tr>
                                                <th>Phí Vận Chuyển</th>
                                                <td colspan="2"><em>{{number_format($shippingCost,2)}}đ</em></td>
                                            </tr>
                                            @endif
                                            <tr>
                                                <th>Tổng Thanh Toán</th>
                                                <td colspan="2" class="product-subtotal"><span class="font-xl text-brand fw-900">{{number_format($subtotalAfterDiscount+$shippingCost,2)}}đ</span></td>
                                            </tr>

                                            @else
                                            <tr>
                                                <th>Tổng Giỏ Hàng</th>
                                                <td class="product-subtotal" colspan="2">{{Cart::instance('cart')->subtotal()}}đ</td>
                                            </tr>

                                            @if($shippingCost)
                                            <tr>
                                                <th>Phí Vận Chuyển</th>
                                                <td colspan="2"><em>{{number_format($shippingCost,2)}}đ</em></td>
                                            </tr>
                                            @endif
                                            <tr>
                                                <th>Tổng Thanh Toán</th>
                                                <td colspan="2" class="product-subtotal"><span class="font-xl text-brand fw-900">{{Cart::instance('cart')->total()}}đ</span></td>
                                            </tr>

                                            @endif



                                        </tbody>
                                    </table>
                                </div>
                                <div class="bt-1 border-color-1 mt-30 mb-30"></div>
                                <div class="payment_method">
                                    <div class="mb-25">
                                        <h5>Phương Thức Thanh Toán</h5>
                                    </div>
                                    <style>
                                        .icheck-material-teal {
                                            display: flex;
                                            /* Sử dụng flex để căn chỉnh hình ảnh và văn bản */
                                            align-items: center;
                                            /* Căn chỉnh các phần tử theo chiều dọc */
                                            gap: 10px;
                                            /* Khoảng cách giữa hình ảnh và văn bản */
                                        }

                                        .icheck-material-teal img {
                                            width: 30px;
                                            /* Kích thước hình ảnh bằng với kích thước chữ */
                                            height: auto;
                                            /* Đảm bảo tỷ lệ hình ảnh được giữ nguyên */
                                            vertical-align: middle;
                                            /* Căn giữa hình ảnh với chữ */
                                        }

                                        .icheck-material-teal input[type="radio"] {
                                            margin: 0;

                                            /* Loại bỏ margin mặc định của input */
                                        }
                                    </style>
                                    <div class="payment_option">
                                        <div class="icheck-material-teal">
                                            <input type="radio" id="someRadioId2" name="someGroupName" value="COD" wire:model="paymentmode" />
                                            <label for="someRadioId2"><img src="{{asset('/')}}assets/imgs/payment/thanhtoantienmat.svg" alt="Thanh Toán Tiền Mặt"> Thanh Toán Tiền Mặt Khi Nhận Hàng</label>
                                        </div>
                                        <div class="icheck-material-teal">
                                            <input type="radio" id="someRadioId1" name="someGroupName" value="MoMo" wire:model="paymentmode" />
                                            <label for="someRadioId1"><img src="{{asset('/')}}assets/imgs/payment/Thanhtoanmomo.svg" alt="Ví MoMo"> Ví MoMo</label>
                                        </div>

                                        @error('paymentmode') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="order_button pt-25">
                                    <button type="submit" class="btn btn-fill-out btn-dark btn-block mt-30 w-100" wire:click.prevent="placeOrder">XÁC NHẬN ĐẶT HÀNG</button>
                                </div>
                            </div>
                </from>
            </div>

</div>

</div>
</div>
</section>
</main>
</div>