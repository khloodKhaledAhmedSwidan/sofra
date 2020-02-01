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
                            <th scope="col">restaurant </th>
                            <th scope="col">client</th>
                            <th scope="col">cost</th>

                            <th scope="col">commission</th>
                            <th scope="col">state</th>
                            <th scope="col">Show</th>
                            <th scope="col">Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($orders as $order)
                            <tr id="remove{{$order->id}}">
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{optional($order->restaurant)->name}}</td>
                                <td>{{optional($order->client)->name}}</td>
                                <td>{{$order->cost}}</td>

                                <td>{{$order->commission}}</td>
                                <td>{{$order->state}}</td>

                                <td><a class="btn btn-info btn-sm" href="{{route('orders.show',$order->id)}}">Show</a></td>
                                <td>
                                    <a href="javascript:void(0)"
                                       onclick="deleteData('orders',{{$order->id}})"
                                       class="btn btn-xs btn-danger"><i
                                            class="fa fa-trash"></i> Delete</a>
                                </td>

                            </tr>

                        @empty
                            <p class="text-center">No Orders</p>
                        @endforelse
                        </tbody>
                    </table>

                    {{$orders->appends(request()->query())->links()}}


                </div>


            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

@endsection
