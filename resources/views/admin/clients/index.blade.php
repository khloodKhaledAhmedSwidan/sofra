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
                            <th scope="col">photo</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Region</th>
                            <th scope="col">is active</th>
                            <th scope="col">Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($clients as $client)
                            <tr id="remove{{$client->id}}">
                                <th scope="row">{{$loop->iteration}}</th>
                                <td><img src="{{isset($client->photo)?$client->photo:'no photo'}}"></td>
                                <td>{{$client->name}}</td>
                                <td>{{$client->email}}</td>
                                <td>{{$client->phone}}</td>
                                <td>{{optional($client->region)->name}}</td>
                                @if($client->is_active == 0)
                                    <td><a class="btn btn-info btn-sm"
                                           href="{{route('clients.active',$client->id)}}">Active</a></td>
                                @else
                                    <td><a class="btn btn-info btn-sm"
                                           href="{{route('clients.active',$client->id)}}">Not Active</a></td>
                                @endif
                                <td>
{{--                                    {!! Form::model($client,['route'=>['clients.destroy',$client->id],'method'=>'DELETE']) !!}--}}
{{--                                    <div class="form-group">--}}
{{--                                        {!! Form::submit('Delete',['Class'=>'btn btn-danger btn-sm']) !!}--}}
{{--                                    </div>--}}
{{--                                    {!! Form::close() !!}--}}


                                    <a href="javascript:void(0)"
                                       onclick="deleteData('clients',{{$client->id}})"
                                       class="btn btn-xs btn-danger"><i
                                            class="fa fa-trash"></i> Delete</a>
                                </td>

                            </tr>

                        @empty
                            <p class="text-center">No Client</p>
                        @endforelse
                        </tbody>
                    </table>

                    {{$clients->appends(request()->query())->links()}}


                </div>


            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

@endsection
