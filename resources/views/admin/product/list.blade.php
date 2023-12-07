@extends('master')

@section('style-lib')
    <link rel="stylesheet" type="text/css"
          href="{{url('admin')}}/assets/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css"
          href="{{url('admin')}}/assets/node_modules/datatables.net-bs4/css/responsive.dataTables.min.css">
    <!-- Custom CSS -->

@endsection

@push('custom-css')
    <style type="text/css">

    </style>
@endpush

@section('body')


    <div class="row">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Data Table</h4>
                <h6 class="card-subtitle">Data table example</h6>
                <a href="{{route('product')}}">
                    <button type="button" class="btn btn-success rounded-capsule btn-sm py-1 m-1 ">
                        Add Sub Category
                    </button>
                </a>
                <div class="table-responsive m-t-40">
                    <table id="myTable" class="table table-striped border">
                        <thead>
                        <tr>
                            <th class="sl no">SL NO</th>
{{--                            <th class="category_id">Category Name</th>--}}
{{--                            <th class="sub_category_id">SUb Category</th>--}}
{{--                            <th class="brand_id">Brand Name</th>--}}
{{--                            <th class="unit_id">Unit Name</th>--}}
                            <th class="name">Product Nmae</th>
                            <th class="code">Product Code</th>
{{--                            <th class="model">Product Model</th>--}}
                            <th class="stock_amount">Stock Amount</th>
{{--                            <th class="regular_price">Regular Price</th>--}}
{{--                            <th class="selling_price"> Selling Price</th>--}}
{{--                            <th class="short_description"> Short Description </th>--}}
{{--                            <th class="long_description"> Long Description </th>--}}
                            <th class="image">Image</th>
{{--                            <th class="other_image">Other Image</th>--}}
                            <th class="status">Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($item as $key =>$product)
                            <tr>
                                <td class="sl no">{{$key+1}}</td>
{{--                                <td class="category_id">{{$product->category->name}}</td>--}}
{{--                                <td class="sub_category_id">{{$product->subcategory->name}}</td>--}}
{{--                                <td class="brand_id">{{$product->brand_id}}</td>--}}
{{--                                <td class="unit_id">{{$product->unit_id}}</td>--}}
                                <td class="name">{{$product->name}}</td>
                                <td class="code">{{$product->code}}</td>
{{--                                <td class="model">{{$product->model}}</td>--}}
                                <td class="stock_amount">{{$product->stock_amount}}</td>
{{--                                <td class="regular_price">{{$product->regular_price}}</td>--}}
{{--                                <td class="selling_price">{{$product->selling_price}}</td>--}}
{{--                                <td class="short_description">{{$product->short_description}}</td>--}}
{{--                                <td class="long_description">{{$product->long_description}}</td>--}}
                                <td><img src="{{asset('uploded/Product-file/'.$product->image)}}" alt="" style="height: 50px"></td>
{{--                                <td><img src="{{asset('uploded/Product-file/'.$product->other_image)}}" alt="" style="height: 50px"></td>--}}
                                <td>
                                    @if ($product->status=='1')
                                        <span class="badge rounded-pill bg-success">Published</span>
                                    @else
                                        <span class="badge rounded-pill bg-danger">Unpublished</span>
                                    @endif
                                </td>
                                <td class="action">
                                    <a href="{{route('product.view',$product->id)}}" class="btn btn-sm btn-info">
                                        <i class="ti-alert"></i>
                                    </a>
                                    <a href="{{route('product.edit',$product->id)}}" class="btn btn-sm btn-success">
                                        <i class="ti-alert"></i>
                                    </a>
                                    <a href="{{route('product.destroy',$product->id)}}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this item?');"><i class="ti-trash"></i></a>
                                    @if($product->status=='1')
                                        <a href=""><i class="fa fa-thumbs-up"></i></a>
                                    @else
                                        <a href=""><i class="fa fa-thumbs-down"></i></a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

@endsection

@section('script-lib')
    <script src="{{url('admin')}}/assets/node_modules/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{url('admin')}}/assets/node_modules/datatables.net-bs4/js/dataTables.responsive.min.js"></script>
@endsection


@push('custom-js')
    <script>
        $(function () {
            $('#myTable').DataTable();
            var table = $('#example').DataTable({
                "columnDefs": [{
                    "visible": false,
                    "targets": 2
                }],
                "order": [
                    [2, 'asc']
                ],
                "displayLength": 25,
                "drawCallback": function (settings) {
                    var api = this.api();
                    var rows = api.rows({
                        page: 'current'
                    }).nodes();
                    var last = null;
                    api.column(2, {
                        page: 'current'
                    }).data().each(function (group, i) {
                        if (last !== group) {
                            $(rows).eq(i).before('<tr class="group"><td colspan="5">' + group + '</td></tr>');
                            last = group;
                        }
                    });
                }
            });
            // Order by the grouping
            $('#example tbody').on('click', 'tr.group', function () {
                var currentOrder = table.order()[0];
                if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
                    table.order([2, 'desc']).draw();
                } else {
                    table.order([2, 'asc']).draw();
                }
            });
            // responsive table
            $('#config-table').DataTable({
                responsive: true
            });
            $('#example23').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
            $('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-primary me-1');
        });

    </script>

@endpush


