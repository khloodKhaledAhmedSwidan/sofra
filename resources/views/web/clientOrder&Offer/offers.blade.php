@extends('web\layouts\main')

@section('content')


    <section class="offers">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h1>العروض المتاحه الان</h1>
                </div>
            </div>
            <div class="row">
                @foreach($offers as $offer)
                <div class="col-sm-6">

                    <a href="{{url('sofra/products/'.$offer->restaurant_id)}}"><img src="{{asset($offer->photo)}}" alt="" width="50%"></a>
                    <p class="text-center">{{$offer->description}}</p>

                </div>
                @endforeach


            </div>
        </div>
    </section>


@endsection
