<div>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('home') }}" rel="nofollow">Trang chủ</a>
                    <span></span> <a href="{{ route('shop') }}" rel="nofollow">Sản phẩm</a>
                    <span></span> Giỏ hàng
                </div>
            </div>
        </div>
        <section class="mt-10 mb-10">
            <div class="container">
                @if(Cart::instance('cart')->count()>0)
                <div class="row">
                    <div class="col-7">
                        <div class="table-responsive">
                            <table class="table shopping-summery text-center clean">
                                <thead>
                                    <tr class="main-heading">
                                        <th scope="col">Ảnh</th>
                                        <th scope="col">Tên</th>
                                        <th scope="col">Giá</th>
                                        <th scope="col">Số Lượng</th>
                                        <th scope="col">Thành Tiền</th>
                                        <th scope="col">Xóa</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach(Cart::instance('cart')->content() as $item)
                                    <tr>

                                        <td class="image product-thumbnail"><img src="{{ asset('admin/product/'.$item->model->image) }}" alt="#"></td>
                                        <td class="product-des product-name">
                                            <h5 class="product-name"><a href="product-details.html">{{ $item->model->name}}</a></h5>

                                            </p>
                                        </td>
                                        <td class="price" data-title="Price"><span>{{ $item->model->sale_price }}đ</span></td>

                                        <style>
                                            .quantity-field {
                                                display: flex;
                                                justify-content: center;
                                                align-items: center;
                                                width: 120px;
                                                height: 40px;
                                                margin: 0 auto;
                                            }

                                            .quantity-field .value-button {
                                                border: 1px solid #ddd;
                                                margin: 0px;
                                                width: 40px;
                                                height: 100%;
                                                padding: 0;
                                                background: #eee;
                                                outline: none;
                                                cursor: pointer;
                                            }

                                            .quantity-field .value-button:hover {
                                                background: rgb(230, 230, 230);
                                            }

                                            .quantity-field .value-button:active {
                                                background: rgb(210, 210, 210);
                                            }

                                            .quantity-field .decrease-button {
                                                margin-right: -4px;
                                                border-radius: 8px 0 0 8px;
                                            }

                                            .quantity-field .increase-button {
                                                margin-left: -4px;
                                                border-radius: 0 8px 8px 0;
                                            }

                                            .quantity-field .number {
                                                display: inline-block;
                                                text-align: center;
                                                border: none;
                                                border-top: 1px solid #ddd;
                                                border-bottom: 1px solid #ddd;
                                                margin: 0px;
                                                width: 40px;
                                                height: 100%;
                                                line-height: 40px;
                                                font-size: 11pt;
                                                box-sizing: border-box;
                                                background: white;
                                                font-family: calibri;
                                            }

                                            .quantity-field .number::selection {
                                                background: none;
                                            }

                                            /*
                                    input[type=number]::-webkit-inner-spin-button,
                                    input[type=number]::-webkit-outer-spin-button {
                                        -webkit-appearance: none;
                                        margin: 0;
                                    }
                                    */
                                        </style>


                                        <!-- số lượng  -->



                                        <td class="text-center" data-title="Stock">
                                            <div class="quantity-field">
                                                <button
                                                    class="value-button decrease-button" title="Azalt" wire:click.prevent="decreaseQuantity('{{$item->rowId}}')">-</button>
                                                <div class="number">{{ $item->qty }}</div>
                                                <button
                                                    class="value-button increase-button" title="Arrtır" wire:click.prevent="increaseQuantity('{{$item->rowId}}')">+</button>
                                        </td>

                        </div>
                        <td class="text-right" data-title="Cart">
                            <span>{{ $item->subtotal()}}</span>
                        </td>
                        <td class="action" data-title="Remove"><a href="#" class="text-muted" wire:click.prevent="destroy('{{$item->rowId}}')"><i class="fi-rs-trash"></i></a></td>
                        </tr>
                        @endforeach


                        <tr>
                            <td colspan="6" class="text-end">
                                <a href="#" class="text-muted" wire:click.prevent="ClearCart()"> <i class="fi-rs-cross-small"></i> Clear Cart</a>
                            </td>
                        </tr>
                        </tbody>
                        </table>
                    </div>

                </div>

                <div class=col-5>
                    <div class="row mb-10">
                        <div class="col-lg-12 col-md-12">

                        </div>
                        <div class="col-lg-12 col-md-12">
                            <div class="border p-md-4 p-30 border-radius cart-totals">
                                <div class="heading_s1 mb-3">
                                    <h4>Giỏ Hàng</h4>
                                </div>
                                <div class="table-responsive">

                                    @if(session()->has('coupon'))
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td class=" cart_total_label" style="text-align: left;">Tổng Số Tiền</td>
                                                <td class="cart_total_amount" style="text-align: right;"><strong><span class="font-xl fw-900 text-brand">{{Cart::instance('cart')->subtotal()}}đ</span></strong></td>
                                            </tr>
                                            <tr>
                                                <td class="cart_total_label">Mã ({{session()->get('coupon')['coupon_code']}}) Giảm Giá</td>
                                                <td class="cart_total_amount" style="text-align: right;"><span class=" font-lg fw-900 text-brand">- {{number_format($discount, 2)}}đ</span></td>
                                            </tr>
                                            <tr>
                                                <td class="cart_total_label">Tổng Giảm Giá</td>
                                                <td class="cart_total_amount" style="text-align: right;"><span class=" font-lg fw-900 text-brand">{{number_format($subtotalAfterDiscount, 2)}}đ</span></td>
                                            </tr>

                                            <tr>
                                                <td class="cart_total_label">Shipping</td>
                                                <td class="cart_total_amount">
                                                    <p class="text-info"> Ship Nội Thành; 20đ</p>
                                                    <p class="text-info">Ship Ngoại Thành; 40đ</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="cart_total_label">Tổng Số Tiền</td>
                                                <td class="cart_total_amount" style="text-align: right;"><span class=" font-xl fw-900 text-brand">{{number_format($totalAfterDiscount, 2)}}</span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    @else
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td class="cart_total_label"> Tổng Giỏ Hàng</td>
                                                <td class="cart_total_amount"><span class="font-lg fw-900 text-brand">{{Cart::instance('cart')->subtotal()}}đ</span></td>
                                            </tr>
                                            <tr>
                                                <td class="cart_total_label">Shipping</td>
                                                <td class="cart_total_amount"> <i class="ti-gift mr-5"></i>
                                                    <p class="text-info"> Ship Nội Thành; 20đ</p>
                                                    <p class="text-info">Ship Ngoại Thành; 40đ</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="cart_total_label">Tổng Số Tiền</td>
                                                <td class="cart_total_amount"><strong><span class="font-xl fw-900 text-brand">{{Cart::instance('cart')->total()}}đ</span></strong></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    @endif







                                </div>
                                @if(!session()->has('coupon'))
                                <div class="mb-2 mt-2">
                                    <div class="heading_s1 mb-3">
                                        <h4>
                                            Giảm Giá
                                        </h4>
                                    </div>
                                    <div class="total-amount">
                                        <div class="left">
                                            <div class="coupon">
                                                <form action="#" target="_blank">
                                                    <div class="form-row row justify-content-center">
                                                        <div class="form-group col-lg-8">
                                                            <input
                                                                class="font-medium"
                                                                name="Coupon"
                                                                placeholder="Enter Your Coupon"
                                                                wire:model="couponCode">
                                                        </div>
                                                        <div class="form-group col-lg-4">
                                                            <button
                                                                class="btn btn-sm"
                                                                wire:click.prevent="applyCouponCode">
                                                                <i class="fi-rs-label mr-10"></i>Áp mã
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    @if (session()->has('error_message'))
                                    <div class="alert alert-success">
                                        {{ session('error_message') }}
                                    </div>
                                    @endif

                                </div>

                                @endif



                                <a href="#" class="btn w-100" wire:click.prevent="checkout()"> <i class="fi-rs-box-alt mr-10"></i> THANH TOÁN</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div class="card">
                <div class="card-body">
                    <div class="text-center">

                        <style>
                            /* CSS */
                            .btn-container {
                                display: flex;
                                /* Sử dụng Flexbox */
                                justify-content: center;
                                /* Căn giữa ngang */
                                align-items: center;
                                /* Căn giữa dọc (nếu cần) */
                                height: 100%;
                                /* Đặt chiều cao container nếu cần căn giữa dọc */
                                margin-top: 20px;
                                /* Khoảng cách phía trên (tùy chỉnh) */
                            }

                            .btn {
                                display: inline-block;
                                padding: 10px 20px;
                                background-color: #F15412;
                                /* Màu nền */
                                color: white;
                                /* Màu chữ */
                                text-decoration: none;
                                /* Xóa gạch chân */
                                border-radius: 5px;
                                /* Bo góc */
                                font-size: 16px;
                                /* Kích thước chữ */
                                transition: background-color 0.3s ease;
                            }

                            .btn:hover {
                                background-color: #F15412;
                                /* Màu nền khi hover */
                            }

                            .btn {
                                font-size: 15px;
                                /* Chữ nhỏ */
                                padding: 5px 10px;
                                /* Kích thước nút nhỏ */
                                background-color: #F15412;
                                /* Màu nền */
                                color: white;
                                /* Màu chữ */
                                text-decoration: none;
                                /* Bỏ gạch chân */
                                border-radius: 4px;
                                /* Bo góc nút */
                            }
                        </style>




                        <img src="{{asset('assets/imgs/cart/ico_emptycart.svg')}}" alt="" width="150px">
                        <p class="text-center" style="font-size: 14px;">Chưa có sản phẩm trong giỏ hàng của bạn.</p>
                        <div class="btn-container">



                            <a href="{{ route('shop') }}" class="btn">Mua Sắm Ngay</a>
                        </div>
                    </div>
                </div>
            </div>


            @endif

            <div class="row">
                <div class="divider mt-5 mb-15"></div>
                <h3 class="section-title mb-20"><span>ĐỀ XUẤT </span> MỚI</h3>
                <div class="col-lg-12">
                    <div class="row product-grid-3 g-1">

                        @foreach ($products as $product)

                        <div class="col-lg-2 col-md-2 col-6 col-sm-6">
                            <div class="product-cart-wrap mb-1">
                                <div class="product-img-action-wrap">
                                    <div class="product-img product-img-zoom">
                                        <a href="{{ route('details', $product->slug) }}">
                                            <img class="default-img" src="{{ asset('admin/product/'.$product->image)}}" alt="">
                                        </a>
                                    </div>

                                    <div class="product-badges product-badges-position product-badges-mrg">
                                        @if($product->is_hot)
                                        <span class="hot">Hot</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="product-content-wrap">
                                    <!-- <div class="product-category">
                                        <a href="shop.html">Music</a>
                                    </div> -->
                                    <h2 style="font-size: 13px; margin: 5px 0; text-align: left; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                        <a href="{{route('details', ['slug'=>$product->slug])}}">{{$product->name}}</a>
                                    </h2>
                                    <div class="rating-result" title="90%">
                                        <!-- <span>
                                            <span>90%</span>
                                        </span> -->
                                    </div>
                                    <div class="product-price">
                                        <span>{{ $product->sale_price }}</span>
                                        <span class="old-price">{{ $product->reguler_price }}</span>
                                    </div>
                                    <div class="product-action-1 show">
                                        <a aria-label="Add To Cart" class="action-btn hover-up" href="#" wire:click.prevent="Store({{$product->id}},'{{$product->name}}',{{$product->sale_price}})"><i class="fi-rs-shopping-bag-add"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <!--pagination-->
                    <div class="pagination-area mt-15 mb-sm-5 mb-lg-0">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-start">
                                <li class="page-item active"><a class="page-link" href="#">01</a></li>
                                <li class="page-item"><a class="page-link" href="#">02</a></li>
                                <li class="page-item"><a class="page-link" href="#">03</a></li>
                                <li class="page-item"><a class="page-link dot" href="#">...</a></li>
                                <li class="page-item"><a class="page-link" href="#">16</a></li>
                                <li class="page-item"><a class="page-link" href="#"><i class="fi-rs-angle-double-small-right"></i></a></li>
                            </ul>
                        </nav>
                    </div>
                </div>

            </div>







</div>
</section>
</main>
</div>