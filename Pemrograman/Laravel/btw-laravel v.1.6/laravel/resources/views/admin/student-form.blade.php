@extends('admin.template')

@section('content')
    <!-- Page Content -->
    <div class="page-wrapper">
        <div class="container-fluid">
            <!-- .row -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="white-box">
                        <h3 class="box-title m-b-0">Memverifikasi Siswa Baru</h3>
                        <p class="text-muted m-b-30 font-13"> Isi form untuk verifikasi {{ $student->email }} sebagai siswa!
                        </p>
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        <form class="form-horizontal" action="/admin/student/create" method="post">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $id }}">
                            <div class="form-group">
                                <label class="col-md-12">Nama</label>
                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="name" value="{{ $student->name }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-12">Jenis Kelamin</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" name="sex" value="{{ $student->sex }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-12">Pilih Kelas</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" name="classroom"
                                        value="{{ $student->classroom_id }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Alamat</label>
                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="address"
                                        value="{{ $student->address }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Whatsapp</label>
                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="whatsapp"
                                        value="{{ $student->whatsapp }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Nama Wali</label>
                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="name_wali"
                                        value="{{ $student->name_wali }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Whatsapp Wali</label>
                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="whatsapp_wali"
                                        value="{{ $student->whatsapp_wali }}">
                                </div>
                            </div>
                            <input type="hidden" name="status_paid" value="1">
                            {{-- @if (count($classrooms) > 0) --}}
                            <button class="btn btn-primary" style="width: 100%" type="submit">Verify Student</button>
                            {{-- @else
                                <button class="btn btn-primary" style="width: 100%" type="submit" disabled>Verify
                                    Student</button>
                                <br>
                                <p style="color:red">Cannot add student, because there is no classroom provided!</p>
                            @endif --}}
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
    <script src="{{ asset('js/jasny-bootstrap.js') }}"></script>
@endsection
