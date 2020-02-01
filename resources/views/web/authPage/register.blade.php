@extends('web\layouts\main')

@section('content')




    <!-- start talabaty section -->
    <div class="container">
        <section class=" register-page py-5 my-5">
            <div class="reg1 mx-auto my-5">
                <div><img src="{{asset('public/web/images/use-img.png')}}" alt="user"></div>
                <!--p-5 my-3 text-center -->

                {!! Form::open(['method'=>'POST','action'=>'Web\AuthController@registerClient','files' => true]) !!}
                <div class="form-group">
                    {!! Form::text('name',null,['class'=>'form-control my-4','placeholder'=>'enter your name']) !!}
                </div>
                <div class="form-group">
                    {!! Form::email('email',null,['class'=>'form-control my-4','placeholder'=>'enter your email']) !!}
                </div>
                <div class="form-group">
                    {!! Form::text('phone',null,['class'=>'form-control my-4','placeholder'=>'enter your phone ']) !!}
                </div>
                <div class="form-group">
                    {!! Form::select('region_id',[''=>'choose Region']+$region,null,['class'=>'form-control my-4']) !!}
                </div>
                <div class="form-group">

                    {!! Form::file('photo',null,['class'=>'form-control my-4','placeholder'=>'enter your phone ']) !!}
                </div>
                <div class="form-group">
                    {!! Form::password('password',null,['class'=>'form-control my-4','placeholder'=>'enter your password']) !!}
                </div>
                <div class="form-group">
                    {!! Form::password('password_confirmation',null,['class'=>'form-control my-4','placeholder'=>'confirm your password']) !!}
                </div>

           <div class="form-group">
                    {!! Form::submit('Submit',['class'=>'btn btn-success']) !!}

           </div>


{!! Form::close() !!}


                        </div>
                    </section>
                </div>




@endsection
