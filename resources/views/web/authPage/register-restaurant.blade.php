@extends('web\layouts\main')

@section('content')


<div class="container">

    @include('web.includes.errors')

</div>

    <!-- start talabaty section -->
    <div class="container">
        <section class=" register-page py-5 my-5">
            <div class="reg1 mx-auto my-5">
                <div><img src="{{asset('public/web/images/use-img.png')}}" alt="user"></div>
                <!--p-5 my-3 text-center -->

                {!! Form::open(['method'=>'POST','action'=>'Web\AuthController@registerRestaurant','files' => true,'class'=>'p-5 my-3 text-center']) !!}

                    {!! Form::text('name',null,['class'=>'form-control my-4','placeholder'=>'enter your name']) !!}


                    {!! Form::email('email',null,['class'=>'form-control my-4','placeholder'=>'enter your email']) !!}


                    {!! Form::text('phone',null,['class'=>'form-control my-4','placeholder'=>'enter your phone ']) !!}


                    {!! Form::select('region_id',[''=>'choose Region']+$region,null,['class'=>'form-control my-4']) !!}



                    {!! Form::password('password',null,['class'=>'form-control my-4','placeholder'=>'enter your password']) !!}


                    {!! Form::password('password_confirmation',null,['class'=>'form-control my-4','placeholder'=>'confirm your password']) !!}



                    {!! Form::select('category_id[]',[''=>'choose category']+$categories,null,['class'=>'form-control my-4','multiple' => 'multiple']) !!}


                    {!! Form::text('minimum',null,['class'=>'form-control my-4','placeholder'=>'enter  minimum ']) !!}


                    {!! Form::text('processing_time',null,['class'=>'form-control my-4','placeholder'=>'enter  processing time ']) !!}


                    {!! Form::text('delivery_charge',null,['class'=>'form-control my-4','placeholder'=>'enter  delivery charge ']) !!}


                    {!! Form::text('whatsapp',null,['class'=>'form-control my-4','placeholder'=>'enter your whatsapp number ']) !!}


{!! Form::label('photo','photo of restaurant') !!}
                    {!! Form::file('photo',null,['class'=>'form-control my-4','placeholder'=>'enter your phone ']) !!}


                    {!! Form::submit('Submit',['class'=>'btn  btn-success my-4']) !!}




                {!! Form::close() !!}


            </div>
        </section>
    </div>




@endsection
