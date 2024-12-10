@extends('admin.template')

@section('content')
<!-- Page Content -->
<div class="page-wrapper">
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title m-b-0">Membuat Kelas Baru</h3>
                    <p class="text-muted m-b-30 font-13"> Isi form untuk membuat kelas baru!</p>
                    <form class="form-horizontal" action="/admin/classroom/create" method="post">
                        @csrf
                        <input type="hidden" name="is_locked" value="0">
                        <input type="hidden" name="is_active" value="1">
                        <div class="form-group">
                            <label class="col-md-12">Nama Kelas</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="name"> </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-12">Pilih Mentor</label>
                            <div class="col-sm-12">
                                <select class="form-control" name="mentor_id">
                                    @foreach ($mentors as $row)
                                    <option value="{{$row['id']}}">{{$row['name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @if (count($mentors) < 1)
                            <button class="btn btn-primary" style="width: 100%" type="submit" disabled>Add Class</button>
                            <br><p style="color:red">Cannot add student, because there is no classroom provided!</p>
                        @else
                            <button class="btn btn-primary" style="width: 100%" type="submit">Add Class</button>
                        @endif
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

@section('script')
    <script src="{{asset('js/jasny-bootstrap.js')}}"></script>
@endsection
