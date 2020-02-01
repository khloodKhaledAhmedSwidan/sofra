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

                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    {!! Form::open(['method'=>'get']) !!}
                    <div class="form-group">
                        {!! Form::text('search',null,['class'=>'form-control','placeholder'=>'search']) !!}
                        {!! Form::submit('Search',['class'=>'btn btn-default btn-sm']) !!}
                    </div>

                    {!! Form::close() !!}
                </div>
                <div class="row">

                    <table class="table table-striped table-dark">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">from</th>
                            <th scope="col">to</th>
                            <th scope="col">restaurant name</th>

                            <th scope="col">Show</th>
                            <th scope="col">Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($offers as $offer)
                            <tr id="remove{{$offer->id}}">
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$offer->name}}</td>
                                <td>{{$offer->from}}</td>
                                <td>{{$offer->to}}</td>
                                <td>{{optional($offer->restaursnts)->name}}</td>
                                <td><a class="btn btn-info btn-sm" href="{{route('offers.show',$offer->id)}}">Show</a>
                                </td>

                                <td>
                                    <a href="javascript:void(0)"
                                       onclick="deleteData('offers',{{$offer->id}})"
                                       class="btn btn-xs btn-danger"><i
                                            class="fa fa-trash"></i> Delete</a>
                                </td>

                            </tr>

                        @empty
                            <p class="text-center">No Offers</p>
                        @endforelse
                        </tbody>
                    </table>

                    {{$offers->appends(request()->query())->links()}}


                </div>


            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

@endsection
