<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class PdfController extends Controller
{
    public function generatePdf()
    {
        $id = 1;

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($this->buktiterima($id))->setPaper('A4', 'potrait')->save('Laporan.pdf');
        return $pdf->stream();
    }

    public function buktiterima($id)
    {
        $data = [
            'logo' => public_path('path/to/logo.png'), // ganti dengan path logo kamu
            'nama_rental' => 'Nama Rental',
            'alamat' => 'Jl. Example No. 123',
            'no_telepon' => '08123456789',
            'customer' => [
                'nama' => 'John Doe',
                'alamat' => 'Jl. Customer No. 456',
                'no_telepon' => '081298765432',
            ],
            'unit' => [
                [
                    'id_unit' => 'PS12345',
                    'kategori' => 'Playstation 4',
                    'nomor_seri' => '987654321',
                    'keterangan' => 'Kondisi baik, lengkap dengan semua aksesoris',
                    'biaya_per_hari' => 'Rp 100,000',
                ],
                // Tambahkan unit lain jika ada
            ],
            'hari_sewa' => 5,
            'total_pembayaran' => 'Rp 500,000',
        ];

        return view('admin/buktiterima', $data);
    }
}
