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
            <p>Dengan ini menyatakan bahwa menyewa dan ...</p>
            <div class="signature">
                <p>______________________</p>
                <p>Tanda Tangan Customer</p>
            </div>
        </div>
    </div>
</body>

</html>
