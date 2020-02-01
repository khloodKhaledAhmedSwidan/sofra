@extends('web\layouts\main')

@section('content')
    {{--@php dd($cart); @endphp--}}

    <section class="cart">
        <div class="row"><p class="text-bold text-center">
            @if(Session::has('message'))
                <p class="alert alert-info">
                    {{ Session::get('message') }}
                </p>
            @endif
        </div>
        <div class="container">
            <div class="row">
                <div class="col-sm-6 offset-sm-3">





                    @if(!empty(session('cart')))
                        <a href="{{route('send.AllCart')}}" class="add-new-link">Send Orders</a>
                        @php$cart = Session::get('cart'); @endphp
                        @foreach(Session::get('cart') as $cart)

                        <div class="cart-item">
                            <div class="row">
                                <div class="col-sm-5">
                                    <img src="" alt="">
                                </div>

                                <div class="col-sm-7">
                                    @inject('p','App\Models\Product')
                                    @php
                                        $product = $p->findOrFail($cart['product_id']);
                                    @endphp
                                    <p>{{$product->name}}</p>


                                    <p>{{$cart['price']}} ريال</p>
                                    <p>البائع : wild burger</p>
                                    <p>الكيمه : <span>{{$cart['amount']}}</span></p>
                                    <a href="{{url('sofra/delete-item-cart/'.$cart['product_id'])}}"
                                       class="add-new-link"><span class="cricle">X</span> امسح</a>
                                    {{--                                     delete post method--}}
                                    {{--                                    {!! Form::model($cart,['method'=>'DELETE','route'=>'remove.cart']) !!}--}}
                                    {{--                                    {!! Form::hidden('product_id', $cart['product_id']) !!}--}}
                                    {{--                                        {!! Form::submit('delete',['class'=>'add-new-link']) !!}--}}
                                    {{--                                    {!! Form::close() !!}--}}



                                    {{Form::model($cart,['method'=>'post','route'=>'send.orders'])}}
                                    {!! Form::hidden('product_id', $cart['product_id']) !!}
                                    {!! Form::hidden('amount', $cart['amount']) !!}
                                    {!! Form::hidden('price', $cart['price']) !!}
                                    {!! Form::hidden('note', $cart['note']) !!}
                                    {!! Form::hidden('restaurant_id', session('restaurant')) !!}
                                    {!! Form::submit('تأكيد الطلب', ['class'=>'add-new-link']) !!}
                                    {{Form::close()}}



                                </div>


                            </div>
                        </div>
                    @endforeach


                            <a href="{{url('sofra/products/'.session('restaurant'))}}" class="add-new-link fa-pull-left">Add more orders</a>

                            <a href="{{route('remove.allCart')}}" class="add-new-link fa-pull-right">delete all cart</a>
                    @else
                        <div>لا يوجد</div>
                    @endif

                </div>
            </div>
        </div>
    </section>


@endsection
