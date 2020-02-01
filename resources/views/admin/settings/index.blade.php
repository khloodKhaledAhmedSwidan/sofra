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
    <a href="{{route('settings.edit',$setting->id)}}" class="btn btn-dark btn-sm">Edit</a>
</div>
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
                          <th>about-us</th>
                                <td>{{$setting->about_us}}</td>

                            </tr>
                            <tr>
                                <th>bank number</th>
                                <td>{{$setting->bank}}</td>
                            </tr>
                            <tr>
                                <th>commission </th>
                                <td>{{$setting->commission}}</td>
                            </tr>
                        </tbody>
                    </table>

                </div>



            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

@endsection
