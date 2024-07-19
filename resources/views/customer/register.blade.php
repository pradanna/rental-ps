<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
    <link rel="shortcut icon" href="{{ asset('images/local/favicon.ico') }}" title="Favicon" />

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin-genosstyle.css') }}" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Styles -->
    <link href="{{ asset('/css/sweetalert2.css') }}" rel="stylesheet">
    <script src="{{ asset('/js/sweetalert2.min.js') }}"></script>
    <style>
        body {
            font-family: 'Nunito';
        }

        .f-label {
            font-size: 0.8em !important;
            margin-bottom: 0.25rem !important;
        }

        .f-pad {
            padding: 0.5rem 0.75rem !important;
        }
    </style>
</head>

<body class="w-100 h-100 bg-login">
<div style="height: 100vh">
    @if (\Illuminate\Support\Facades\Session::has('failed'))
        <script>
            Swal.fire("Autentikasi Gagal ", 'Periksa Username dan Password!', "error")
        </script>
    @endif
        @if (\Illuminate\Support\Facades\Session::has('success'))
            <script>
                Swal.fire({
                    title: 'Success',
                    text: '{{ \Illuminate\Support\Facades\Session::get('success') }}',
                    icon: 'success',
                    timer: 700
                }).then(() => {
                    window.location.href = '/login';
                })
            </script>
        @endif
    <div class="login">
        <div class="panel-login pinggiran-bunder-10  ">

            <div class="gambar">
                <img src={{ asset('images/local/hero-image.webp') }} />
            </div>

            <div class="login-container">
                <div>
                    <p class="text-center fw-bold" style="margin-bottom: 5px;">Form Pendaftaran</p>
                    <form class="p-1" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-1">
                            <label for="username" class="form-label f-label">Username</label>
                            <input type="text" class="form-control login f-label f-pad" id="username" name="username"
                                   value="{{ old('username') }}">
                            @if ($errors->has('username'))
                                <p class="text-danger" style="font-size: 0.8em">
                                    {{ $errors->first('username') }}
                                </p>
                            @endif
                        </div>
                        <div class="mb-1">
                            <label for="password" class="form-label f-label">Password</label>
                            <input type="password" class="form-control login f-pad" style="font-size: 0.8em;" id="password" name="password">
                            @if ($errors->has('password'))
                                <p class="text-danger" style="font-size: 0.8em">
                                    {{ $errors->first('password') }}
                                </p>
                            @endif
                        </div>
                        <div class="mb-1">
                            <label for="name" class="form-label f-label">Nama</label>
                            <input type="text" class="form-control login f-label f-pad" id="name" name="name"
                                   value="{{ old('name') }}">
                            @if ($errors->has('name'))
                                <p class="text-danger" style="font-size: 0.8em">
                                    {{ $errors->first('name') }}
                                </p>
                            @endif
                        </div>
                        <div class="mb-1">
                            <label for="phone" class="form-label f-label">No. HP</label>
                            <input type="text" class="form-control login f-pad" id="phone" name="phone">
                            @if ($errors->has('phone'))
                                <p class="text-danger" style="font-size: 0.8em">
                                    {{ $errors->first('phone') }}
                                </p>
                            @endif
                        </div>
                        <div class="mb-1">
                            <label for="address" class="form-label f-label">Alamat</label>
                            <input type="text" class="form-control login f-pad" id="address" name="address">
                            @if ($errors->has('address'))
                                <p class="text-danger" style="font-size: 0.8em">
                                    {{ $errors->first('address') }}
                                </p>
                            @endif
                        </div>
                        <div class="mb-1">
                            <label for="identity" class="form-label f-label">KTP</label>
                            <input type="file" class="form-control login f-pad" id="file" name="file">
                            @if ($errors->has('file'))
                                <p class="text-danger" style="font-size: 0.8em">
                                    {{ $errors->first('file') }}
                                </p>
                            @endif
                        </div>
                        <button class="btn-login   mt-2 d-block mb-1 w-100 " style="font-size: 0.8em;" type="submit">Register
                        </button>

                        <span class="d-block  text-center ">Sudah Punya Akun?
                                <a href="{{ route('login') }}">Login</a></span>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
</script>
</body>

</html>
