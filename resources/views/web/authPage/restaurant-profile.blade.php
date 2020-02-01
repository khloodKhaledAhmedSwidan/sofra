@extends('web\layouts\main')

@section('content')
    <div class="text-center"><p>@include('web.includes.errors')</p></div>

    <div class="container">
        <section class=" register-page py-5 my-5">
            <div class="reg1 mx-auto my-5">

                {!! Form::model($restaurant,['method'=>'PATCH','action'=>['Web\AuthController@restaurantProfile',$restaurant->id],'files' => true]) !!}
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
                    {!! Form::select('region_id',$region,null,['class'=>'form-control my-4']) !!}
                </div>

                <div class="form-group">
                    {!! Form::password('password',null,['class'=>'form-control my-4','placeholder'=>'enter your password']) !!}
                </div>
                <div class="form-group">
                    {!! Form::password('password_confirmation',null,['class'=>'form-control my-4','placeholder'=>'confirm your password']) !!}
                </div>

                <div class="form-group">
                    {!! Form::select('category_id[]',$categories,null,['class'=>'form-control my-4','multiple' => 'multiple']) !!}
                </div>
                <div class="form-group">
                    {!! Form::text('minimum',null,['class'=>'form-control my-4','placeholder'=>'enter  minimum ']) !!}
                </div>
                <div class="form-group">
                    {!! Form::text('processing_time',null,['class'=>'form-control my-4','placeholder'=>'enter  processing time ']) !!}
                </div>
                <div class="form-group">
                    {!! Form::text('delivery_charge',null,['class'=>'form-control my-4','placeholder'=>'enter  delivery charge ']) !!}
                </div>
                <div class="form-group">
                    {!! Form::text('whatsapp',null,['class'=>'form-control my-4','placeholder'=>'enter your whatsapp number ']) !!}
                </div>
                <div class="form-group">
                    <div><img src="{{$restaurant->photo}}" alt="user"></div>
                    {!! Form::file('photo',null,['class'=>'form-control my-4','placeholder'=>'enter your phone ']) !!}
                </div>
                <div class="form-group">
                    {!! Form::submit('Edit',['class'=>'btn btn-success']) !!}

                </div>


                {!! Form::close() !!}
            </div>
        </section>
    </div>






@endsection
