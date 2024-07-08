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
                                    <th>Kategori PS</th>
                                    <th>Nomor Seri</th>
                                    <th>Status</th>
                                    <th>Keterangan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>PS 2</td>
                                    <td>010390129</td>
                                    <td>ready, disewa, rusak</td>
                                    <td>PS Harddisk 70GB, Kondisi baik</td>
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
                                <label for="kategori" class="form-label">Kategori Playstation</label>
                                <select class="form-select" id="kategori" name="kategori" required>
                                    <option value="" disabled selected>Pilih Kategori</option>
                                    <option value="playstation2">Playstation 2</option>
                                    <option value="playstation3">Playstation 3</option>
                                    <option value="playstation4">Playstation 4</option>
                                    <option value="playstation5">Playstation 5</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="nomorSeri" class="form-label">Nomor Seri</label>
                                <input type="text" class="form-control" id="nomorSeri" name="nomorSeri" required>
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" id="status" name="status" required>
                                    <option value="" disabled selected>Pilih Status</option>
                                    <option value="ready">Ready</option>
                                    <option value="rusak">Disewa</option>
                                    <option value="rusak">Sedang dalam Perbaikan</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="keterangan" class="form-label">Keterangan</label>
                                <textarea class="form-control" id="keterangan" name="keterangan" rows="3" required></textarea>
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
