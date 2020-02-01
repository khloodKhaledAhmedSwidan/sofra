<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css"
          integrity="sha384-vus3nQHTD+5mpDiZ4rkEPlnkcyTP+49BhJ4wJeJunw06ZAp+wzzeBPUXr42fi8If" crossorigin="anonymous">
    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="{{asset('public/web/css/style.css')}}">
    <!-- Custom fonts  -->
    <link href="https://fonts.googleapis.com/css?family=Cairo:400,600,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
          integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <title>Sofra</title>
    {{--    <script--}}
    {{--        src="https://code.jquery.com/jquery-3.4.1.min.js"--}}
    {{--        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="--}}
    {{--        crossorigin="anonymous"></script>--}}
    <style>
        .star {
            color: gold;
            font-weight: 100;
        }
    </style>
</head>

<body>

<!--==============navbar section=======-->
<div class="container-fluid">
    <div class="row">
        <nav class="navbar navbar-light" style="background-color: #ECECEC;">
            <div class="col-md-4 col-sm-12">
                <div class="dropdown">
                    <i class="fas fa-shopping-cart dropbtn">  </i>
                        @if(Session::get('cart'))
                            @foreach(Session::get('cart') as $cart)
                                <div class="dropdown-content">


                                    @inject('p','App\Models\Product')
                                    @php
                                        $product = $p->findOrFail($cart['product_id']);
                                    @endphp


                                    <a href="{{route('list.cart')}}">{{$product->name}}</a>
                                </div>

                            @endforeach
                        @endif

                </div>
                <div class="dropdown">
                    <i class="fas fa-user-circle dropbtn "></i>
                    @if(auth('site_restaurant')->user())
                        <div class="dropdown-content">
                            <a href="{{route('restaurant-products.index')}}">products</a>
                            <a href="{{route('restaurant-offers.index')}}">offers</a>
                            <a href="{{route('restaurant.newOrder')}}"> new Order</a>
                            <a href="{{route('prev.orders')}}"> previos Order</a>
                            <a href="{{route('current.orders')}}"> current Order</a>
                            <a href="{{route('restaurant.profilePage')}}">Edit Profile</a>
                        </div>
                    @endif
                    @if(auth('site_client')->user())
                        <div class="dropdown-content">


                            <a href="{{url('sofra/offers')}}">offers</a>
                            @if(auth()->guard('site_client')->check())
                                <a href="{{route('order.page')}}">new Order</a>
                                <a href="{{route('previous.orders')}}">previous Orders</a>
                                <a href="{{url(route('client.profilePage'))}}">Edit Profile</a>
                            @endif
                            <a href="{{route('contactUs.form')}}">contact us</a>
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-md-4 col-sm-12 logo-up">
                <img class="logo" src="{{asset('public/web/images/sofra%20logo-1@2x.png')}}">
            </div>
            <div class="col-md-4 col-sm-12 burger">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample01"
                        aria-controls="navbarsExample01" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-hamburger"></i>
                </button>
            </div>


            <div class="collapse navbar-collapse " id="navbarsExample01">
                <ul class="navbar-nav custom">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{route('main.page')}}">Home <span
                                class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        @if(auth('site_client')->user() || auth('site_restaurant')->user())
                            <form id="frm-logout" action="{{ url('client-logout') }}" method="POST">
                                {{ csrf_field() }}
                                <button class="dropdown-item" style="cursor: pointer">
                                    Logout
                                </button>
                            </form>
                        @endif
                    </li>


                </ul>

            </div>
        </nav>
        {{--        @php dd(auth('site_client')->user()) @endphp--}}
        {{--        @php dd(auth('site_restaurant')->user()) @endphp--}}
    </div>
</div>
