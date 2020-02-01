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
                    {!! Form::model($setting,['method'=>'PATCH','action'=>['Admin\SettingController@update',$setting->id]]) !!}
                    <div class="form-group">
                        {!! Form::label('commission','Commission') !!}
                        {!! Form::text('commission',null,['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('bank','Bank Number') !!}
                        {!! Form::text('bank',null,['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">

                        {!! Form::textarea('about_us', null, ['id' => 'editor', 'rows' => 4, 'cols' => 54, 'style' => 'resize:none'])!!}

                    </div>
                    <div class="form-group">
                        {!! Form::submit('Edit settings',['class'=>'btn btn-success']) !!}
                    </div>

                    {!! Form::close() !!}
                </div>

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

@endsection
