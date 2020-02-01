@extends('web\layouts\main')

@section('content')

    <section class="orders">
        <div class="order-state py-5 d-flex">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="text-left"><a href="{{route('order.page')}}">طلبات حالية</a></h5>
                    </div>
                    <div class="col-md-6">
                        <h5 class="text-right"><a href="{{route('previous.orders')}}">طلبات سابقة</a></h5>
                    </div>
                </div>
            </div>
        </div><!--End order-state-->
        <div class="order-details">
            <div class="container">
                @foreach($orders as $order)

                <div class="order-info my-5">
                    <div class="row text-center">
                        <div class="col-md-3 py-3 px-4">
                            <img src="{{asset('public/'.$order->restaurant->photo)}}" class="img-fluid" alt="">
                        </div>
                        <div class="col-md-5 pt-md-5 text-left">
                            @foreach($order->products as $product)
                            <h4 class="py-2">{{$product->name}}</h4>

                            <p class="py-2">المجموع :  <span>{{$product->price}}</span> ريال</p>

                                @endforeach
                        </div>
                        <div class="col-md-4 pt-md-5 px-5">
                            <a href="{{url('sofra/client/order/'.$order->id.'/delivered')}}" class="btn btn-success px-5 d-block my-4">استلام</a>
                            <a href="{{url('sofra/client/order/'.$order->id.'/rejected')}}" class="btn btn-danger px-5 d-block my-4">رفض</a>
                        </div>
                    </div>
                </div>

   @endforeach

            </div>
        </div>
    </section>



@endsection
