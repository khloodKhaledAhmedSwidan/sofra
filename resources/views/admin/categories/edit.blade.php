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
                <div class="container">@include('admin/includes/errors') </div>
                <div class="container">

                    {!! Form::model($category,['method'=>'PATCH','action'=>['Admin\CategoryController@update',$category->id]]) !!}
                    <div class="form-group">
                        {!! Form::label('name','Name Of category') !!}
                        {!! Form::text('name',null,['class'=>'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::submit('Edit Category',['class'=>'btn btn-success']) !!}
                    </div>
                    {!! Form::close() !!}

                </div>



            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

@endsection
