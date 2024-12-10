@extends('admin.template')

@section('content')
    <!-- Page Content -->
    <div class="page-wrapper">
        <div class="container-fluid">
            <!-- /row -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="white-box">
                        <h3 class="box-title m-b-0">Data Siswa</h3>
                        <p class="text-muted m-b-30">Melihat data siswa</p>
                        <div class="table-responsive">
                            <table id="example23" class="display nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Kelas</th>
                                        <th>Whatsapp</th>
                                        <th>Wali</th>
                                        <th>WA Wali</th>
                                        <th>Alamat</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Kelas</th>
                                        <th>Whatsapp</th>
                                        <th>Wali</th>
                                        <th>WA Wali</th>
                                        <th>Alamat</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php $index = 1; ?>
                                    @foreach ($students as $row)
                                    <tr>
                                        <td>{{$index}}</td>
                                        <?php $index += 1; ?>
                                        <td>{{$row['name']}}</td>
                                        <td>{{$row['sex']}}</td>
                                        {{-- Join classrooms.name  --}}
                                        @foreach ($classrooms as $classroom)
                                            @if ($classroom['id'] == $row['classroom_id'])
                                                <td>{{ $classroom['name'] }}</td>
                                                @break
                                            @endif
                                        @endforeach
                                        <td>{{$row['whatsapp']}}</td>
                                        <td>{{$row['name_wali']}}</td>
                                        <td>{{$row['whatsapp_wali']}}</td>
                                        <td>{{$row['address']}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
        <footer class="footer t-a-c">
            BTW Admin
        </footer>
    </div>
@endsection

@section('header')
    <!-- ===== Plugin CSS ===== -->
    <link href="{{asset('../plugins/components/datatables/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('script')
    <!-- Custom Theme JavaScript -->
    <script src="{{asset('js/custom.js')}}"></script>
    <script src="{{asset('../plugins/components/datatables/jquery.dataTables.min.js')}}"></script>
    <!-- start - This is for export functionality only -->
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
    <!-- end - This is for export functionality only -->
    <script>
    $(function() {
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
            "drawCallback": function(settings) {
                var api = this.api();
                var rows = api.rows({
                    page: 'current'
                }).nodes();
                var last = null;
                api.column(2, {
                    page: 'current'
                }).data().each(function(group, i) {
                    if (last !== group) {
                        $(rows).eq(i).before('<tr class="group"><td colspan="5">' + group + '</td></tr>');
                        last = group;
                    }
                });
            }
        });
        // Order by the grouping
        $('#example tbody').on('click', 'tr.group', function() {
            var currentOrder = table.order()[0];
            if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
                table.order([2, 'desc']).draw();
            } else {
                table.order([2, 'asc']).draw();
            }
        });
    });
    $('#example23').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
    </script>
    <!--Style Switcher -->
    <script src="{{asset('../plugins/components/styleswitcher/jQuery.style.switcher.js')}}"></script>
@endsection
