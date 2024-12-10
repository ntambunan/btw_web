@extends('mentor.template')

<?php $nav_custom = url('/mentor/classroom/'.$classroom_id.'/lesson') ?>

@section('content')
<!-- Page Content -->
<div class="page-wrapper">
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title m-b-0">Membuat Lesson baru di kelas {{$classroom->name}}</h3>
                    <p class="text-muted m-b-30 font-13"> Isi form untuk membuat lesson baru!</p>
                    <form class="form-horizontal" action="/mentor/classroom/{{$classroom_id}}/lesson/create" method="post">
                        @csrf
                        <input type="hidden" name="classroom_id" value="{{$classroom->id}}">
                        <div class="example">
                            <h5 class="box-title m-t-30">Pilih Tanggal</h5>
                            <div class="input-group">
                                <input type="text" name="date" class="form-control" id="datepicker-autoclose" placeholder="mm/dd/yyyy"> <span class="input-group-addon"><i class="icon-calender"></i></span> </div>
                        </div><br><br>
                        <button class="btn btn-primary" style="width: 100%" type="submit">Add Lesson</button>
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
<!-- /#page-wrapper -->
@endsection

@section('header')
    <!-- ===== Plugin CSS ===== -->
    <link href="{{asset('../plugins/components/clockpicker/dist/jquery-clockpicker.min.css')}}" rel="stylesheet">
    <link href="{{asset('../plugins/components/jquery-asColorPicker-master/css/asColorPicker.css')}}" rel="stylesheet">
    <link href="{{asset('../plugins/components/bootstrap-datepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('../plugins/components/timepicker/bootstrap-timepicker.min.css')}}" rel="stylesheet">
    <link href="{{asset('../plugins/components/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">
@endsection

@section('script')
    <!-- Clock Plugin JavaScript -->
    <script src="{{asset('../plugins/components/clockpicker/dist/jquery-clockpicker.min.js')}}"></script>
    <!-- Color Picker Plugin JavaScript -->
    <script src="{{asset('../plugins/components/jquery-asColorPicker-master/libs/jquery-asColor.js')}}"></script>
    <script src="{{asset('../plugins/components/jquery-asColorPicker-master/libs/jquery-asGradient.js')}}"></script>
    <script src="{{asset('../plugins/components/jquery-asColorPicker-master/dist/jquery-asColorPicker.min.js')}}"></script>
    <!-- Date Picker Plugin JavaScript -->
    <script src="{{asset('../plugins/components/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
    <!-- Date range Plugin JavaScript -->
    <script src="{{asset('../plugins/components/timepicker/bootstrap-timepicker.min.js')}}"></script>
    <script src="{{asset('../plugins/components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
    <script>
        // Clock pickers
        $('#single-input').clockpicker({
            placement: 'bottom',
            align: 'left',
            autoclose: true,
            'default': 'now'
        });
        $('.clockpicker').clockpicker({
            donetext: 'Done',
        }).find('input').change(function() {
            console.log(this.value);
        });
        $('#check-minutes').click(function(e) {
            // Have to stop propagation here
            e.stopPropagation();
            input.clockpicker('show').clockpicker('toggleView', 'minutes');
        });
        if (/mobile/i.test(navigator.userAgent)) {
            $('input').prop('readOnly', true);
        }
        // Colorpicker
        $(".colorpicker").asColorPicker();
        $(".complex-colorpicker").asColorPicker({
            mode: 'complex'
        });
        $(".gradient-colorpicker").asColorPicker({
            mode: 'gradient'
        });
        // Date Picker
        jQuery('.mydatepicker, #datepicker').datepicker();
        jQuery('#datepicker-autoclose').datepicker({
            autoclose: true,
            todayHighlight: true
        });
        jQuery('#date-range').datepicker({
            toggleActive: true
        });
        jQuery('#datepicker-inline').datepicker({
            todayHighlight: true
        });
        // Daterange picker
        $('.input-daterange-datepicker').daterangepicker({
            buttonClasses: ['btn', 'btn-sm'],
            applyClass: 'btn-danger',
            cancelClass: 'btn-inverse'
        });
        $('.input-daterange-timepicker').daterangepicker({
            timePicker: true,
            format: 'MM/DD/YYYY h:mm A',
            timePickerIncrement: 30,
            timePicker12Hour: true,
            timePickerSeconds: false,
            buttonClasses: ['btn', 'btn-sm'],
            applyClass: 'btn-danger',
            cancelClass: 'btn-inverse'
        });
        $('.input-limit-datepicker').daterangepicker({
            format: 'MM/DD/YYYY',
            minDate: '06/01/2015',
            maxDate: '06/30/2015',
            buttonClasses: ['btn', 'btn-sm'],
            applyClass: 'btn-danger',
            cancelClass: 'btn-inverse',
            dateLimit: {
                days: 6
            }
        });
    </script>
@endsection
