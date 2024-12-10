@extends('mentor.template')

<?php $nav_custom = url('/mentor/classroom/'.$classroom_id.'/lesson/'.$lesson_id.'/score') ?>

@section('content')
    <!-- Page Content -->
    <div class="page-wrapper">
        <div class="container-fluid">
            <!-- /row -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="white-box">
                        <h3 class="box-title m-b-0">Menambahkan Skor Lesson {{$lesson['date']}}</h3>
                        <p class="text-muted m-b-30">Melakukan Skoring.</p>
                        <form action="/mentor/classroom/{{$classroom_id}}/lesson/{{$lesson_id}}/score/form" method="post">
                        @csrf
                        <div class="table-responsive">
                            <table id="example23" class="display nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Siswa</th>
                                        <th>Kehadiran</th>
                                        <th>Lari</th>
                                        <th>Pushup</th>
                                        <th>Pullup</th>
                                        <th>Situp</th>
                                        <th>Shuttle</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Siswa</th>
                                        <th>Kehadiran</th>
                                        <th>Lari</th>
                                        <th>Pushup</th>
                                        <th>Pullup</th>
                                        <th>Situp</th>
                                        <th>Shuttle</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php $index = 1; ?>
                                    <?php $counter = 0 ?>
                                    @foreach ($students as $row)
                                    <tr>
                                        <td>{{$index}}</td>
                                        <?php $index += 1; ?>
                                        <td>{{$row['name']}}</td>
                                        <td>
                                            <select name="is_present[{{$counter}}]">
                                                <option value="1">Present</option>
                                                <option value="0">Not Present</option>
                                            </select>
                                        </td>
                                        <td><input type="number" name="s_run[{{$counter}}]" value="0" required></td>
                                        <td><input type="number" name="s_pushup[{{$counter}}]" value="0" required></td>
                                        <td><input type="number" name="s_pullup[{{$counter}}]" value="0" required></td>
                                        <td><input type="number" name="s_situp[{{$counter}}]" value="0" required></td>
                                        <td><input type="number" name="s_shuttle[{{$counter}}]" value="0" required></td>
                                        <input type="hidden" name="student_id[{{$counter}}]" value="{{$row['id']}}">
                                        <input type="hidden" name="lesson_id[{{$counter}}]" value="{{$lesson['id']}}">
                                        <input type="hidden" name="student_id[{{$counter}}]" value="{{$row['id']}}">
                                        <?php $counter += 1; ?>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <br><br>
                        <button class="btn btn-primary mt-5" type="submit" style="width: 100%">Submit Skor</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
        <footer class="footer t-a-c">
            BTW Academy
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
