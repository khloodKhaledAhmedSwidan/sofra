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
                            <td><img src="{{$offer->photo}}" alt="no photo"></td>

                        </tr>
                        <tr>
                            <th>name</th>
                            <td>{{$offer->name}}</td>

                        </tr>

                        <tr>
                            <th>from-to</th>
                            <td>from :{{$offer->from}} to :{{$offer->to}}   </td>
                        </tr>
                        <tr>
                            <th>restaurant name </th>
                            <td>{{optional($offer->restaursnts)->name}}</td>
                        </tr>
                        <tr>
                            <th>description </th>
                            <td>   <textarea class="table-dark border-0 col-xl-11"  >{{$offer->description}}</textarea></td>
                        </tr>


                        <tr col="2">


                            {!! Form::model($offer,['route'=>['offers.destroy',$offer->id],'method'=>'DELETE']) !!}
                            <div class="form-group">
                                {!! Form::submit('Delete',['Class'=>'btn btn-danger btn-sm']) !!}
                            </div>
                            {!! Form::close() !!}
                        </tr>
                        </tbody>
                    </table>

                </div>
                <div class="row">
                    <a class="btn btn-dark" href="{{route('offers.index')}}">All Offers</a>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

@endsection
