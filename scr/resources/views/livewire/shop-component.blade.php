<div>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('home') }}" rel="nofollow">Trang chủ</a>
                    <span></span> Sản phẩm
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="shop-product-fillter">
                            <div class="totall-product">
                                <p> <strong class="text-brand">{{ $products->total() }}</strong> sản phẩm đang chờ bạn!</p>
                            </div>
                            <div class="sort-by-product-area">
                                <div class="sort-by-cover mr-10">
                                    <div class="sort-by-product-wrap">
                                        <div class="sort-by">
                                            <span><i class="fi-rs-apps"></i>Hiện:</span>
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
                                <div class="sort-by-cover">
                                    <div class="sort-by-product-wrap">
                                        <div class="sort-by">
                                            <span><i class="fi-rs-apps-sort"></i>Sắp xếp theo:</span>
                                        </div>
                                        <div class="sort-by-dropdown-wrap">
                                            <span> {{$orderBy}} <i class="fi-rs-angle-small-down"></i></span>
                                        </div>
                                    </div>
                                    <div class="sort-by-dropdown">
                                        <ul>
                                            <li><a class="{{ $orderBy == 'Default Shorting' ? 'active' : '' }}" href="#" wire:click.prevent="changeOrderBy('Mặc định')">Mặc định</a></li>
                                            <li><a class="{{ $orderBy == 'Price: Low to High' ? 'active' : '' }}" href="#" wire:click.prevent="changeOrderBy('Giá thấp')">Giá thấp</a></li>
                                            <li><a class="{{ $orderBy == 'Price: High to Low' ? 'active' : '' }}" href="#" wire:click.prevent="changeOrderBy('Giá cao')">Giá cao</a></li>
                                            <li><a class="{{ $orderBy == 'Products by newness' ? 'active' : '' }}" href="#" wire:click.prevent="changeOrderBy('Sản phẩm mới')">Sản phẩm mới</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row product-grid-3">

                            @foreach($products as $product)
                            <div class="col-lg-4 col-md-4 col-6 col-sm-6">
                                <div class="product-cart-wrap mb-30">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a href="{{route('details', ['slug'=>$product->slug])}}">
                                                <img class="default-img" src="{{asset('admin/product/'.$product->image)}}" alt="không có sản phẩm">

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
                                        <div class=" rating-result" title="90%">
                                            <!-- <span>
                                                <span>90%</span>
                                            </span> -->
                                        </div>
                                        <div class="product-price">
                                            <span>{{ $product->sale_price }}đ</span>
                                            <span class="old-price">{{ $product->reguler_price}}đ</span>
                                        </div>

                                    </div>
                                </div>
                            </div>


                            @endforeach





                        </div>
                        <!--pagination-->
                        <div class="pagination-area mt-15 mb-sm-5 mb-lg-0">
                            {{--<nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-start">
                                    <li class="page-item active"><a class="page-link" href="#">01</a></li>
                                    <li class="page-item"><a class="page-link" href="#">02</a></li>
                                    <li class="page-item"><a class="page-link" href="#">03</a></li>
                                    <li class="page-item"><a class="page-link dot" href="#">...</a></li>
                                    <li class="page-item"><a class="page-link" href="#">16</a></li>
                                    <li class="page-item"><a class="page-link" href="#"><i class="fi-rs-angle-double-small-right"></i></a></li>
                                </ul>
                            </nav>--}}
                            {{ $products->links('pagination::bootstrap-4') }}


                        </div>
                    </div>
                    <div class="col-lg-3 primary-sidebar sticky-sidebar">
                        <div class="row">
                            <div class="col-lg-12 col-mg-6"></div>
                            <div class="col-lg-12 col-mg-6"></div>
                        </div>
                        <div class="widget-category mb-30">
                            <h5 class="section-title style-1 mb-30 wow fadeIn animated">Danh Mục Sản phẩm</h5>
                            <ul class="categories">
                                @foreach ($categories as $category)

                                <li><a href="{{route('product.category', ['slug'=>$category->slug])}}">{{ $category->name }}</a></li>
                                @endforeach


                            </ul>
                        </div>
                        <div class="sidebar-widget price_range range mb-30">
                            <div class="list-group" wire:ignore>
                                <div class="list-group-item mb-10 mt-10">
                                    <label class="section-title">Độ tuổi</label>
                                    <div class="custome-checkbox">
                                        <input class="form-check-input" type="checkbox" name="checkbox" id="ageCheckbox1" wire:model.live="selectedAges" value="1-6">
                                        <label class="form-check-label" for="ageCheckbox1"><span>1 - 6 years</span></label>
                                        <br>
                                        <input class="form-check-input" type="checkbox" name="checkbox" id="ageCheckbox2" wire:model.live="selectedAges" value="7-13">
                                        <label class="form-check-label" for="ageCheckbox2"><span>7 - 13 years</span></label>
                                        <br>
                                        <input class="form-check-input" type="checkbox" name="checkbox" id="ageCheckbox3" wire:model.live="selectedAges" value="14-18">
                                        <label class="form-check-label" for="ageCheckbox3"><span>14 - 18 years</span></label>
                                    </div>

                                    <label class="fw-900">Giá</label>
                                    <div class="custome-checkbox">
                                        <input class="form-check-input" type="checkbox" name="checkbox"
                                            id="priceRange1"
                                            wire:model.live="priceRange"
                                            value="0-150">
                                        <label class="form-check-label" for="priceRange1">
                                            <span>0 đ - 150 đ</span>
                                        </label>
                                        <br>

                                        <input class="form-check-input" type="checkbox" name="checkbox"
                                            id="priceRange2"
                                            wire:model.live="priceRange"
                                            value="150-300">
                                        <label class="form-check-label" for="priceRange2">
                                            <span>150 đ - 300 đ</span>
                                        </label>
                                        <br>

                                        <input class="form-check-input" type="checkbox" name="checkbox"
                                            id="priceRange3"
                                            wire:model.live="priceRange"
                                            value="300-500">
                                        <label class="form-check-label" for="priceRange3">
                                            <span>300 đ - 500 đ</span>
                                        </label>
                                        <br>

                                        <input class="form-check-input" type="checkbox" name="checkbox"
                                            id="priceRange4"
                                            wire:model.live="priceRange"
                                            value="500-700">
                                        <label class="form-check-label" for="priceRange4">
                                            <span>500 đ - 700 đ</span>
                                        </label>
                                    </div>


                                </div>
                            </div>
                        </div>

                        <!-- Product sidebar Widget -->
                        <div class="sidebar-widget product-sidebar  mb-30 p-30 bg-grey border-radius-10" wire:ignore>
                            <div class="widget-header position-relative mb-20 pb-10">
                                <h5 class="widget-title mb-10">Sản phẩm Mới</h5>
                                <div class="bt-1 border-color-1"></div>
                            </div>
                            @foreach($nproducts as $nproduct)

                            <div class="single-post clearfix">
                                <div class="image">
                                    <img src="{{asset('admin/product/'.$nproduct->image)}}" alt="#">
                                </div>
                                <div class="content pt-10">
                                    <h5><a href="{{route('details', ['slug'=>$nproduct->slug])}}">{{$nproduct->name}}</a></h5>
                                    <p class="price mb-0 mt-5">{{$nproduct->reguler_price}}đ</p>
                                    <div class="product-rate">
                                        <div class="product-rating" style="width:90%"></div>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                        </div>

                    </div>
                </div>
            </div>
        </section>
    </main>
</div>