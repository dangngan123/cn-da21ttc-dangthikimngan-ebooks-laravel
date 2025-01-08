<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <p>Xin chào <span style="color: #F15412;">{{ $order->name }}</span></p>
    <p>Đơn hàng <span style="color: #F15412;">#{{$order->id}}</span> đã đặt thành công ngày <span style="color: #F15412;"> {{$order->created_at}}</span></p>



    <form>
        @foreach($order->orderItems as $item)
        <div class="item-info">
        </div>
        <div class="order-details">
            <div class="item">
                <div class="item-image">
                    <img src="{{asset('admin/product/'.$item->product->image)}}" alt="Product Image" style="width: 50px; height: 50px;">
                </div>
                <div class="item-name">
                    <p>Sản phẩm: <span style="color: #F15412;"></span>{{$item->product->name}} x {{$item->quantity}}</p>
                </div>
                <div class="item-price">
                    <p>Giá: <span style="color: #F15412;"></span>{{$item->price}}</p>
                </div>
            </div>
            @endforeach
            <div class="order-totals">
                <div class="subtotal">
                    <p>Tổng tiền: <span style="color: #F15412;"></span>{{$order->subtotal}}</p>
                </div>
                <div class="shipping">
                    <p>Chi phí vận chuyển: <span style="color: #F15412;"></span>{{$order->shipping_cost }}</p>
                </div>
                <div class="total">
                    <p>Tổng thanh toán: <span style="color: #F15412;"></span>{{$order->total}}</p>
                </div>
            </div>
        </div>
        <div class="thank-you">
            <p>Một lần nữa, chúng tôi xin chân thành cảm ơn quý khách đã tin tưởng và ủng hộ. Chúc quý khách một ngày tốt lành!</p>
        </div>
        </div>
    </form>

</body>

</html>