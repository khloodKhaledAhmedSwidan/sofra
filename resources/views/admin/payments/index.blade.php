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
                            <th scope="col">total</th>
                            <th scope="col">profit of restaurant</th>
                            <th scope="col">net</th>
                            <th scope="col">delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($payments as $payment)
                            <tr id="remove{{$payment->id}}">
                                <th scope="row">{{$loop->iteration}}</th>

                                <td>{{optional($payment->restaurant)->name}}</td>

                                <td>{{summationOfOrders($payment->restaurant->id)}}</td>

                                <td>{{(summationOfOrders($payment->restaurant->id))-(netApp($payment->restaurant->id,$settings->commission))}}</td>
                                <td>{{netApp($payment->restaurant->id,$settings->commission)}}</td>
                                <td>
                                    <a href="javascript:void(0)"
                                       onclick="deleteData('payments',{{$payment->id}})"
                                       class="btn btn-xs btn-danger"><i
                                            class="fa fa-trash"></i> Delete</a>
                                </td>

                            </tr>

                  @endforeach
                        </tbody>
                    </table>

                    {{$payments->appends(request()->query())->links()}}


                </div>


            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

@endsection
