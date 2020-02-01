@extends('web\layouts\main')

@section('content')





    <!-- Start Offers Section -->

    <section class="offers">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h1>العروض المتاحه الان</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 text-center">
                    <a href="{{route('restaurant-offers.create')}}" class="btn minu-btn my-5 px-5">اضف عرضا جديداً</a>
                </div>
            </div>
            <div class="row">
                @forelse($offers as $offer)
                <div class="col-sm-6">
                    <a href="{{route('restaurant-offers.show',$offer->id)}}"><img src="{{$offer->photo}}" alt="" width="100%"><p class="text-center font-weight-bold">{{$offer->name}}</p></a>
                    <a href="{{route('restaurant-offers.edit',$offer->id)}}" class="fa fa-edit"></a>
                   <div class="closed">
                       {!! Form::model($offer,['method'=>'DELETE','action'=>['Web\OfferController@destroy',$offer->id]]) !!}
                       {!! Form::submit('حذف',['class'=>'far fa-times-octagon']) !!}
                       {!! Form::close() !!}

                   </div>

                </div>

              @empty
                    <p>no offers available now</p>
                @endforelse
            </div>
        </div>
    </section>



@endsection
