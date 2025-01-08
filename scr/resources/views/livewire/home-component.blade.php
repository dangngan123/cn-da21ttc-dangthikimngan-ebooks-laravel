<div>

    <main class="main">
        <section class="home-slider position-relative pt-20" wire:ignore>
            <div class="hero-slider-1 dot-style-1 dot-style-1-position-1">

                @foreach($sliders as $slider)
                <div class="single-hero-slider single-animation-wrap">
                    <div class="container">
                        <div class="row align-items-center slider-animated-1">
                            <div class="col-lg-5 col-md-6">
                                <div class="hero-slider-content-2">
                                    <h4 class="animated">{{$slider->top_title}}</h4>
                                    <h2 class="animated fw-bold">{{$slider->title}}</h2>
                                    <h1 class="animated fw-bold text-7">{{$slider->sub_title}}</h1>
                                    <p class="animated">Tiết kiệm hơn với mua sách giảm tới {{$slider->offer}}% </p>
                                    <a class="animated btn btn-brush btn-brush-2" href="{{$slider->link}}"> Khám Phá Ngay </a>
                                </div>

                            </div>
                            <div class="col-lg-7 col-md-6">
                                <div class="single-slider-img single-slider-img-1">
                                    <img class="animated slider-1-2" src="{{asset('admin/slider/'.$slider->image)}}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
            <div class="slider-arrow hero-slider-1-arrow"></div>
        </section>
        <section class="featured section-padding position-relative">
            <div class="container">
                <div class="row">
                    <div class="col-lg-2 col-md-4 mb-md-3 mb-lg-0">
                        <div class="banner-features wow fadeIn animated hover-up">
                            <img src="assets/imgs/theme/icons/feature-1.png" alt="">
                            <h4 class="bg-1">Free Shipping</h4>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 mb-md-3 mb-lg-0">
                        <div class="banner-features wow fadeIn animated hover-up">
                            <img src="assets/imgs/theme/icons/feature-2.png" alt="">
                            <h4 class="bg-3">Online Order</h4>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 mb-md-3 mb-lg-0">
                        <div class="banner-features wow fadeIn animated hover-up">
                            <img src="assets/imgs/theme/icons/feature-3.png" alt="">
                            <h4 class="bg-2">Save Money</h4>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 mb-md-3 mb-lg-0">
                        <div class="banner-features wow fadeIn animated hover-up">
                            <img src="assets/imgs/theme/icons/feature-4.png" alt="">
                            <h4 class="bg-4">Promotions</h4>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 mb-md-3 mb-lg-0">
                        <div class="banner-features wow fadeIn animated hover-up">
                            <img src="assets/imgs/theme/icons/feature-5.png" alt="">
                            <h4 class="bg-5">Happy Sell</h4>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 mb-md-3 mb-lg-0">
                        <div class="banner-features wow fadeIn animated hover-up">
                            <img src="assets/imgs/theme/icons/feature-6.png" alt="">
                            <h4 class="bg-6">24/7 Support</h4>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <style>
            .flash-sale-section {
                background: #FF6B6B;
                border-radius: 10px;
                padding: 20px;
                margin: 20px 0;
            }

            .flash-sale-header {
                display: flex;
                align-items: center;
                justify-content: space-between;
                margin-bottom: 20px;
            }

            .flash-sale-text {
                display: flex;
                align-items: center;
                gap: 5px;
                color: white;
                font-size: 24px;
                font-weight: bold;
            }

            .flash-icon {
                color: #FFD700;
                font-size: 24px;
            }

            .countdown-wrapper {
                display: flex;
                align-items: center;
                gap: 10px;
                color: white;
            }

            .countdown {
                display: flex;
                align-items: center;
                gap: 8px;
            }

            .countdown>div {
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                background: #000;
                width: 45px;
                height: 45px;
                border-radius: 4px;
                color: white;
            }

            .number {
                font-weight: 600;
                font-size: 20px;
                color: white;
            }

            div span:last-of-type {
                font-size: 10px;
                margin-top: 2px;
            }

            .product-carousel {
                background: white;
                border-radius: 8px;
                padding: 15px;
            }

            .product-cart-wrap {
                background: #fff;
                border-radius: 8px;
                transition: all 0.3s ease;
            }

            .product-cart-wrap:hover {
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
                transform: translateY(-2px);
            }

            @media screen and (max-width:600px) {
                .flash-sale-header {
                    flex-direction: column;
                    align-items: flex-start;
                    gap: 10px;
                }

                .countdown>div {
                    width: 40px;
                    height: 40px;
                }

                .number {
                    font-size: 18px;
                }

                div span:last-of-type {
                    font-size: 9px;
                }
            }
        </style>

        @if($saletimerproducts->count() > 0 && $saletimer->status == 1 && $saletimer->sale_timer > Carbon\Carbon::now())
        <div class="container">
            <div class="flash-sale-section">
                <div class="flash-sale-header">
                    <div class="flash-sale-text">
                        <span>FLA</span>
                        <i class="fas fa-bolt flash-icon"></i>H
                        <span>SALE</span>
                    </div>
                    <div class="countdown-wrapper">
                        <span>Kết thúc trong</span>
                        <div class="countdown">
                            <div><span class="number days"></span><span>Ngày</span></div>
                            <div><span class="number hours"></span><span>Giờ</span></div>
                            <div><span class="number minutes"></span><span>Phút</span></div>
                            <div><span class="number seconds"></span><span>Giây</span></div>
                        </div>
                    </div>
                </div>
                <div class="product-carousel">
                    <div class="wow fadeIn animated" wire:ignore>
                        <div class="carausel-6-columns-cover position-relative">
                            <div class="carausel-6-columns carausel-arrow-center" id="carausel-6-columns-1">
                                @foreach($saletimerproducts as $saletimerproduct)
                                <div class="product-cart-wrap small hover-up" style="width: 150px; margin: 5px; padding: 10px; font-size: 12px;">
                                    <div class="product-img-action-wrap" style="height: 150px; overflow: hidden;">
                                        <div class="product-img product-img-zoom">
                                            <a href="{{route('details', ['slug'=>$saletimerproduct->slug])}}">
                                                <img class="default-img" src="{{asset('admin/product/'.$saletimerproduct->image)}}" alt="" style="width: 100%; height: auto;">
                                            </a>
                                        </div>
                                        <div class="product-badges product-badges-position product-badges-mrg">
                                            @if($saletimerproduct->is_hot)
                                            <span class="hot">Hot</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="product-content-wrap" style="text-align: center;">
                                        <h2 style="font-size: 13px; margin: 5px 0; text-align: left; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                            <a href="{{route('details', ['slug'=>$saletimerproduct->slug])}}">{{$saletimerproduct->name}}</a>
                                        </h2>
                                        <div class="rating-result" title="90%" style="font-size: 12px;">
                                            <span></span>
                                        </div>
                                        <div class="product-price" style="font-size: 12px;">
                                            <span>{{$saletimerproduct->sale_price}}</span>
                                            <span class="old-price" style="text-decoration: line-through; color: #999;">
                                                {{$saletimerproduct->reguler_price}}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0px;
                background-color: #f5f5f5;
            }

            .container {
                max-width: 1200px;
                margin: 0 auto;
                padding: 0 20px;
            }

            .courses-grid {
                display: grid;
                grid-template-columns: repeat(4, 1fr);
                gap: 24px;
            }

            .item {
                background-color: white;
                border-radius: 8px;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                transition: transform 0.3s ease, box-shadow 0.3s ease;
                padding: 20px;
            }

            .item:hover {
                transform: translateY(-5px);
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            }

            .item a {
                display: flex;
                flex-direction: column;
                align-items: center;
                text-decoration: none;
                color: #333;
            }

            .item img {
                width: 100%;
                height: 100%;
                margin-bottom: 16px;
            }

            .course-name {
                text-align: center;
                font-size: 14px;
                font-weight: 500;
                line-height: 1.4;
            }

            h3 {
                font-size: 21px;
                margin-bottom: 24px;
            }

            /* Responsive breakpoints */
            @media (max-width: 1024px) {
                .courses-grid {
                    grid-template-columns: repeat(3, 1fr);
                    gap: 20px;
                }
            }

            @media (max-width: 768px) {
                .courses-grid {
                    grid-template-columns: repeat(2, 1fr);
                    gap: 16px;
                }
            }

            @media (max-width: 480px) {
                .courses-grid {
                    grid-template-columns: 1fr;
                }

                .item {
                    padding: 16px;
                }
            }

            .count-down {
                width: 550px;
                height: 378px;
                margin: auto;
                padding: 20px;
            }

            .count-down .flipdown {
                margin: auto;
                width: 600px;
                margin-top: 30px;
            }

            .count-down h1 {
                text-align: center;
                font-weight: 400;
                font-size: 3em;
                margin-top: 0;
                margin-bottom: 10px;
            }

            @media (max-width: 550px) {
                .count-down {
                    width: 100%;
                    height: 362px;
                }

                .count-down h1 {
                    font-size: 2.5em;
                }
            }
        </style>

        <div class="container" wire:ignore>
            <div class="courses-grid" id="clients">
                @foreach($categories->take(4) as $category) <!-- Lấy chỉ 4 danh mục đầu tiên -->
                <div class="item">
                    <a target="_blank" href="{{route('product.category', ['slug'=>$category->slug])}}">
                        <img src="{{asset('admin/category/'.$category->image)}}" alt="{{$category->name}}">
                        <div class="course-name"><b>{{$category->name}}</b></div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>





        <!-- Bán chạy nhất -->
        <section class="popular-categories section-padding" wire:ignore>
            <div class="container wow fadeIn animated">
                <h3 class="section-title mb-20"><span style="font-size: 22px">BEST </span>SELLER</h3>
                <div class="carausel-6-columns-cover position-relative">
                    <div class="slider-arrow slider-arrow-2 carausel-6-columns-arrow" id="carausel-6-columns-3-arrows"></div>
                    <div class="carausel-6-columns carausel-arrow-center" id="carausel-6-columns-3">
                        @foreach($bestproducts as $bestproduct)
                        <div class="product-cart-wrap small hover-up" style="width: 150px; margin: 5px; padding: 10px; font-size: 12px;">
                            <div class="product-img-action-wrap" style="height: 150px; overflow: hidden;">
                                <div class="product-img product-img-zoom">
                                    <a href="{{route('details', ['slug'=>$bestproduct->slug])}}">
                                        <img class="default-img" src="{{ asset('admin/product/' . $bestproduct->image) }}" alt="" style="width: 100%; height: auto;">
                                    </a>
                                </div>
                                <div class="product-badges product-badges-position product-badges-mrg">
                                    @if($bestproduct->is_hot)
                                    <span class="hot">Hot</span>
                                    @endif
                                </div>
                            </div>
                            <div class="product-content-wrap" style="text-align: center;">
                                <h2 style="font-size: 13px; margin: 5px 0; text-align: left; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                    <a href="{{route('details', ['slug'=>$bestproduct->slug])}}">{{$bestproduct->name}}</a>
                                </h2>

                                <div class="rating-result" title="90%" style="font-size: 12px;">
                                    <span></span>
                                </div>
                                <div class="product-price" style="font-size: 12px;">
                                    <span>{{$bestproduct->sale_price}} </span>
                                    <span class="old-price" style="text-decoration: line-through; color: #999;">{{$bestproduct->reguler_price}}</span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
        <!-- Sách mới -->
        <section class="popular-categories section-padding" wire:ignore>
            <div class="container wow fadeIn animated">
                <h3 class="section-title"> <span style="font-size: 22px">SÁCH </span>MỚI</h3>
                <div class="carausel-6-columns-cover position-relative">
                    <div class="slider-arrow slider-arrow-2 carausel-6-columns-arrow" id="carausel-6-columns-2-arrows"></div>
                    <div class="carausel-6-columns carausel-arrow-center" id="carausel-6-columns-2">
                        @foreach($nproducts as $nproduct)
                        <div class="product-cart-wrap small hover-up" style="width: 150px; margin: 5px; padding: 10px; font-size: 12px;">
                            <div class="product-img-action-wrap" style="height: 150px; overflow: hidden;">
                                <div class="product-img product-img-zoom">
                                    <a href="{{route('details', ['slug'=>$nproduct->slug])}}">
                                        <img class="default-img" src="{{ asset('admin/product/' . $nproduct->image) }}" alt="" style="width: 100%; height: auto;">
                                    </a>
                                </div>
                                <div class="product-badges product-badges-position product-badges-mrg">
                                    @if($nproduct->is_hot)
                                    <span class="hot">Hot</span>
                                    @endif
                                </div>
                            </div>
                            <div class="product-content-wrap" style="text-align: center;">
                                <h2 style="font-size: 13px; margin: 5px 0; text-align: left; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                    <a href="{{route('details', ['slug'=>$nproduct->slug])}}">{{$nproduct->name}}</a>
                                </h2>
                                <div class="rating-result" title="90%" style="font-size: 12px;">
                                    <span></span>
                                </div>
                                <div class="product-price" style="font-size: 12px;">
                                    <span>{{$nproduct->sale_price}} </span>
                                    <span class="old-price" style="text-decoration: line-through; color: #999;">{{$nproduct->reguler_price}}</span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <section class="popular-categories section-padding mt-15 mb-25" wire:ignore>
            <div class="container wow fadeIn animated">
                <h3 class="section-title mb-20"><span style="font-size: 22px">DANH SÁCH </span> NỔI BẬT</h3>
                <div class="carausel-6-columns-cover position-relative">
                    <div class="slider-arrow slider-arrow-2 carausel-6-columns-arrow" id="carausel-6-columns-arrows"></div>
                    <div class="carausel-6-columns" id="carausel-6-columns">
                        @foreach($pcategories as $pcategory)
                        <div class="card-1">
                            <figure class=" img-hover-scale overflow-hidden">
                                <a href="{{route('product.category', ['slug'=>$pcategory->slug])}}"><img src="{{asset('admin/category/'.$pcategory->image)}}" alt=""></a>
                            </figure>
                            <h5 class="small"><a href="{{route('product.category', ['slug'=>$pcategory->slug])}}">{{$pcategory->name}}</a></h5>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>





        <section class="position-relative wow fadeIn animated">
            <div class="bg-square"></div>
            <div class="container">
                <!-- <div class="tab-header">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="nav-tab-one" data-bs-toggle="tab" data-bs-target="#tab-one" type="button" role="tab" aria-controls="tab-one" aria-selected="true">Nổi bật</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="nav-tab-two" data-bs-toggle="tab" data-bs-target="#tab-two" type="button" role="tab" aria-controls="tab-two" aria-selected="false">Popular</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="nav-tab-three" data-bs-toggle="tab" data-bs-target="#tab-three" type="button" role="tab" aria-controls="tab-three" aria-selected="false">New added</button>
                        </li>
                    </ul>

                </div> -->
                <style>
                    .img-grey-hover {
                        opacity: 0.8;
                    }
                </style>
                <!--End nav-tabs-->
                <div class="tab-content wow fadeIn animated" id="myTabContent">
                    <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="tab-one">
                        <div class="row product-grid-4 g-1">
                            @foreach($products as $product )
                            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6 col-6">
                                <div class="product-cart-wrap mb-30">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a href="{{route('details', ['slug'=>$product->slug])}}">
                                                <img class="default-img" src="{{asset('admin/product/'.$product->image)}}" alt="">

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
                                            <a href="shop.html">Clothing</a>
                                        </div> -->
                                        <h2 style="font-size: 13px; margin: 5px 0; text-align: left; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                            <a href="{{route('details', ['slug'=>$product->slug])}}">{{$product->name}}</a>
                                        </h2>
                                        <div class=" rating-result" title="90%">
                                            <!-- <span>
                                                <span>90%</span>
                                            </span> -->
                                        </div>
                                        <div class="product-price">
                                            <span>{{$product->sale_price}} </span>
                                            <span class="old-price">{{ $product->reguler_price }}</span>
                                        </div>
                                        <div class="product-action-1 show">
                                            <a aria-label="Giỏ hàng" class="action-btn hover-up" href="#" wire:click.prevent="Store({{$product->id}},'{{$product->name}}',{{$product->sale_price}})"><i class=" fi-rs-shopping-bag-add"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                        </div>
                        <!--End product-grid-4-->
                        <div class="text-center">
                            <button class="btn btn-primary btn-sm" wire:click="loadMore">Xem Thêm</button>

                        </div>
                        <br>

                    </div>


                </div>
                <!--End tab-content-->
            </div>
        </section>









        <!-- <section class="banner-2 section-padding pb-0">
            <div class="container">
                <div class="banner-img banner-big wow fadeIn animated f-none">
                    <img src="assets/imgs/banner/banner-4.png" alt="">
                    <div class="banner-text d-md-block d-none">
                        <h4 class="mb-15 mt-40 text-brand">Repair Services</h4>
                        <h1 class="fw-600 mb-20">We're an Apple <br>Authorised Service Provider</h1>
                        <a href="shop.html" class="btn">Learn More <i class="fi-rs-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </section> -->

        <div class="container" wire:ignore>
            <div class="courses-grid" id="clients">
                @foreach($categories->reverse()->take(4) as $category) <!-- Lấy 4 danh mục cuối cùng -->
                <div class="item">
                    <a target="_blank" href="{{route('product.category', ['slug'=>$category->slug])}}">
                        <img src="{{asset('admin/category/'.$category->image)}}" alt="{{$category->name}}">
                        <div class="course-name"><b>{{$category->name}}</b></div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>






        <section class="section-padding" wire:ignore>
            <div class="container">
                <h3 class="section-title mb-20 wow fadeIn animated"><span style="font-size: 22px">THƯƠNG HIỆU</span> NỘI BẬT</h3>
                <div class="carausel-6-columns-cover position-relative wow fadeIn animated">
                    <div class="slider-arrow slider-arrow-2 carausel-6-columns-arrow" id="carausel-6-columns-3-arrows"></div>
                    <div class="carausel-6-columns text-center" id="carausel-6-columns-4">
                        <div class="brand-logo">
                            <img class="img-grey-hover" src="assets/imgs/banner/brand-1.png" alt="">
                        </div>
                        <div class="brand-logo">
                            <img class="img-grey-hover" src="assets/imgs/banner/brand-2.png" alt="">
                        </div>
                        <div class="brand-logo">
                            <img class="img-grey-hover" src="assets/imgs/banner/brand-3.png" alt="">
                        </div>
                        <div class="brand-logo">
                            <img class="img-grey-hover" src="assets/imgs/banner/brand-4.png" alt="">
                        </div>
                        <div class="brand-logo">
                            <img class="img-grey-hover" src="assets/imgs/banner/brand-5.png" alt="">
                        </div>
                        <div class="brand-logo">
                            <img class="img-grey-hover" src="assets/imgs/banner/brand-6.png" alt="">
                        </div>
                        <div class="brand-logo">
                            <img class="img-grey-hover" src="assets/imgs/banner/brand-3.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section>


    </main>

