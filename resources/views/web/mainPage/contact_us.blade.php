@extends('web\layouts\main')

@section('content')

    <section class="contact-us">
        <div class="container">


                {!! Form::open(['method'=>'post','action'=>'Web\MainController@contactUs','class'=>'contact-info']) !!}
                <h1 class="text-center form-title">تواصل معنا</h1>
                    <div class="input-group">
                        {!! Form::text('name',null,['placeholder'=>'الاسم']) !!}
                        {!! Form::email('email',null,['placeholder'=>'البريد']) !!}
                        {!! Form::text('phone',null,['placeholder'=>'الجوال']) !!}
                        {!! Form::textarea('message',null,['placeholder'=>'ما هي رسالتك']) !!}
                    </div>


          <div class="input-group buttons">
              <label class="d-flex flex-row"><span>اقتراح</span> {!! Form::radio('type','suggest') !!}</label>
              <label class="d-flex flex-row"><span>استعلام</span>   {!! Form::radio('type','Inquire') !!}</label>
              <label class="d-flex flex-row"><span>شكوى</span> {!! Form::radio('type','complaint') !!}</label>
          </div>

                        {!! Form::submit('اضافة',['class'=>'add-new-link']) !!}



                {!! Form::close() !!}


        </div>
    </section>



@endsection
<script>
    var msg = '{{Session::get('alert')}}';
    var exist = '{{Session::has('alert')}}';
    if(exist){
        alert(msg);
    }
</script>
