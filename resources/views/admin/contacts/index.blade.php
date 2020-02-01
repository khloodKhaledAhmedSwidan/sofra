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
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Show</th>
                            <th scope="col">Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($contacts as $contact)
                            <tr id="remove{{$contact->id}}">
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$contact->name}}</td>
                                <td>{{$contact->email}}</td>
                                <td>{{$contact->phone}}</td>
                                <td><a class="btn btn-info btn-sm" href="{{route('contacts.show',$contact->id)}}">Show</a></td>

                                <td>
{{--                                    {!! Form::model($contact,['route'=>['contacts.destroy',$contact->id],'method'=>'DELETE']) !!}--}}
{{--                                    <div class="form-group">--}}
{{--                                        {!! Form::submit('Delete',['Class'=>'btn btn-danger btn-sm']) !!}--}}
{{--                                    </div>--}}
{{--                                    {!! Form::close() !!}--}}

                                    <a href="javascript:void(0)"
                                       onclick="deleteData('contacts',{{$contact->id}})"
                                       class="btn btn-xs btn-danger"><i
                                            class="fa fa-trash"></i> Delete</a>
                                </td>

                            </tr>

                        @empty
                            <p class="text-center">No Contacts</p>
                        @endforelse
                        </tbody>
                    </table>

                    {{$contacts->appends(request()->query())->links()}}


                </div>



            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

@endsection
