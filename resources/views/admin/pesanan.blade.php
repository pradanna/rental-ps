@extends('admin.base')

@section('content')
    <div class="kategori">
        <div class="container-admin pt-5 px-3">
            <div class="table-container p-4">
                <table id="pesananTable" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Penyewa</th>
                            <th>Unit PS yang di Sewa</th>
                            <th>tanggal mulai sewa</th>
                            <th>tanggal akhir sewa</th>
                            <th>Status</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Bagus</td>
                            <td>PS 2 || (id)</td>
                            <td>7 Juli 2024</td>
                            <td>Durasi sewa (Hari)</td>
                            <td>Menunggu Pembayaran || Menunggun Konfirmasi Pembayaran <br> || Unit Sedang disiapkan ||
                                Unit Siap Diambil || Sedang Disewa || Selesai</td>
                            <td>RP 200.000</td>

                            <td><a class="btn btn-primary btn-sm" href="/admin/detailpesanan">Detail</a></td>
                        </tr>

                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection

@section('morejs')
    <script>
        $(document).ready(function() {
            $('#pesananTable').DataTable();

            $('#pesananForm').on('submit', function(event) {
                event.preventDefault();
                const namaKategori = $('#namaKategori').val();
                const harga = $('#harga').val();
                const gambar = $('#gambar')[0].files[0];
                const reader = new FileReader();

                reader.onload = function(e) {
                    const imgSrc = e.target.result;
                    const table = $('#pesananTable').DataTable();
                    const rowCount = table.rows().count() + 1;
                    table.row.add([
                        rowCount,
                        namaKategori,
                        harga,
                        `<img src="${imgSrc}" alt="Gambar ${rowCount}" class="img-thumbnail" style="width: 50px;">`,
                        '<button class="btn btn-danger btn-sm">Hapus</button>'
                    ]).draw(false);

                    $('#pesananForm')[0].reset();
                };

                reader.readAsDataURL(gambar);
            });

            $('#pesananTable tbody').on('click', 'button', function() {
                const table = $('#pesananTable').DataTable();
                table.row($(this).parents('tr')).remove().draw();
            });
        });
    </script>
@endsection
