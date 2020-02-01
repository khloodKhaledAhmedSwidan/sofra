@extends('web\layouts\main')

@section('content')

    <section class="contact-us">
        <div class="container">

                {!! Form::model($client,['method'=>'PATCH','action'=>['Web\AuthController@clientProfile',$client->id],'files' => true,'class'=>'contact-info']) !!}
            <div class="text-center my-3"><i class="fas fa-user-circle"></i></div>

                <div class="input-group">
                    {!! Form::text('name',null,['placeholder'=>'enter your name']) !!}
                    {!! Form::email('email',null,['placeholder'=>'enter your email']) !!}
                    {!! Form::text('phone',null,['placeholder'=>'enter your phone ']) !!}
                    {!! Form::select('region_id',$region,null,['class'=>'input-group']) !!}
                    {!! Form::password('password',null,['placeholder'=>'enter your password']) !!}
                    {!! Form::password('password_confirmation',null,['placeholder'=>'confirm your password']) !!}
                    {!! Form::text('minimum',null,['placeholder'=>'enter  minimum ']) !!}
                    {!! Form::text('processing_time',null,['placeholder'=>'enter  processing time ']) !!}
                    {!! Form::text('delivery_charge',null,['placeholder'=>'enter  delivery charge ']) !!}
                    {!! Form::text('whatsapp',null,['placeholder'=>'enter your whatsapp number ']) !!}
                    <div><img src="{{$client->photo}}" alt="user"></div>
                    {!! Form::file('photo',null,['placeholder'=>'enter your phone ']) !!}

                </div>


                    {!! Form::submit('Edit',['class'=>'add-new-link']) !!}



                {!! Form::close() !!}
            </div>
        </section>







@endsection
