@extends('web\layouts\main')
@section('top_nav')

    <section id="header">
        <div class="container">
            <div class="header-desc">
                <img class="website-name" src="images/res-img.png" alt="" style="margin: 0 auto;">
                <h1 class="res-name">{{auth('site_restaurant')->user()->name}} </h1>
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


<div>
    @if(Session::has('success'))
        {{Session::get('success')}}
    @endif
</div>
    <section class="food">
        <div class="container">
            <div class="row text-center">
                <div class="col-sm-12">
                    <h1><a href="">قائمة الطعام</a>/ <span>منتجاتى</span></h1>
                </div>
                <div class="col-sm-12">
                    <a href="{{route('restaurant-products.create')}}" class="btn minu-btn my-5 px-5">اضف منتج جديد</a>
                </div>
            </div>
            <div class="row">

                @forelse($products as $product)
                <div class="col-sm-4">


                        <div class="item-holder">
                            <img src="{{$product->photo}}" alt="item-image" width="100%">
                            <div class="item-data text-center">
                                <h3 class="item-title">{{$product->name}}</h3>
                                <p class="item-description">{{$product->description}}</p>
                            </div>
                            <div class="features">
                                <div>
                                    <img src="images/piggy-bank.png" alt="" width="30px;">
                                    <span class="delevery-time">
                                    {{$product->price}}
                                </span>
                                </div>
                            </div>

                            <div class="closed">

                                {!! Form::model($product,['method'=>'DELETE','action'=>['Web\ProductController@destroy',$product->id]]) !!}
                                {!! Form::submit('x',['class'=>'far fa-times-octagon']) !!}
                                {!! Form::close() !!}
                                <a href="{{route('restaurant-products.edit',$product->id)}}" class="far fa-edit small-box"></a>

                            </div>
                        </div>
                </div>
                @empty
                    <a href="{{route('restaurant-products.create')}}" class="btn btn-info"><p>Add Product</p>
                    </a>

                @endforelse

            </div>


        </div>
    </section>


@endsection
