<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="icon" type="image/png" sizes="16x16" href="../plugins/images/favicon.png">
    <title>BTW Academy | Daftar | Tes SAMAPTA untuk raih mimpimu!</title>

    <!-- Bootstrap CSS -->
    <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Animation CSS -->
    <link href="css/animate.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
    <!-- Color CSS -->
    <link href="css/colors/default.css" id="theme" rel="stylesheet">

    <style>
        html,
        body {
            height: 100%;
            margin: 0;
            overflow-y: auto;
        }

        #wrapper {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            background-color: #f2f2f2;
        }

        .login-box {
            width: 100%;
            max-width: 900px;
            /* col-9 equivalent */
            margin-top: 1rem;
            /* mt-1 */
        }

        .white-box {
            padding: 30px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-control {
            border-radius: 5px;
        }

        .btn {
            border-radius: 5px;
        }

        .text-center img {
            max-width: 100px;
        }
    </style>
</head>

<body>
    <!-- Login Section -->
    <section id="wrapper" class="login-register">
        <div class="login-box">
            <div class="white-box">

                <!-- Logo -->
                <p class="text-center">
                    <img src="./images/Page 18bekasi.png" alt="Logo">
                </p>

                <form class="form-horizontal form-material" id="loginform" action="/register" method="post">
                    @csrf

                    <h3 class="box-title m-b-20 text-center">Daftar Akun</h3>

                    <!-- Success Message -->
                    @if (isset($msg))
                        <p class="text-center" style="background-color: green; color: white;">{{ $msg }}</p>
                    @endif

                    <div class="row">
                        <!-- Email Field -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <input name="email" class="form-control" type="text" required placeholder="Email">
                            </div>
                        </div>

                        <!-- Password Field -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <input name="password" class="form-control" type="password" required
                                    placeholder="Password">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Nama Field -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <input name="name" class="form-control" type="text" required placeholder="Nama">
                            </div>
                        </div>

                        <!-- Jenis Kelamin Field -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <input name="sex" class="form-control" type="text" required
                                    placeholder="Jenis Kelamin">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Alamat Field -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <input name="address" class="form-control" type="text" required placeholder="Alamat">
                            </div>
                        </div>

                        <!-- No. Telepon Field -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <input name="whatsapp" class="form-control" type="text" required
                                    placeholder="No. Telepon">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- No. Telepon Wali Field -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <input name="whatsapp_wali" class="form-control" type="text" required
                                    placeholder="No. Telepon Wali">
                            </div>
                        </div>

                        <!-- Nama Wali Field -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <input name="name_wali" class="form-control" type="text" required
                                    placeholder="Nama Wali">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Kelas Dropdown -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="classroom_id" class="control-label">Kelas</label>
                                <select name="classroom_id" class="form-control">
                                    @for ($i = 1; $i <= 12; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>

                        <!-- Role Dropdown -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="role" class="control-label">Role</label>
                                <select name="role" class="form-control">
                                    <option value="student">Siswa</option>
                                    <option value="mentor">Mentor</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light"
                                type="submit">
                                Daftar Akun
                            </button>
                        </div>
                    </div>

                    <!-- Login Link -->
                    <div class="form-group m-b-0">
                        <div class="col-sm-12 text-center">
                            <p>Sudah punya akun?
                                <a href="login" class="text-primary m-l-5"><b>Masuk Sekarang</b></a>
                            </p>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </section>

    <!-- jQuery -->
    <script src="./plugins/components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="js/custom.js"></script>

</body>

</html>
