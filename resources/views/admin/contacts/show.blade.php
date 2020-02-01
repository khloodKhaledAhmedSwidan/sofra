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
                            <th>name</th>
                            <td>{{$contact->name}}</td>

                        </tr>
                        <tr>
                            <th>email</th>
                            <td>{{$contact->email}}</td>
                        </tr>
                        <tr>
                            <th>phone </th>
                            <td>{{$contact->phone}}</td>
                        </tr>
                        <tr>
                            <th>message </th>
                            <td>   <textarea class="table-dark border-0 col-xl-11"  >{{$contact->message}}</textarea></td>
                        </tr>
                        <tr>
                            <th>type </th>
                            <td>{{$contact->type}}</td>
                        </tr>
                        <tr>
                            <th>client_id </th>
                            <td>{{optional($contact->client)->name}}</td>
                        </tr>
                        <tr col="2">


                                {!! Form::model($contact,['route'=>['contacts.destroy',$contact->id],'method'=>'DELETE']) !!}
                                <div class="form-group">
                                    {!! Form::submit('Delete',['Class'=>'btn btn-danger btn-sm']) !!}
                                </div>
                                {!! Form::close() !!}
                        </tr>
                        </tbody>
                    </table>

                </div>
<div class="row">
    <a class="btn btn-dark" href="{{route('contacts.index')}}">All Contacts</a>
</div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

@endsection
