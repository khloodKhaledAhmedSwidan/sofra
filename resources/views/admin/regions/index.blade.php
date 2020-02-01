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
                    <a class="btn btn-dark btn-sm" href="{{route('regions.create')}}">Add New Region</a>
                </div>
                <div class="row">


                    <table class="table table-striped table-dark">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Region</th>
                            <th scope="col">City</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($regions as $region)
                            <tr id="remove{{$region->id}}">
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$region->name}}</td>
                                <td>{{optional($region->city)->name}}</td>
                                <td><a href="{{route('regions.edit',$region->id)}}" class="btn btn-info btn-sm">Edit</a>
                                </td>

                                <td>
                                    <a href="javascript:void(0)"
                                       onclick="deleteData('regions',{{$region->id}})"
                                       class="btn btn-xs btn-danger"><i
                                            class="fa fa-trash"></i> Delete</a>
                                </td>

                            </tr>

                        @empty
                            <p class="text-center">No Regions</p>
                        @endforelse
                        </tbody>
                    </table>
                    {{$regions->appends(request()->query())->links()}}


                </div>


            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

@endsection
