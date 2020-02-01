@extends('admin\layouts\main')
@section('content')



    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Sofra</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard v1</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">

                <div class="row">



                    <table class="table table-striped table-dark">
                        <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Description</th>


                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th>photo</th>
                            <td><img src="{{isset($restaurant->photo)?$restaurant->photo:'no photo'}}" alt="no photo"></td>

                        </tr>
                        <tr>
                            <th>name</th>
                            <td>{{$restaurant->name}}</td>

                        </tr>

                        <tr>
                            <th>Email</th>
                            <td>{{$restaurant->email}} </td>
                        </tr>
                        <tr>
                            <th>phone </th>
                            <td>{{$restaurant->phone}}</td>
                        </tr>
                        <tr>
                            <th>Region </th>
                            <td>{{optional($restaurant->region)->name}}</td>
                        </tr>

                        <tr>
                            <th>minimum </th>
                            <td>{{$restaurant->minimum}}</td>
                        </tr>
                        <tr>
                            <th>delivery charge </th>
                            <td>{{$restaurant->delivery_charge}}</td>
                        </tr>
                        <tr>
                            <th>availability </th>
                            <td >{{($restaurant->availability == 0)?'closed':'open'}}</td>
                        </tr>


                        <tr>
                            <th>	photo </th>
                            <td ><img src="{{isset($restaurant->photo)?$restaurant->photo:'no photo'}}"></td>
                        </tr>

                        <tr>
                            <th>processing time </th>
                            <td >{{$restaurant->processing_time}}</td>
                        </tr>
                        <tr>
                            <th>whatsapp </th>
                            <td >{{$restaurant->whatsapp}}</td>
                        </tr>
                        <tr col="2">


                            {!! Form::model($restaurant,['route'=>['restaurants.destroy',$restaurant->id],'method'=>'DELETE']) !!}
                            <div class="form-group">
                                {!! Form::submit('Delete',['Class'=>'btn btn-danger btn-sm']) !!}
                            </div>
                            {!! Form::close() !!}
                        </tr>
                        </tbody>
                    </table>

                </div>
                <div class="row">
                    <a class="btn btn-dark" href="{{route('restaurants.index')}}">All Restaurants</a>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

@endsection
