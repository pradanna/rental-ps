@extends('admin.base')

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
    <div class="kategori">
        <div class="container-admin pt-5 px-3">
            <div class="row">
                <div class="col-md-8">
                    <div class="table-container p-4">
                        <table id="barangTable" class="table table-striped" style="width:100%">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Gambar</th>
                                <th>Nama Kategori</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $datum)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>
                                        <img src="{{ $datum->gambar }}" alt="Gambar 1" class="img-thumbnail"
                                             style="width: 50px;">
                                    </td>
                                    <td>{{ $datum->nama }}</td>

                                    <td>
                                        <button class="btn btn-warning btn-sm btn-edit" data-id="{{ $datum->id }}"
                                                data-nama="{{ $datum->nama }}">
                                            <span class="material-symbols-outlined" style="font-size: 0.8em">
                                                edit
                                            </span>
                                        </button>
                                        <button class="btn btn-danger btn-sm">
                                            <span class="material-symbols-outlined" style="font-size: 0.8em">
                                                delete
                                            </span>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-container p-4">
                        <form id="barangForm" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="" id="category_id">
                            <div class="mb-3">
                                <label for="namaKategori" class="form-label">Nama Kategori</label>
                                <input type="text" class="form-control" id="namaKategori" name="name" required>
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
        </div>
    </div>
@endsection

@section('morejs')
    <script src="{{ asset('/js/helper.js') }}"></script>
    <script>
        var path = '/{{ request()->path() }}';
        var table;

        function eventSave() {
            $('#btn-add').on('click', function () {
                AlertConfirm('Konfirmasi!', 'Apakah anda yakin ingin menyimpan data?', function () {
                    $('#barangForm').submit();
                })
            });
        }

        function eventEdit() {
            $('.btn-edit').on('click', function () {
                let id = this.dataset.id;
                let nama = this.dataset.nama;
                $('#category_id').val(id);
                $('#namaKategori').val(nama);
            });
        }

        $(document).ready(function () {
            $('#barangTable').DataTable();
            eventEdit();
            eventSave();
        });
    </script>
@endsection
