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

                <div class="container">

                    <div class="row">
                        <a class="btn btn-dark btn-sm" href="{{route('categories.create')}}">Add New Category</a>
                    </div>
                    <div class="row">


                        <table class="table table-striped table-dark">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">name</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($categories as $category)
                                <tr id="remove{{$category->id}}">
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{$category->name}}</td>

                                    <td><a href="{{route('categories.edit',$category->id)}}"
                                           class="btn btn-info btn-sm">Edit</a>
                                    </td>

                                    <td>

                                        <div class="form-group">


                                            <a href="javascript:void(0)"
                                               onclick="deleteData({{$category->id}})"
                                               class="btn btn-xs btn-danger"><i
                                                    class="fa fa-trash"></i> Delete</a>
                                        </div>

                                    </td>


                                </tr>

                            @empty
                                <p class="text-center">No categories</p>
                            @endforelse
                            </tbody>
                        </table>
                        {{$categories->appends(request()->query())->links()}}

                    </div>


                </div>


            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>















@endsection

@push('scripts')
    <script>
        function deleteData(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    $.ajax(
                        {
                            url: "{{url('admin/categories')}}/" + id,
                            type: 'DELETE',
                            dataType: 'json',

                            data: {

                                _token: "{{csrf_token()}}",
                            },
                            success: function (data) {
                                if (data.status == 1) {
                                    $("#remove"+id).remove();
                                    Swal.fire(data.message, {
                                        icon: "success",
                                    })
                                } else {
                                    Swal.fire(data.message, {
                                        icon: "error",
                                    })
                                }
                            }
                        });

                } else {
                    Swal.fire("Your imaginary file is safe!");
                }
            });
        };

    </script>
@endpush
