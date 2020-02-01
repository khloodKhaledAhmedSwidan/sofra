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
        <div class="col-xl-12">
        <a href="{{route('roles.create')}}" class="btn btn-dark btn-sm ">Create a new Role</a>

        <div class="card card-info ">


        <table class="table table-striped table-dark">
            <thead>
            <tr>
                <th scope="col" style="width: 10px">#</th>
                <th scope="col">Name</th>
                <th scope="col">name Display</th>
                <th scope="col">Description</th>
                <th scope="col">Permission</th>
                <th scope="col">Edit</th>
                <th scope="col" style="width: 40px">Delete</th>
            </tr>
            </thead>
            <tbody>
            @foreach($roles as $role)
                <tr id="remove{{$role->id}}">
                    <td>{{$loop->iteration}}</td>
                    <td>{{$role->name}}</td>
                    <td>{{$role->display_name}}</td>
                    <td>{{$role->description}}</td>
                    <td>

                        @foreach($role->permissions as $permission)
                            <li>
                        {{$permission->display_name}}
                            </li>
                    @endforeach
                    </td>
                    <td>
                        <a href="{{route('roles.edit',$role->id)}}" class="btn btn-info btn-sm"> Edit</a>

                    </td>
                    <td>
                        <a href="javascript:void(0)"
                           onclick="deleteData('roles',{{$role->id}})"
                           class="btn btn-xs btn-danger"> Delete</a>

                    </td>
                </tr>
            @endforeach



            </tbody>

        </table>
            {{$roles->appends(request()->query())->links()}}
        </div>
        </div>
    </div>


            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

@endsection
