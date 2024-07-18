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
                <p class="content-title">Unit</p>
                <p class="content-sub-title">Manajemen data unit</p>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.barang') }}">Unit</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
                </ol>
            </nav>
        </div>
        <div class="container-admin">
            <div class="form-container p-4">
                <form id="barangForm" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="kategori" class="form-label">Kategori Playstation</label>
                        <select class="form-select" id="kategori" name="kategori" required>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $category->id === $data->kategori_id ? 'selected' : '' }}>{{ $category->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="code" class="form-label">Kode Unit</label>
                        <input type="text" class="form-control" id="code" name="code" value="{{ $data->nama }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Harga</label>
                        <input type="number" class="form-control" id="price" name="price" value="{{ $data->harga }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea rows="6" class="form-control" id="description" name="description">{{ $data->deskripsi }}</textarea>
                    </div>

                    <button type="button" class="btn btn-primary" id="btn-add">Tambah Unit</button>
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
