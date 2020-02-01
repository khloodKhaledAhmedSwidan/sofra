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
                    <a class="btn btn-dark btn-sm" href="{{route('users.create')}}">Add New User</a>
                </div>
                <div class="row">

                    <table class="table table-striped table-dark">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Role</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>

                        </tr>
                        </thead>
                        <tbody>
                        @forelse($users as $user)
                            <tr id="remove{{$user->id}}">
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>
                                    @foreach($user->roles as $role)

                                        <li>

                                            {{$role->display_name}}
                                        </li>

                                    @endforeach
                                </td>
                                <td><a class="btn btn-info btn-sm" href="{{route('users.edit',$user->id)}}">Edit</a>
                                </td>
                                <td>
                                    <a href="javascript:void(0)"
                                       onclick="deleteData('users',{{$user->id}})"
                                       class="btn btn-xs btn-danger"><i
                                            class="fa fa-trash"></i> Delete</a>
                                </td>

                            </tr>

                        @empty
                            <p class="text-center">No user</p>
                        @endforelse
                        </tbody>
                    </table>

                    {{$users->appends(request()->query())->links()}}


                </div>


            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

@endsection
