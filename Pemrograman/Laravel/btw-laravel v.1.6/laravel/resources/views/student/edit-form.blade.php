@extends('student.template')

@section('content')
<!-- Page Content -->
<div class="page-wrapper">
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-md-12">
                <div class="white-box">
                    <h3 class="box-title">Data yang Tersimpan</h3>
                    <p class="mt-2">Menampilkan data yang tersimpan di database.</p>
                    <div class="table-responsive">
                        <table class="table color-table primary-table">
                            <tbody>
                                <tr>
                                    <td>Nama</td>
                                    <td>{{$student->name}}</td>
                                </tr>
                                <tr>
                                    <td>Jenis Kelamin</td>
                                    <td>{{$student->sex}}</td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td>{{$student->address}}</td>
                                </tr>
                                <tr>
                                    <td>Whatsapp</td>
                                    <td>{{$student->whatsapp}}</td>
                                </tr>
                                <tr>
                                    <td>Wali</td>
                                    <td>{{$student->name_wali}}</td>
                                </tr>
                                <tr>
                                    <td>WA Wali</td>
                                    <td>{{$student->whatsapp_wali}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title m-b-0">Mengedit Akun</h3>
                    <p class="text-muted m-b-30 font-13"> Isi form untuk mengubah profil akunmu!</p>
                    <form class="form-horizontal" action="/student/edit/save" method="post">
                        @csrf
                        <div class="form-group">
                            <label class="col-md-12">Nama</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="name" value="{{$student->name}}"> </div>
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
                                <input type="text" class="form-control" name="address" value="{{$student->address}}"> </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Whatsapp</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="whatsapp" value="{{$student->whatsapp}}"> </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Nama Wali</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="name_wali" value="{{$student->name_wali}}"> </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Whatsapp Wali</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="whatsapp_wali" value="{{$student->whatsapp_wali}}"> </div>
                        </div><br>
                        <button class="btn btn-primary" style="width: 100%" type="submit" onclick="is_saved()">Save Changes</button>
                        <script>
                            function is_saved(){
                                alert('Perubahan telah tersimpan!');
                            }
                        </script>
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
    {{-- !-- jQuery peity --> --}}
    <script src="../plugins/components/peity/jquery.peity.min.js"></script>
    <script src="../plugins/components/peity/jquery.peity.init.js"></script>
@endsection
