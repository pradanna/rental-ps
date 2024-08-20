<?php


namespace App\Http\Controllers\Admin;


use App\Helper\CustomController;
use App\Models\Transaksi;

class ReportController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if ($this->request->ajax()) {
            $start = $this->field('start');
            $end = $this->field('end');
            $data = Transaksi::with(['user.member'])
                ->where('status', '=', 5)
                ->whereBetween('tanggal_pinjam', [$start, $end])
                ->orderBy('updated_at', 'ASC')
                ->get();
            return $this->basicDataTables($data);
        }
        return view('admin.laporan.peminjaman');
    }

    public function pdf()
    {
        $start = $this->field('start');
        $end = $this->field('end');
        $data = Transaksi::with(['user.member'])
            ->where('status', '=', 5)
            ->whereBetween('tanggal_pinjam', [$start, $end])
            ->orderBy('updated_at', 'ASC')
            ->get();
        return $this->convertToPdf('admin.laporan.cetak', [
            'data' => $data,
            'start' => $start,
            'end' => $end
        ]);

    }
}
