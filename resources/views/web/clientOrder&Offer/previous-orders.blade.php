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
                        <div class="col-md-8 py-3 text-left">

                            <h4 class="py-1">{{$order->restaurant->name}}</h4>

                            <p class="py-1">المجموع :  <span>{{$order->total}}</span> ريال</p>
                            <p class="py-1"> التوصيل <span>{{$order->commission}}</span></p>
                            <p class="py-1">الإجمالى :  <span>{{$order->net}}</span> ريال</p>
                        </div>
                    </div>
                </div>
    @endforeach
            </div>
        </div>
    </section>


@endsection
