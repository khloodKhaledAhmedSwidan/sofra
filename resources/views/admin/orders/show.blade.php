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



                    <table  class="table table-striped table-dark printForm">
                        <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Description</th>


                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th>restaurant</th>
                            <td>{{optional($order->restaurant)->name}}</td>

                        </tr>
                        <tr>
                            <th>client</th>
                            <td>{{optional($order->client)->name}}</td>

                        </tr>

                        <tr>
                            <th>cost</th>
                            <td>{{$order->cost}} </td>
                        </tr>
                        <tr>
                            <th>net </th>
                            <td>{{$order->net}}</td>
                        </tr>
                        <tr>
                            <th>total </th>
                            <td>{{$order->total}}</td>
                        </tr>

                        <tr>
                            <th>commission </th>
                            <td>{{$order->commission}}</td>
                        </tr>
                        <tr>
                            <th>state </th>
                            <td>{{$order->state}}</td>
                        </tr>






                        <tr col="2">


                            {!! Form::model($order,['route'=>['orders.destroy',$order->id],'method'=>'DELETE']) !!}
                            <div class="form-group">
                                {!! Form::submit('Delete',['Class'=>'btn btn-danger btn-sm']) !!}
                            </div>
                            {!! Form::close() !!}
                        </tr>

                        </tbody>
                    </table>

                </div>
                <div class="row">
                    <a class="btn btn-dark" href="{{route('orders.index')}}">All orders</a>
                    <button id="print" class="btn btn-info">Print this page</button>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

@endsection
@push('scripts')
    <script>
        $(document).ready(function () {
            $('#print').click(function () {
                $('.printForm').printThis({
                    debug: false,               // show the iframe for debugging
                    importCSS: true,            // import parent page css
                    importStyle: false,         // import style tags
                    printContainer: true,       // print outer container/$.selector
                    loadCSS: "",                // path to additional css file - use an array [] for multiple
                    pageTitle: "",              // add title to print page
                    removeInline: false,        // remove inline styles from print elements
                    removeInlineSelector: "*",  // custom selectors to filter inline styles. removeInline must be true
                    printDelay: 333,            // variable print delay
                    header: null,               // prefix to html
                    footer: null,               // postfix to html
                    base: false,                // preserve the BASE tag or accept a string for the URL
                    formValues: true,           // preserve input/form values
                    canvas: false,              // copy canvas content
                    doctypeString: '...',       // enter a different doctype for older markup
                    removeScripts: false,       // remove script tags from print content
                    copyTagClasses: false,      // copy classes from the html & body tag
                    beforePrintEvent: null,     // function for printEvent in iframe
                    beforePrint: null,          // function called before iframe is filled
                    afterPrint: null            // function called before iframe is removed
                });
            });
        });
    </script>
    @endpush
