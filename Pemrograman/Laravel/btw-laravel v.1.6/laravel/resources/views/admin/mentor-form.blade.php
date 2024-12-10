@extends('admin.template')

@section('content')
<!-- Page Content -->
<div class="page-wrapper">
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title m-b-0">Memverifikasi Mentor Baru</h3>
                    <p class="text-muted m-b-30 font-13"> Isi form untuk verifikasi {{$email}} sebagai mentor!</p>
                    <form class="form-horizontal" action="/admin/mentor/create" method="post">
                        @csrf
                        <input type="hidden" name="user_id" value="{{$id}}">
                        <div class="form-group">
                            <label class="col-md-12">Nama</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="name"> </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-12">Jenis Kelamin</label>
                            <div class="col-sm-12">
                                <select class="form-control" name="sex">
                                    <option value="Pria">Pria</option>
                                    <option value="Wanita">Wanita</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Alamat</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="address"> </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Whatsapp</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="whatsapp"> </div>
                        </div>
                        <button class="btn btn-primary" style="width: 100%" type="submit">Verify Mentor</button>
                    </form>
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
<!-- /#page-wrapper -->
@endsection

@section('script')
    <script src="{{asset('js/jasny-bootstrap.js')}}"></script>
@endsection
