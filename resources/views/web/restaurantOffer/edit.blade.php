@extends('web\layouts\main')

@section('content')








    <section class="add-new-section">
        <div class="container">
            <div class="row">
                <div class="row">
                    @include('web.includes.errors')
                </div>
                <div class="col-sm-6 offset-sm-3">
                    <h1 class="text-center form-title">اضف عرض جديد</h1>

                    {!! Form::model($offer,['method'=>'PATCH','action'=>['Web\OfferController@update',$offer->id,'files' => true]]) !!}
                    <div class="img-input">
                        <div class="img">
                            <img src="{{$offer->photo}}">
                            {!! Form::file('photo',null,['class'=>'form-control my-4','placeholder'=>'enter your phone ']) !!}
                        </div>
                        <p>صورة العرض</p>
                    </div>
                    <div class="form-group">
                        {!! Form::text('name',null,['class'=>'form-control my-4','placeholder'=>'اسم العرض ']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::textarea('description', null, ['class'=>'form-control my-4','placeholder'=>'وصف مختصر ']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::text('cost',null,['class'=>'form-control my-4','placeholder'=>'سعر العرض']) !!}
                    </div>
                    <div class="input-group d-flex date">
                        <div>
                            {!! Form::text('from',null,['class'=>'from','placeholder'=>'من']) !!}
                        </div>
                        <div>
                            {!! Form::text('to',null,['class'=>'to','placeholder'=>'الى']) !!}
                        </div>
                        <div class="form-group align-self-center">
                            {!! Form::submit('تعديل',['class'=>'btn btn-success add-new-link center']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}


                </div>
            </div>
        </div>
    </section>



@endsection
