@extends('web\layouts\main')
@section('top_nav')

    <section id="header">
        <div class="container">
            <div class="header-desc">
                <img class="website-name" src="{{$restaurant->photo}}" alt="" style="margin: 0 auto;">
                <h1 class="res-name">{{$restaurant->name}}</h1>
                <ul class="list-unstyled">
                    <li class="fa fa-star"></li>
                    <li class="fa fa-star"></li>
                    <li class="fa fa-star"></li>
                    <li class="fa fa-star"></li>
                    <li class="fa fa-star"></li>
                </ul>
            </div>
        </div>
    </section>


@endsection
@section('content')

    <section class="food">
        <div class="container">


            <div class="row">
                @forelse($products as $product)
                <div class="col-sm-4">
                    <div class="item-holder">
                        <img src="{{$product->photo}}" alt="item-image" width="100%">
                        <div class="item-data text-center">
                            <h3 class="item-title">{{$product->name}}</h3>
                            <p class="item-description">البرجر ده جامد جدا خالص</p>
                        </div>
                        <div class="features">
                            <div>
                                <img src="images/piggy-bank.png" alt="" width="30px;">
                                <span class="delevery-time">
                                    30 دقيقة تقريبا
                                </span>
                            </div>
                            <div>
                                <img src="images/piggy-bank.png" alt="" width="30px;">
                                <span class="delevery-time">
                                    55 ريال
                                </span>
                            </div>
                            <a href="{{route('product.details',$product->id)}}" class="d-block">اضغط للتفاصيل</a>
                        </div>
                    </div>
                </div>
                @empty
                    <p class="text-center">no products in this restaurant</p>
                @endforelse


        </div>

    </section>



@endsection
