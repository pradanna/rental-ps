<?php


namespace App\Http\Controllers\Customer;


use App\Helper\CustomController;
use App\Models\Keranjang;
use App\Models\Product;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class KeranjangController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = Keranjang::with(['product.kategori'])
            ->whereNull('transaksi_id')
            ->where('user_id', '=', auth()->id())
            ->get();
        if ($this->request->ajax()) {
            return $this->basicDataTables($data);
        }
        $total = $data->sum('total');
        return view('customer.keranjang')->with([
            'total' => $total
        ]);
    }

    public function destroy($id)
    {
        try {
            Keranjang::destroy($id);
            return $this->jsonSuccessResponse('Berhasil menghapus data...');
        } catch (\Exception $e) {
            return $this->jsonErrorResponse();
        }
    }

    public function checkout()
    {
        try {
            DB::beginTransaction();
            $carts = Keranjang::with([])
                ->where('user_id', '=', auth()->id())
                ->whereNull('transaksi_id')
                ->get();

            $dp = $this->postField('dp');
            $date_return = $this->postField('date_return');
            $diff_date = $this->postField('diff_date');
            $total = $carts->sum('total') * $diff_date;
            $transactionRef = 'SJY-' . date('YmdHis');

//            $now = Carbon::now();
//            $returnDate = Carbon::parse($date_return);
//            $dateDiff = $returnDate->diff($now)->days;
//            dd($dateDiff);
            $data_request = [
                'user_id' => auth()->id(),
                'tanggal' => Carbon::now()->format('Y-m-d'),
                'no_peminjaman' => $transactionRef,
                'tanggal_pinjam' => Carbon::now()->format('Y-m-d'),
                'tanggal_kembali' => $date_return,
                'sub_total' => $total,
                'dp' => $dp,
                'denda' => 0,
                'total' => $total,
                'lunas' => false,
                'status' => 0,
                'alamat' => '-',
            ];
            $transaction = Transaksi::create($data_request);

            foreach ($carts as $cart) {
                $cart->update([
                    'transaksi_id' => $transaction->id
                ]);
            }
            $transactionID = $transaction->id;
            DB::commit();
            return redirect()->route('customer.transaction.payment', ['id' => $transactionID]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('failed', 'terjadi kesalahan server...');
        }
    }

    private function addToCart()
    {
        try {
            $userID = auth()->id();
            $productID = $this->postField('id');
            $qty = $this->postField('qty');

            $product = Product::with([])
                ->where('id', '=', $productID)
                ->firstOrFail();
            if (!$product) {
                return $this->jsonErrorResponse('product tidak ditemukan');
            }

            $productPrice = $product->harga;
            $total = (int)$qty * $productPrice;
            $data_request = [
                'user_id' => $userID,
                'transaksi_id' => null,
                'product_id' => $productID,
                'total' => $total
            ];
            Keranjang::create($data_request);
            return $this->jsonSuccessResponse('success', 'Berhasil menambahkan keranjang...');
        } catch (\Exception $e) {
            return $this->jsonErrorResponse();
        }
    }
}
