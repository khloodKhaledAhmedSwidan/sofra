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
                    <a class="btn btn-dark btn-sm" href="{{route('cities.create')}}">Add New City</a>
                </div>
                <div class="row">

                    <table class="table table-striped table-dark">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($cities as $city)
                            <tr id="remove{{$city->id}}">
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$city->name}}</td>
                                <td><a href="{{route('cities.edit',$city->id)}}" class="btn btn-info btn-sm">Edit</a>
                                </td>

                                <td>
                                    <div class="form-group">
                                        <a href="javascript:void(0)"
                                           onclick="deleteData('cities',{{$city->id}})"
                                           class="btn btn-xs btn-danger"><i
                                                class="fa fa-trash"></i> Delete</a>
                                    </div>
                                </td>

                            </tr>

                        @empty
                            <p class="text-center">No Cities</p>
                        @endforelse
                        </tbody>
                    </table>

                    {{$cities->appends(request()->query())->links()}}
                </div>


            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

@endsection

