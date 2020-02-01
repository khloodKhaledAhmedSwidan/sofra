@extends('web.layouts.main')
@section('content')
    <section class="meal-page">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="meal-desc">
                        <h1>{{$product->name}}</h1>
                        <p>{{$product->description}}</p>
                        <p><img src="{{asset('public/web/images/piggy-bank.png')}}" alt="" width="50px"> السعر
                            : {{$product->price}}</p>
                        <p><img src="{{asset('public/web/images/piggy-bank.png')}}" alt="" width="50px"> مدة تجهيز الطلب
                            : 20 دقيقة</p>
                        <p><img src="{{asset('public/web/images/piggy-bank.png')}}" alt="" width="50px"> السعر : 25 ريال
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="meal-img">
                        <img src="{{$product->photo}}" alt="meal-img" width="100%" class="meal-img">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Start Cart Section -->
    <section class="add-to-cart-sec">
        <div class="container">
            <div>
                {!!Form::open(['method'=>'get','action'=>'Web\CartController@addToCart'])!!}
                <div class="row">
                    <div class="col-md-6">
                        {{Form::hidden('product_id',$product->id)}}
                        {{Form::hidden('price',$product->price)}}
                        {{Form::hidden('restaurant_id',$product->restaurant->id)}}
                        {!! Form::text('amount',null,['class'=>'form-control','placeholder'=>'add quantatiy you want'])!!}
                        {!! Form::text('note',null,['class'=>'form-control','placeholder'=>'add special order you want'])!!}

                    </div>
                </div>
            </div>
            <button type="submit" class="add-to-cart">
                اضف الي العربة
            </button>
            {!!Form::close()!!}
            <div class="cart-info">
                <i class="fas fa-info"></i>
                <span>معلومات عن المتجر</span>
            </div>
            <div class="rate-heading">
                <h2>تقييم المستخدمين</h2>
                <span>155 تقييم</span>
            </div>
            <!-- Rates Added -->
            <div class="row">
                @forelse($comments as $comment)
                    <div class="col-md-6">
                        <div class="rate-com">
                            <ul class="list-unstyled">
                                <li class="fa fa-star star"></li>
                                <li class="fa fa-star star"></li>
                                <li class="fa fa-star star"></li>
                                <li class="fa fa-star star"></li>
                                <li class="fa fa-star star"></li>
                            </ul>
                            <h3>بواسطة :{{$comment->name}}</h3>
                            <p>{{$comment->comment}}</p>
                        </div>
                    </div>
                @empty
                    <p class="text-center">no comments</p>
                @endforelse

            </div>
            <!-- Add Rate To Service -->
            <div class="add-rate">
                <h2>اضف تقييمك</h2>
                {!! Form::open(['method'=>'post','action'=>['Web\MainController@comment',$product->id]]) !!}

                <ul class="list-unstyled">
                <span class="star-rating" id="star_rating">
   <!--RADIO 1-->
                                    <input type='checkbox' class="radio_item" value="1" name="item" id="radio1"
                                           style="display: none">
                                        <label class="label_item" for="radio1"><li class="fa fa-star star"
                                                                                   id="star1" ></li></label>

                    <!--RADIO 2-->
                                    <input type='checkbox' class="radio_item" value="2" name="item" id="radio2"
                                           style="display: none">
                                    <label class="label_item" for="radio2"><li class="fa fa-star star"
                                                                               id="star2"></li></label>

                    <!--RADIO 3-->
                                    <input type='checkbox' class="radio_item" value="3" name="item" id="radio3"
                                           style="display: none">
                                    <label class="label_item" for="radio3"><li class="fa fa-star star"
                                                                               id="star3"></li></label>


                    <!--RADIO 4-->
                                    <input type='checkbox' class="radio_item" value="4" name="item" id="radio4"
                                           style="display: none">
                                    <label class="label_item" for="radio4"><li class="fa fa-star star"
                                                                               id="star4"></li></label>

                    <!--RADIO 5-->
                                    <input type='checkbox' class="radio_item" value="5" name="item" id="radio5"
                                           style="display: none">
                                    <label class="label_item" for="radio5"><li class="fa fa-star star"
                                                                               id="star5"></li></label>
                                </span>

                </ul>
                <div class="form-group">
                    {!! Form::textarea('comment',null,['id'=>'editor','placeholder'=>'اضف تقييمك']) !!}
                </div>
                <div class="form-group">
                    {!! Form::submit('ارسال',null) !!}
                </div>


                {!! Form::close() !!}
            </div>
        </div>
    </section>
    <!-- End Add Cart Section -->

    <!-- Start More Meals Section -->
    <!-- Start More Meals Section -->
    <section class="more-meals">
        <h2>المزيد من أكلات هذا المطعم</h2>
        <div class="meals-imgs">
            <div class="container-fluid">
                <div class="slider">

                    @foreach($resProducts as $pro)

                        <div class="item">
                            <a href="{{route('product.details',$pro->id)}}">
                                <img src="{{$pro->photo}}" alt="Meal">
                            </a>
                        </div>

                    @endforeach

                </div>
            </div>
        </div>
    </section>

    @push('script')
        <script src="{{asset('public/web/js/slick.min.js')}}"></script>
        <!-- End More Meals Section -->
        <script>
            $(document).ready(function () {

                $('.star-rating input').click(function () {
                    starvalue = $(this).attr('value');

                    // iterate through the checkboxes and check those with values lower than or equal to the one you selected. Uncheck any other.


                    for (i = 1; i <= 5; i++) {
                        if (i <= starvalue) {
                            $("#radio" + i).prop('checked', true);
                            $("#star" + i).css('font-weight', 'bolder');
                            // $("#star" + i).css('font-size', '20px');
                        } else {
                            $("#radio" + i).prop('checked', false);
                            $("#star" + i).css('font-weight', '100');
                            // $("#star" + i).css('font-size', '15px');
                        }
                    }
                });
                // $('.from').datepicker({
                //     uiLibrary: 'bootstrap4'
                // });
                //
                // $('.to').datepicker({
                //     uiLibrary: 'bootstrap4'
                // });



            });

            $('.slider').slick({
                dots: false,
                infinite: true,
                speed: 300,
                slidesToShow: 4,
                autoplay: false,
                slidesToScroll: 1,
                arrows: false,
                rtl: true,
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1,
                            infinite: true,
                            dots: false
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1,
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                    // You can unslick at a given breakpoint now by adding:
                    // settings: "unslick"
                    // instead of a settings object
                ]
            });

        </script>

        {{--    <script>--}}
        {{--        var ratedIndex = -1;--}}
        {{--        $(document).ready(function () {--}}
        {{--            resetStarColors();--}}
        {{--            if (localStorage.getItem('ratedIndex') != null)--}}
        {{--                setStars(parseInt(localStorage.getItem('ratedIndex')));--}}
        {{--            $('.fa-star').on('click',function () {--}}
        {{--                ra  tedIndex = parseInt($(this).data('index'));--}}
        {{--                localStorage.setItem('ratedIndex',ratedIndex);--}}
        {{--            });--}}
        {{--            $('.fa-star').mouseover(function () {--}}

        {{--                resetStarColors();--}}
        {{--                var currentIndex = parseInt($(this).date('index'));--}}
        {{--                setStars(currentIndex);--}}
        {{--            });--}}
        {{--            $('.fa-star').mouseleave(function () {--}}
        {{--                resetStarColors();--}}
        {{--                if (ratedIndex != -1)--}}
        {{--                    setStars(ratedIndex);--}}

        {{--            });--}}
        {{--            function  setStars(max) {--}}
        {{--                for (var i=0;i <= max; i++)--}}
        {{--                    $('.fa-star:eq(' + i + ')').css('color', 'green');--}}
        {{--            }--}}
        {{--            function resetStarColors() {--}}
        {{--                $('.fa-star').css('color', 'white');--}}
        {{--            }--}}
        {{--        });--}}


        {{--    </script>--}}


    @endpush

@endsection




