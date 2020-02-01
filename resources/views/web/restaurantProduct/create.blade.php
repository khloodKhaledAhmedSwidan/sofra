@extends('web\layouts\main')

@section('content')








    <section class="add-new-section">
        <div class="container">
            <div class="row">
                <div class="row">
                    @include('web.includes.errors')
                </div>
                <div class="col-sm-6 offset-sm-3">
                    <h1 class="text-center form-title">اضف منتج جديد</h1>

                    {!! Form::open(['method'=>'POST','action'=>'Web\ProductController@store','files' => true]) !!}
                    <div class="img-input">
                        <div class="img">

                            {!! Form::file('photo',null,['class'=>'form-control my-4','placeholder'=>'enter your phone ']) !!}
                        </div>
                        <p>صورة المنتج</p>
                    </div>
                    <div class="form-group">
                        {!! Form::text('name',null,['class'=>'form-control my-4','placeholder'=>'اسم المنتج']) !!}
                    </div>
                        <div class="form-group">
                        {!! Form::textarea('description', null, ['class'=>'form-control my-4','placeholder'=>'وصف مختصر ']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::text('price',null,['class'=>'form-control my-4','placeholder'=>'سعر المنتج']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::text('price_on_offer',null,['class'=>'form-control my-4','placeholder'=>' سعر المنتج في العرض']) !!}
                    </div>
                    <div class="input-group d-flex date">

                        <div class="form-group align-self-center">
                            {!! Form::submit('اضافة',['class'=>'btn btn-success add-new-link center']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}


                </div>
            </div>
        </div>
    </section>



@endsection
