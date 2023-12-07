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
                        <tr>
                          <th>Product Id</th>
                            <td>{{$item->id}}</td>
                        </tr>
                        <tr>
                            <th>Product Name</th>
                            <td>{{$item->name}}</td>
                        </tr>
                        <tr>
                            <th>Product Code</th>
                            <td>{{$item->code}}</td>
                        </tr>
                        <tr>
                            <th>Product Model</th>
                            <td>{{$item->model}}</td>
                        </tr>
                        <tr>
                            <th>Product Category</th>
                            <td>{{$item->category->name}}</td>
                        </tr>
                        <tr>
                            <th>Product Sub Category</th>
                            <td>{{$item->subcategory->name}}</td>
                        </tr>
                        <tr>
                            <th>Product Brand</th>
                            <td>{{$item->brand->name}}</td>
                        </tr>
                        <tr>
                            <th>Product unit</th>
                            <td>{{$item->unit->name}}</td>
                        </tr>
                        <tr>
                            <th>Product Stock Amount</th>
                            <td>{{$item->stock_amount}}</td>
                        </tr>
                        <tr>
                            <th>Product Regular Price</th>
                            <td>{{$item->regular_price}}</td>
                        </tr>
                        <tr>
                            <th>Product Selling Price</th>
                            <td>{{$item->selling_price}}</td>
                        </tr>
                        <tr>
                            <th>Product Feature Image</th>
                            <td><img src="{{asset('uploded/Product-file/'.$item->image)}}" alt="" style="height: 50px"></td>
                        </tr>
                        <tr>
                            <th>Product Other image</th>
                            <td>1</td>
                        </tr>
                        <tr>
                            <th>Product Hit Count</th>
                            <td>{{$item->hit_count}}</td>
                        </tr>
                        <tr>
                            <th>Product Sales Count</th>
                            <td>{{$item->sales_count}}</td>
                        </tr>
                        <tr>
                            <th>Product Feature Status</th>
                            <td>{{$item->featured_status == 1 ? 'Feature' : 'Not Feature'}}</td>
                        </tr>
                        <tr>
                            <th>Product Description</th>
                            <td>{!! $item->long_description !!}</td>
                        </tr>
                        <tr>
                            <th>Publication Status</th>
                            <td>@if ($item->status=='1')
                                    <span class="badge rounded-pill bg-success">Published</span>
                                @else
                                    <span class="badge rounded-pill bg-danger">Unpublished</span>
                                @endif</td>
                        </tr>
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



