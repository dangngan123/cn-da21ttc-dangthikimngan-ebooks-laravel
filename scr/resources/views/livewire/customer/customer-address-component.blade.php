<div>
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
    <!-- Thêm địa chỉ giao hàng -->
    <div wire:ignore.self class="modal fade" id="addShipingModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Địa Chỉ Giao Hàng</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row">
                            <form class="contact-form-style mt-30 mb-50" action="#" method="post">

                                <div class="radio-inputs">
                                    <label>
                                        <input class="radio-input" type="radio" name="engine" value="Nhà riêng" wire:model="address_type">
                                        <span class="radio-tile">
                                            <span class="radio-icon">
                                                <img src="{{asset('/')}}assets/imgs/cart/home.png" alt="" style="width: 50px; ">
                                            </span>
                                            <span class="radio-label">Nhà Riêng</span>
                                        </span>
                                    </label>
                                    <label>
                                        <input class="radio-input" type="radio" name="engine" value="Văn phòng" wire:model="address_type">
                                        <span class="radio-tile">
                                            <span class="radio-icon">
                                                <img src="{{asset('/')}}assets/imgs/cart/home.png" alt="" style="width: 50px; ">
                                            </span>
                                            <span class="radio-label">Văn Phòng</span>
                                        </span>
                                    </label>
                                    <label>
                                        <input class="radio-input" type="radio" name="engine" value="Khác" wire:model="address_type">
                                        <span class="radio-tile">
                                            <span class="radio-icon">
                                                <img src="{{asset('/')}}assets/imgs/cart/home.png" alt="" style="width: 50px; ">
                                            </span>
                                            <span class="radio-label">Khác</span>
                                        </span>
                                    </label>
                                </div>
                                @error('address_type') <span class="error text-danger">{{ $message }}</span> @enderror
                                <div class="col-lg-6">

                                    <div class="input-style mb-10">
                                        <label>Họ và Tên</label>
                                        <input name="order-id" placeholder="Nhập họ tên của bạn" type="text" class="square" wire:model="name">
                                        @error('name') <span class="error text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <div class="input-style mb-10">
                                        <label>Số Điện Thoại</label>
                                        <input name="billing-phone" placeholder="Ví dụ: 07954055xxx (10 ký tự số)" type="tel" class="square"
                                            oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                            wire:model="phone">
                                        @error('phone') <span class="error text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="input-style mb-10">
                                        <label>Tỉnh/Thành Phố</label>
                                        <select name="" class="form-control" wire:model="province">
                                            <option value="">Chọn Tỉnh/Thành Phố</option>
                                            @foreach($provinces as $province)
                                            <option value="{{$province->name_with_type}}"> {{$province->name_with_type}}</option>
                                            @endforeach
                                        </select>
                                        @error('province') <span class="error text-danger">{{ $message }}</span> @enderror
                                    </div>




                                </div>
                                <div class="col-lg-6">

                                    <div class="input-style mb-10">
                                        <label>Quận/Huyện</label>
                                        <select name="" class="form-control" wire:model="district">
                                            <option value="">Chọn Quận/Huyện</option>
                                            @foreach($districts as $district)
                                            <option value="{{$district->name_with_type}}"> {{$district->name_with_type}}</option>
                                            @endforeach
                                        </select>
                                        @error('district') <span class="error text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="input-style mb-10">
                                        <label>Phường/Xã</label>
                                        <select name="" class="form-control" wire:model="ward">
                                            <option value="">Chọn Phường/Xã</option>
                                            @foreach($wards as $ward)
                                            <option value="{{$ward->name_with_type}}">{{$ward->name_with_type}}</option>
                                            @endforeach
                                        </select>
                                        @error('ward') <span class="error text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="input-style mb-10">
                                        <label>Địa Chỉ Nhận Hàng</label>
                                        <input name="billing-email" placeholder="Tên Đường, Tòa Nhà, Số Nhà" type="email" class="square" wire:model="address">
                                        @error('address') <span class="error text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <style>
                                        .checkbox-small {
                                            width: 20px;
                                            height: 20px;
                                            cursor: pointer;
                                        }

                                        .checkbox-label {
                                            margin-left: 10px;
                                            /* Khoảng cách giữa checkbox và nhãn */
                                        }
                                    </style>

                                    <div class="input-style mb-10 d-flex align-items-center">
                                        <input
                                            type="checkbox"
                                            id="status"
                                            class="square checkbox-small"
                                            wire:click="updateStatus($event.target.checked)"
                                            @if($status) checked @endif />
                                        <label for="status" class="checkbox-label">
                                            Đặt làm địa chỉ mặc định
                                        </label>

                                        @error('status')
                                        <span class="error text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>



                                </div>
                            </form>
                        </div>

                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" wire:click.prevent="addShipping()">Thêm Địa Chỉ Mới</button>
                </div>

            </div>
        </div>
    </div>
    <!-- Cập nhật địa chỉ giao hàng. -->
    <div wire:ignore.self class="modal fade" id="updateShipingModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Địa Chỉ Giao Hàng</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row">
                            <form class="contact-form-style mt-30 mb-50" action="#" method="post">

                                <div class="radio-inputs">
                                    <label>
                                        <input class="radio-input" type="radio" name="engine" value="Nhà riêng" wire:model="address_type">
                                        <span class="radio-tile">
                                            <span class="radio-icon">
                                                <img src="{{asset('/')}}assets/imgs/cart/home.png" alt="" style="width: 50px; ">
                                            </span>
                                            <span class="radio-label">Nhà Riêng</span>
                                        </span>
                                    </label>
                                    <label>
                                        <input class="radio-input" type="radio" name="engine" value="Văn phòng" wire:model="address_type">
                                        <span class="radio-tile">
                                            <span class="radio-icon">
                                                <img src="{{asset('/')}}assets/imgs/cart/home.png" alt="" style="width: 50px; ">
                                            </span>
                                            <span class="radio-label">Văn Phòng</span>
                                        </span>
                                    </label>
                                    <label>
                                        <input class="radio-input" type="radio" name="engine" value="Khác" wire:model="address_type">
                                        <span class="radio-tile">
                                            <span class="radio-icon">
                                                <img src="{{asset('/')}}assets/imgs/cart/home.png" alt="" style="width: 50px; ">
                                            </span>
                                            <span class="radio-label">Khác</span>
                                        </span>
                                    </label>
                                </div>
                                @error('address_type') <span class="error text-danger">{{ $message }}</span> @enderror
                                <div class="col-lg-6">

                                    <div class="input-style mb-10">
                                        <label>Họ và Tên</label>
                                        <input name="order-id" placeholder="Nhập họ tên của bạn" type="text" class="square" wire:model="name">
                                        @error('name') <span class="error text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <div class="input-style mb-10">
                                        <label>Số Điện Thoại</label>
                                        <input name="billing-email" placeholder="Nhập số điện thoại của bạn" type="number" class="square" oninput="this.value = this.value.replace(/[^0-9]/g, '')" wire:model="phone">
                                        @error('phone') <span class="error text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <div class="input-style mb-10">
                                        <label>Tỉnh/Thành Phố</label>
                                        <select name="" class="form-control" wire:model="province">
                                            <option value="">Chọn Tỉnh/Thành Phố</option>
                                            @foreach($provinces as $province)
                                            <option value="{{$province->name_with_type}}"> {{$province->name_with_type}}</option>
                                            @endforeach
                                        </select>
                                        @error('province') <span class="error text-danger">{{ $message }}</span> @enderror
                                    </div>

                                </div>
                                <div class="col-lg-6">


                                    <div class="input-style mb-10">
                                        <label>Quận/Huyện</label>
                                        <select name="" class="form-control" wire:model="district">
                                            <option value="">Chọn Quận/Huyện</option>
                                            @foreach($districts as $district)
                                            <option value="{{$district->name_with_type}}"> {{$district->name_with_type}}</option>
                                            @endforeach
                                        </select>
                                        @error('district') <span class="error text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="input-style mb-10">
                                        <label>Phường/Xã</label>
                                        <select name="" class="form-control" wire:model="ward">
                                            <option value="">Chọn Phường/Xã</option>
                                            @foreach($wards as $ward)
                                            <option value="{{$ward->name_with_type}}">{{$ward->name_with_type}}</option>
                                            @endforeach
                                        </select>
                                        @error('ward') <span class="error text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="input-style mb-10">
                                        <label>Địa Chỉ Nhận Hàng</label>
                                        <input name="billing-email" placeholder="" type="email" class="square" wire:model="address">
                                        @error('address') <span class="error text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="input-style mb-10 d-flex align-items-center">
                                        <input
                                            type="checkbox"
                                            id="status"
                                            class="square checkbox-small"
                                            wire:click="updateStatus($event.target.checked)"
                                            @if($status) checked @endif />
                                        <label for="status" class="checkbox-label">
                                            Đặt làm địa chỉ mặc định
                                        </label>

                                        @error('status')
                                        <span class="error text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>


                                </div>
                            </form>
                        </div>

                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" wire:click.prevent="updateShipping()">Cập Nhật Địa Chỉ</button>
                </div>
            </div>
        </div>
    </div>
    <from action="" wire:submit.prevent="placeOrder">
        <div class="row">
            <div class="col-md-6">
                <div class="mb-25 d-flex justify-content-between aligns-items-center">
                    <div style="text-align: left;">
                        <button class="btn btn btn-sm" style="margin-left: 0;" wire:click.prevent="showShipingModal()">Thêm Địa Chỉ Mới</button>
                    </div>

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

                </div>
                <div class="row">
                    <div class="col-lg-12 mb-sm-15">
                        @foreach($shippings as $shipping)
                        <div class="toggle_info mb-5 p-3" style="border: 1px solid #ddd; border-radius: 8px; background: #f9f9f9; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1); min-height: 250px;">
                            <div class="row d-flex align-items-center">
                                <!-- Left Column: Radio and Image -->
                                <div class="col-6 col-md-4">
                                    <div class="radio-inputs" style="cursor: pointer;" wire:click="applyShippingCharge('{{$shipping->province}}')">
                                        <label>
                                            <input class="radio-input" type="radio" name="engine" value="{{$shipping->address_type}}">
                                            <span class="radio-tile d-flex align-items-center" style="padding: 10px; border: 1px solid #ccc; border-radius: 8px; background: #fff; transition: all 0.3s;">
                                                <span class="radio-icon">
                                                    <img src="{{asset('/')}}assets/imgs/cart/home.png" alt="" style="width: 50px;">
                                                </span>
                                                <span class="radio-label" style="margin-left: 10px; font-size: 16px; font-weight: bold;">
                                                    {{ucwords($shipping->address_type)}}
                                                </span>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                                <!-- Middle Column: Details -->
                                <div class="col-6 col-md-4">
                                    @if($shipping->status == 1)
                                    <p style="font-size: 14px; background-color:rgb(12, 227, 12); color: #333; padding: 5px 10px; border-radius: 15px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); display: inline-block;">
                                        Mặc định
                                    </p>
                                    @endif
                                    <p style="font-size: 14px; margin: 5px 0;">Tên: <strong>{{$shipping->name}}</strong></p>
                                    <p style="font-size: 14px; margin: 5px 0;">Phone: <strong>{{$shipping->phone}}</strong></p>
                                    <p style="font-size: 14px; margin: 5px 0;">Địa Chỉ: <strong>{{$shipping->province}}, {{$shipping->district}}, {{$shipping->ward}}</strong></p>
                                    <p style="font-size: 14px; margin: 5px 0;">Tên Đường, Tòa Nhà, Số Nhà: <strong>{{$shipping->address}}</strong></p>
                                </div>
                                <!-- Right Column: Actions -->
                                <div class="col-6 col-md-4 text-center">
                                    <a href="#" wire:click.prevent="deleteConfirmation({{$shipping->id}})" style="color: #d9534f; font-size: 18px; margin-right: 10px;">
                                        <i class="fi-rs-trash"></i>
                                    </a>
                                    <a href="#" wire:click.prevent="ShowUpdateShippingInfo({{$shipping->id}})" style="color: #5bc0de; font-size: 18px;">
                                        <i class="fi-rs-pencil"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <style>
                    .radio-inputs .radio-tile:hover {
                        border-color: #5bc0de;
                        box-shadow: 0 2px 8px rgba(0, 123, 255, 0.2);
                    }

                    .toggle_info {
                        transition: background-color 0.3s, height 0.3s;
                    }

                    .toggle_info:hover {
                        background-color: #f1f1f1;
                    }
                </style>





            </div>
    </from>
</div>