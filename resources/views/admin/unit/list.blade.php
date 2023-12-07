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
              <a href="{{route('unit')}}">
                  <button type="button" class="btn btn-success rounded-capsule btn-sm py-1 m-1 ">
                     Add Unit
                  </button>
              </a>
              <div class="table-responsive m-t-40">
                  <table id="myTable" class="table table-striped border">
                      <thead>
                      <tr>
                          <th class="sl no">SL NO</th>
                          <th class="name">Unit Name</th>
                          <th class="code">Unit Code</th>
                          <th class="description">Unit Description</th>
                          <th class="status">Status</th>
                          <th>Action</th>
                      </tr>
                      </thead>
                      <tbody>
                      @foreach($item as $key =>$unit)
                      <tr>
                          <td class="sl no">{{$key+1}}</td>
                          <td class="name">{{$unit->name}}</td>
                          <td class="code">{{$unit->code}}</td>
                          <td class="description">{{$unit->description}}</td>
                          <td>
                              @if ($unit->status=='1')
                                  <span class="badge rounded-pill bg-success">Published</span>
                              @else
                                  <span class="badge rounded-pill bg-danger">Unpublished</span>
                              @endif
                          </td>
                          <td class="action">
                              <a href="{{route('unit.edit',$unit->id)}}" class="btn btn-sm btn-success"><i class="ti-alert"></i></a>
                              <a href="{{route('unit.destroy',$unit->id)}}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this item?');"><i class="ti-trash"></i></a>
                              @if($unit->status=='1')
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

