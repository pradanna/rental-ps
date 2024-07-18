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
                <p class="content-title">Kategori</p>
                <p class="content-sub-title">Manajemen data kategori</p>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.category') }}">Kategori</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
                </ol>
            </nav>
        </div>
        <div class="container-admin">
            <div class="form-container p-4">
                <form id="barangForm" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" value="" id="category_id">
                    <div class="mb-3">
                        <label for="namaKategori" class="form-label">Nama Kategori</label>
                        <input type="text" class="form-control" id="namaKategori" name="name" value="{{ $data->nama }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="file" class="form-label">Gambar</label>
                        <input type="file" class="form-control" id="file" name="file" required>
                    </div>
                    <button type="button" class="btn btn-primary" id="btn-add">Tambah Barang</button>
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
