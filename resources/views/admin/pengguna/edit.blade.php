@extends('admin.base')

@section('morecss')
    <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/style.admin.css') }}" rel="stylesheet">
@endsection

@section('content')
    @if (\Illuminate\Support\Facades\Session::has('failed'))
        <script>
            Swal.fire("Ooops", '{{ \Illuminate\Support\Facades\Session::get('failed') }}', "error")
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
                window.location.reload();
            })
        </script>
    @endif
    <div class="p-3">
        <div class="d-flex justify-content-between align-items-center mb-1">
            <div>
                <p class="content-title">Pengguna</p>
                <p class="content-sub-title">Manajemen data pengguna</p>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.pengguna') }}">Pengguna</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
                </ol>
            </nav>
        </div>
        <div class="container-admin">
            <div class="form-container p-4">
                <form id="barangForm" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="w-100 mb-3">
                        <label for="username" class="form-label input-label">Username <span
                                class="color-danger">*</span></label>
                        <input type="text" placeholder="username" class="text-input" id="username"
                               name="username" value="{{ $data->username }}">
                        @if($errors->has('username'))
                            <span id="username-error" class="input-label-error">
                        {{ $errors->first('username') }}
                    </span>
                        @endif
                    </div>
                    <div class="w-100 mb-3">
                        <label for="password" class="form-label input-label">Password <span
                                class="color-danger">*</span></label>
                        <input type="password" placeholder="password" class="text-input" id="password"
                               name="password">
                        @if($errors->has('password'))
                            <span id="password-error" class="input-label-error">
                        {{ $errors->first('password') }}
                    </span>
                        @endif
                    </div>
                    <button type="button" class="btn btn-primary" id="btn-add">Simpan</button>
                </form>
            </div>
        </div>

    </div>
@endsection

@section('morejs')
    <script src="{{ asset('/js/helper.js') }}"></script>
    <script>
        var path = '/{{ request()->path() }}';

        function eventSave() {
            $('#btn-add').on('click', function () {
                AlertConfirm('Konfirmasi!', 'Apakah anda yakin ingin menyimpan data?', function () {
                    $('#barangForm').submit();
                })
            });
        }

        $(document).ready(function () {
            eventSave();
        });
    </script>
@endsection
