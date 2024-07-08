@extends('admin.base')

@section('content')
    <div class="detailpesanan pt-5">
        <div class="row gx-3">
            <div class="col-md-4">
                <div class="detail-container p-4 ">
                    <h5>Detail Penyewa</h5>
                    <hr>
                    <p><strong>Nama Penyewa</strong><br>John Doe</p>
                    <p><strong>Alamat</strong><br>Jl. Example No. 123</p>
                    <p><strong>No HP</strong><br>08123456789</p>
                    <div class="mt-4">
                        <h6>Bukti Transfer</h6>
                        <img src="path/to/transfer-proof.jpg" alt="Bukti Transfer" class="img-fluid mb-3"
                            style="max-width: 100%;">
                        <button class="btn btn-success">Konfirmasi Pembayaran</button>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="detail-container p-4">
                    <h5>Detail Unit Playstation</h5>
                    <hr>
                    <p><strong>ID Unit</strong><br>PS12345</p>
                    <p><strong>Kategori Unit</strong><br>Playstation 4</p>
                    <p><strong>Nomor Seri</strong><br>987654321</p>
                    <p><strong>Keterangan</strong><br>Kondisi baik, lengkap dengan semua aksesoris</p>
                    <p><strong>Biaya Sewa Perhari</strong><br>Rp 100,000</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="detail-container p-4">
                    <h5>Detail Transaksi</h5>
                    <hr>
                    <p><strong>Disewa Tanggal</strong><br>01-01-2024</p>
                    <p><strong>Durasi Sewa</strong><br>5 Hari</p>
                    <p><strong>Estimasi Tanggal Dikembalikan</strong><br>06-01-2024</p>
                    <p><strong>Total Biaya Sewa</strong Statusong><br>Rp 500,000</p>
                    <button class="btn btn-warning">Unit Siap Diambi</button>
                    <button class="btn btn-primary">Sedang Disewa</button>
                    <button class="btn btn-success">Selesai</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('morejs')
    <script>
        $(document).ready(function() {

        });
    </script>
@endsection
