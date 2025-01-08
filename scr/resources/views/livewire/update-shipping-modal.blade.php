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
                <button type="button" class="btn btn-primary" wire:click.prevent="updateShipping()">Cập Nhật Địa Chỉ</button>
            </div>
        </div>
    </div>
</div>