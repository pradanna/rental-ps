<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Sewa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header img {
            max-width: 150px;
        }

        .content {
            margin-bottom: 20px;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
        }

        .footer .signature {
            margin-top: 50px;
        }
    </style>
</head>

<body>
    <div class="header">
        <img src="{{ $logo }}" alt="Logo">
        <h2>{{ $nama_rental }}</h2>
        <p>{{ $alamat }}</p>
        <p>{{ $no_telepon }}</p>
    </div>
    <div class="content">
        <h3>Data Customer</h3>
        <p><strong>Nama:</strong> {{ $customer['nama'] }}</p>
        <p><strong>Alamat:</strong> {{ $customer['alamat'] }}</p>
        <p><strong>No Telepon:</strong> {{ $customer['no_telepon'] }}</p>

        <h3>Rincian Unit yang Disewa</h3>
        @foreach ($unit as $u)
            <p><strong>ID Unit:</strong> {{ $u['id_unit'] }}</p>
            <p><strong>Kategori:</strong> {{ $u['kategori'] }}</p>
            <p><strong>Nomor Seri:</strong> {{ $u['nomor_seri'] }}</p>
            <p><strong>Keterangan:</strong> {{ $u['keterangan'] }}</p>
            <p><strong>Biaya Per Hari:</strong> {{ $u['biaya_per_hari'] }}</p>
        @endforeach

        <h3>Detail Sewa</h3>
        <p><strong>Jumlah Hari Sewa:</strong> {{ $hari_sewa }} hari</p>
        <p><strong>Total Pembayaran:</strong> {{ $total_pembayaran }}</p>

        <div class="footer">
            <p style=" text-align: justify;">Syarat dan Ketentuan: <br>

                1. Pembayaran: Penyewa wajib melakukan pembayaran penuh sesuai dengan total biaya sewa sebelum unit
                diserahkan. <br>

                2. Penggunaan: Penyewa setuju untuk menggunakan unit PlayStation dengan hati-hati dan hanya untuk
                keperluan
                pribadi. <br>

                3. Kerusakan dan Kehilangan: Penyewa bertanggung jawab atas segala kerusakan atau kehilangan unit selama
                masa sewa. Biaya perbaikan atau penggantian unit akan ditanggung oleh penyewa. <br>

                Pengembalian: Penyewa harus mengembalikan unit PlayStation tepat waktu sesuai dengan durasi sewa yang
                disepakati. Keterlambatan pengembalian akan dikenakan biaya tambahan sebesar [biaya keterlambatan] per
                hari. <br>

                Pembatalan: Pembatalan sewa oleh penyewa harus diberitahukan minimal [jumlah hari] sebelum tanggal mulai
                sewa. Biaya pembatalan sebesar [biaya pembatalan] akan dikenakan. <br>

                Perpanjangan Sewa: Jika penyewa ingin memperpanjang masa sewa, penyewa harus menghubungi pihak rental
                minimal [jumlah hari] sebelum tanggal pengembalian. Perpanjangan sewa akan dikenakan biaya tambahan
                sesuai dengan biaya sewa per hari.
                <br>
                Pernyataan:
            </p>
            <p>Dengan ini, saya, [Nama Penyewa], menyatakan bahwa saya telah membaca, memahami, dan setuju dengan syarat
                dan ketentuan yang tercantum dalam perjanjian ini. Saya berjanji untuk mematuhi semua ketentuan yang
                berlaku dan bertanggung jawab penuh atas unit PlayStation yang saya sewa.</p>
            <div class="signature">
                <p>______________________</p>
                <p>Tanda Tangan Customer</p>
            </div>
        </div>
    </div>
</body>

</html>
