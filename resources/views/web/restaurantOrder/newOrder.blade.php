@extends('web\layouts\main')

@section('content')
    <!-- start talabaty section -->
    <section class="orders">
        <div class="order-state py-5 d-flex">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="text-left"><a href="{{route('current.orders')}}">طلبات حالية</a></h5>
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
                                <p class="py-1"> العميل : <span> {{optional($order->client)->name}} </span></p>

                                <p class="py-1 mncolor">المجموع : <span>{{$order->net}}</span> ريال</p>
                                <p class="py-1 mncolor">العنوان : <span>{{$order->client->region->name}},{{$order->client->region->city->name}}</span></p>
                            </div>
                            <div class="col mb-4">
                                <button class="btn bg-mncolor mx-3 px-5">اتصال</button>


                                    <a href="{{url('sofra/order/'.$order->id.'/accepted')}}"
                                       class="btn btn-success mx-3 px-5">accepted</a>


                                    <a href="{{url('sofra/order/'.$order->id.'/rejected')}}" class="btn btn-refuse mx-3 px-5">rejected</a>



                            </div>
                        </div>
                    </div>
                @empty
                    <div class="container">
                        <div class="order-current my-5">
                    <p class="text-bold text-center">no orders</p>
                        </div>
                    </div>
                @endforelse

            </div>
        </div>
    </section>
    <!-- start footer section -->

@endsection
