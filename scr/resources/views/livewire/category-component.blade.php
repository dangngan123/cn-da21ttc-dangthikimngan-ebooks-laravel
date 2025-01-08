<div>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.html" rel="nofollow">Home</a>
                    <span></span> Shop
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="shop-product-fillter">
                            <div class="totall-product">
                                <p><strong class="text-brand">{{ $products->total() }}</strong> sản phẩm: <strong>{{ $cateroryName }}</strong></p>
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
                                                <img class="default-img" src="{{ $product->image}}" alt="">

                                            </a>
                                        </div>

                                        <div class="product-badges product-badges-position product-badges-mrg">
                                            <span class="hot">Hot</span>
                                        </div>
                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="product-category">
                                            <a href="shop.html">Music</a>
                                        </div>
                                        <h2><a href="product-details.html">{{ $product->name }}</a></h2>
                                        <div class="rating-result" title="90%">
                                            <span>
                                                <span>90%</span>
                                            </span>
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
                            <h5 class="section-title style-1 mb-30 wow fadeIn animated">Category</h5>
                            <ul class="categories">
                                @foreach ($categories as $category)

                                <li><a href="{{route('product.category', ['slug'=>$category->slug])}}">{{ $category->name }}</a></li>
                                @endforeach


                            </ul>
                        </div>
                        <div class="sidebar-widget price_range range mb-30">
                            <div class="widget-header position-relative mb-20 pb-10">
                                <h5 class="widget-title mb-10">Giá</h5>
                                <div class="bt-1 border-color-1"></div>
                            </div>
                            <div class="price-filter">
                                <div class="price-filter-inner">
                                    <div id="slider-range" wrie:ignore></div>
                                    <div class="price_slider_amount">
                                        <div class="label-input">
                                            <span>Range:</span>
                                            <san>{{$min_price}}đ</san> - <san>{{$max_price}}đ</san>
                                        </div>
                                    </div>
                                </div>

                                <div class="list-group">
                                    <div class="list-group-item mb-10 mt-10">
                                        <label class="fw-900">Color</label>
                                        <div class="custome-checkbox">
                                            <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox1" value="">
                                            <label class="form-check-label" for="exampleCheckbox1"><span>Red (56)</span></label>
                                            <br>
                                            <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox2" value="">
                                            <label class="form-check-label" for="exampleCheckbox2"><span>Green (78)</span></label>
                                            <br>
                                            <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox3" value="">
                                            <label class="form-check-label" for="exampleCheckbox3"><span>Blue (54)</span></label>
                                        </div>
                                        <label class="fw-900 mt-15">Item Condition</label>
                                        <div class="custome-checkbox">
                                            <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox11" value="">
                                            <label class="form-check-label" for="exampleCheckbox11"><span>New (1506)</span></label>
                                            <br>
                                            <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox21" value="">
                                            <label class="form-check-label" for="exampleCheckbox21"><span>Refurbished (27)</span></label>
                                            <br>
                                            <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox31" value="">
                                            <label class="form-check-label" for="exampleCheckbox31"><span>Used (45)</span></label>
                                        </div>
                                        <div class="list-group">
                                            <div class="list-group-item mb-10 mt-10">
                                                <label class="fw-900 mt-15">Age Range</label>
                                                <div class="custome-checkbox">
                                                    <input class="form-check-input" type="checkbox" wire:model.live="selectedAges" value="1+">
                                                    <label class="form-check-label" for="ageCheckbox1"><span>1+ years</span></label>
                                                    <br>
                                                    <input class="form-check-input" type="checkbox" wire:model.live="selectedAges" value="6+">
                                                    <label class="form-check-label" for="ageCheckbox2"><span>6+ years</span></label>
                                                    <br>
                                                    <input class="form-check-input" type="checkbox" wire:model.live="selectedAges" value="13+">
                                                    <label class="form-check-label" for="ageCheckbox3"><span>13+ years</span></label>
                                                    <br>
                                                    <input class="form-check-input" type="checkbox" wire:model.live="selectedAges" value="18+">
                                                    <label class="form-check-label" for="ageCheckbox4"><span>18+ years</span></label>
                                                </div>
                                            </div>



                                        </div>
                                    </div>
                                    <a href="shop.html" class="btn btn-sm btn-default"><i class="fi-rs-filter mr-5"></i> Fillter</a>
                                </div>
                                <!-- Product sidebar Widget -->
                                <div class="sidebar-widget product-sidebar  mb-30 p-30 bg-grey border-radius-10">
                                    <div class="widget-header position-relative mb-20 pb-10">
                                        <h5 class="widget-title mb-10">New products</h5>
                                        <div class="bt-1 border-color-1"></div>
                                    </div>
                                    @foreach($nproducts as $nproduct)

                                    <div class="single-post clearfix">
                                        <div class="image">
                                            <img src="{{$nproduct->image}}" alt="#">
                                        </div>
                                        <div class="content pt-10">
                                            <h5><a href="product-details.html">{{$nproduct->name}}</a></h5>
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



<!-- @push('scripts')
<script>
 var sliderrange = $('#slider-range');
    var amountprice = $('#amount');
    $(function() {
        sliderrange.slider({
            range: true,
            min: 0,
            max: 700,
            values: [0, 700],
            slide: function(event, ui) {
                @this.set('min_price', ui.values[0]);
                @this.set('max_price', ui.values[1]);
            }
        });
       
    }); 

</script>
@endpush -->