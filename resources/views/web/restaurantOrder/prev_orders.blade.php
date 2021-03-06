@extends('web\layouts\main')

@section('content')



    <!-- start talabaty section -->
    <section class="orders">
        <div class="order-state py-5 d-flex">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="text-left"><a href="{{route('restaurant.newOrder')}}">طلبات حالية</a></h5>
                    </div>
                    <div class="col-md-6">
                        <h5 class="text-right"><a href="{{route('prev.orders')}}">طلبات سابقة</a></h5>
                    </div>
                </div>
            </div>
        </div><!--End order-state-->
        <div class="order-details">
            <div class="container">
         @forelse($orders as $order)
                <div class="order-current my-5">
                    <div class="row text-center">
                        <div class="col-md-3 py-3 px-4">
                            <img src="images/user-photo.png" class="img-fluid" alt="">
                        </div>
                        <div class="col-md-8 pt-3 text-left">

                            <p class="py-1"> العميل : <span>{{optional($order->client)->name}} </span></p>

                            <p class="py-1 mncolor">المجموع :  <span>{{$order->net}}</span> ريال</p>
                            <p class="py-1 mncolor">العنوان :  <span>{{$order->client->region->name}},{{$order->client->region->city->name}}</span></p>
                        </div>
                        <div class="col mb-4">
                            <p class="mx-3 px-5 mncolor" >{{($order->state) == 'delivered' ? 'تم تسليم الطلب' :'تم رفض الطلب'}}</p>
                        </div>
                    </div>
                </div>
             @empty
                    <div class="my-5">
                        <div class="col-md-3 py-3 px-4"></div>
                        <div class="col-md-8 pt-3 text-left">

                        </div>

                    </div>
             @endforelse

            </div>
        </div>
    </section>

@endsection
