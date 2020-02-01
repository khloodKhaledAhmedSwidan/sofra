@extends('web\layouts\main')

@section('content')



    <div class="container">
        <section class=" register-page py-5 my-5">
            <div class="reg mx-auto my-5">
                <div><img src="{{asset('public/web/images/use-img.png')}}" alt="user"></div>

                {!! Form::open(['method'=>'POST','action'=>'Web\AuthController@restaurantlogin','class'=>'p-5 my-3 text-center']) !!}


                    {!! Form::email('email',null,['class'=>'form-control my-4','placeholder'=>'enter your email']) !!}




                    {!! Form::password('password',null,['class'=>'form-control my-4','placeholder'=>'enter your password']) !!}

                <button type="submit" class="btn w-75 my-4 text-white">دخول</button>

                <div class="form-row my-3">
                    <div class="col new-user">

                        <a href="{{route('register.formRestaurant')}}" class="text-success">مستخدم جديد </a>
                    </div>
                    <div class="col pass">
                        <a href="">نسيت كلمة السر ؟</a>
                    </div>
                </div>
                <button type="submit" class="btn w-75 my-4 text-white">انشيء حساب الآن</button>
                {!! Form::close() !!}
            </div>
        </section>
    </div>


@endsection
