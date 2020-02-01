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

                    @include('admin.includes.errors')
                    <div class="container">
                        {!! Form::model($role,['method'=>'PATCH','route'=>['roles.update',$role->id]]) !!}
                        <div class="form-group">
                            {!! Form::label('name','Name Of Role') !!}
                            {!! Form::text('name',null,['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('display_name','Name') !!}
                            {!! Form::text('display_name',null,['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('description','description') !!}
                            {!! Form::textarea('description',null,['class'=>'form-control']) !!}
                        </div>


                        <div class="form-group">

                            {!! Form::label('permission_list','permission') !!}
                            <br>
                            <input id="selectAll" type="checkbox">
                            <label for='selectAll'>Select All</label>
                            <br>
                            @foreach($permission as $Permission)

                                <label class="checkbox-inline col-sm-3">
                                    <input type="checkbox" name="permission_list[]" value="{{$Permission->id}}"
                                           @if($role->hasPermission($Permission->name))
                                           checked
                                        @endif

                                    > {{$Permission->display_name}}
                                </label>
                            @endforeach

                        </div>
                        <div class="form-group">
                            {!! Form::submit('Add Role',['class'=>'btn btn-success']) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>


                </div>


            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    @push('scripts')
        <script>
            $("#selectAll").click(function () {
                $("input[type=checkbox]").prop('checked', $(this).prop('checked'));

            });
        </script>
    @endpush
@endsection

