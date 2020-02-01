@extends('web\layouts\main')
@section('top_nav')
@inject('restaurantSearch',App\Models\Restaurant)
@inject('region',App\Models\Region)
    <header class="text-center">
        <div class="container">

            <div class="header-content">
                <h1>سفرة</h1>
                <p>بتشتري...بتبيع؟ كله عند ام ربيع</p>

         @if(!(auth('site_client')->user()))
                <a class="register main-btn" href="{{route('WebLogin.page')}}">
                    <span>سجل الأن</span>
                    <i class="fa fa-code"></i>
                </a>
           @endif

            </div>

        </div>
    </header>

@endsection
@section('content')


    <!-- Start Favs Resturants Section -->
    <section class="favs text-center bg-gry">
        <div class="container">
            <h2>ابحث عن مطعمك المفضل</h2>
            <div class="row">
                <div class="col-md-6">
                    <div class="select-box">


                        {!! Form::open(['method'=>'get' ,'class'=>'select-box']) !!}

                        <button type="submit"><i class="fa fa-search"></i></button>
                        {!! Form::select('region',[$region->pluck('name','id')->toArray()],null,['class'=>'form-control input-lg']) !!}

                        {!! Form::close() !!}

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="">
                        {!! Form::open(['method'=>'get' ,'class'=>'select-box']) !!}

                        <button type="submit"><i class="fa fa-search"></i></button>
                        {!! Form::select('name',[$restaurantSearch->pluck('name','id')->toArray()],null,['class'=>'form-control input-lg']) !!}

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <div class="text-center text-bold">
                @if (session('alert'))
                    <div class="alert alert-success">
                        {{ session('alert') }}
                    </div>
                @endif
            </div>

            <div class="row">
                @forelse($restaurants as $res)
                <div class="col-md-6">
                    <div class="box text-center">
                        <div class="row">
                            <div class="col-md-4">
                                <img src="{{asset('public/'.$res->photo)}}" alt="Favs">
                            </div>
                            <div class="col-md-4">
                                <h3><a href="{{route('product.page',$res->id)}}">{{$res->name}}</a></h3>
                                <ul class="list-unstyled stars">
                                    <li class="active">
                                        <i class="fa fa-star"></i>
                                    </li>
                                    <li class="active">
                                        <i class="fa fa-star"></i>
                                    </li>
                                    <li class="active">
                                        <i class="fa fa-star"></i>
                                    </li>
                                    <li>
                                        <i class="fa fa-star"></i>
                                    </li>
                                    <li>
                                        <i class="fa fa-star"></i>
                                    </li>
                                </ul>
                                <p>الحد الادني للطلب <span>{{$res->minimum}}</span> ريال</p>
                                <p>رسوم التوصيل : <span>{{$res->delivery_charge}}</span> ريال</p>
                            </div>
                            <div class="col-md-4">
                                <span class="status" rel=".{{$res->is_active}}.">{{$res->is_active ==  1?'مفتوح':'مغلق'}}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                    <p class="text-center">no restaurants</p>
                @endforelse
            </div>
{{$restaurants->appends(request()->query())->links()}}
        </div>
    </section>
@endsection