</div>


<script>
    // my next birthday
    const newDate = new Date('{{Carbon\Carbon::parse($saletimer->sale_timer)}}').getTime()
    const countdown = setInterval(() => {

        const date = new Date().getTime()
        const diff = newDate - date

        // const month = Math.floor((diff % (1000 * 60 * 60 * 24 * (365.25 / 12) * 365)) / (1000 * 60 * 60 * 24 * (365.25 / 12)))
        const days = Math.floor(diff % (1000 * 60 * 60 * 24 * (365.25 / 12)) / (1000 * 60 * 60 * 24))
        const hours = Math.floor(diff % (1000 * 60 * 60 * 24) / (1000 * 60 * 60))
        const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60))
        const seconds = Math.floor((diff % (1000 * 60)) / 1000)

        document.querySelector(".seconds").innerHTML = seconds < 10 ? '0' + seconds : seconds
        document.querySelector(".minutes").innerHTML = minutes < 10 ? '0' + minutes : minutes
        document.querySelector(".hours").innerHTML = hours < 10 ? '0' + hours : hours
        document.querySelector(".days").innerHTML = days < 10 ? '0' + days : days
        // document.querySelector(".months").innerHTML = month < 10 ? '0' + month : month

        if (diff <= 0) {
            clearInterval(countdown)
            document.querySelector(".countdown").innerHTML = 'TIME IS OVER'
        }

    }, 1000)
</script>