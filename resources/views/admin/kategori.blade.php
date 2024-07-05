@extends('admin.base')

@section('content')
    <div class="kategori">
        <div class="container-admin pt-5 px-3">
            <div class="row">
                <div class="col-md-8">
                    <div class="table-container p-4">
                        <table id="barangTable" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Kategori</th>
                                    <th>Harga /hari</th>
                                    <th>Gambar</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Elektronik</td>
                                    <td>500000</td>
                                    <td><img src="path/to/image1.jpg" alt="Gambar 1" class="img-thumbnail"
                                            style="width: 50px;"></td>
                                    <td><button class="btn btn-danger btn-sm">Hapus</button></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Furniture</td>
                                    <td>200000</td>
                                    <td><img src="path/to/image2.jpg" alt="Gambar 2" class="img-thumbnail"
                                            style="width: 50px;"></td>
                                    <td><button class="btn btn-danger btn-sm">Hapus</button></td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Pakaian</td>
                                    <td>100000</td>
                                    <td><img src="path/to/image3.jpg" alt="Gambar 3" class="img-thumbnail"
                                            style="width: 50px;"></td>
                                    <td><button class="btn btn-danger btn-sm">Hapus</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-container p-4">
                        <form id="barangForm">
                            <div class="mb-3">
                                <label for="namaKategori" class="form-label">Nama Kategori</label>
                                <input type="text" class="form-control" id="namaKategori" name="namaKategori" required>
                            </div>
                            <div class="mb-3">
                                <label for="harga" class="form-label">Harga /hari</label>
                                <input type="number" class="form-control" id="harga" name="harga" required>
                            </div>
                            <div class="mb-3">
                                <label for="gambar" class="form-label">Gambar</label>
                                <input type="file" class="form-control" id="gambar" name="gambar" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Tambah Barang</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('morejs')
    <script>
        $(document).ready(function() {
            $('#barangTable').DataTable();

            $('#barangForm').on('submit', function(event) {
                event.preventDefault();
                const namaKategori = $('#namaKategori').val();
                const harga = $('#harga').val();
                const gambar = $('#gambar')[0].files[0];
                const reader = new FileReader();

                reader.onload = function(e) {
                    const imgSrc = e.target.result;
                    const table = $('#barangTable').DataTable();
                    const rowCount = table.rows().count() + 1;
                    table.row.add([
                        rowCount,
                        namaKategori,
                        harga,
                        `<img src="${imgSrc}" alt="Gambar ${rowCount}" class="img-thumbnail" style="width: 50px;">`,
                        '<button class="btn btn-danger btn-sm">Hapus</button>'
                    ]).draw(false);

                    $('#barangForm')[0].reset();
                };

                reader.readAsDataURL(gambar);
            });

            $('#barangTable tbody').on('click', 'button', function() {
                const table = $('#barangTable').DataTable();
                table.row($(this).parents('tr')).remove().draw();
            });
        });
    </script>
@endsection
