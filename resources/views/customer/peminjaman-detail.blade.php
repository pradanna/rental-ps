@extends('customer.base')

@section('morecss')
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"
            integrity="sha256-FZsW7H2V5X9TGinSjjwYJ419Xka27I8XPDmWryGlWtw=" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css"
          integrity="sha256-5uKiXEwbaQh9cgd2/5Vp6WmMnsUr3VZZw0a8rKnOKNU=" crossorigin="anonymous">
    {{-- DATA TABLES --}}
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css"/>
    <link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css"/>
    <link href="{{ asset('/css/dropzone.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/style.member.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="sewaps">
        <div class="p-4">
            <p style="color: var(--dark); font-size: 1.5em; font-weight: bold">Transaksi
                Peminjaman {{ $data->no_peminjaman }}</p>
            <div class="mb-3" style="font-size: 0.8em; color: var(--dark);">
                <div class="d-flex align-items-center mb-1">
                    <span style="" class="me-2">No. Peminjaman :</span>
                    <span style="font-weight: 600;">{{ $data->no_peminjaman }}</span>
                </div>
                <div class="d-flex align-items-center mb-1">
                    <span style="" class="me-2">Tgl. Pinjam :</span>
                    <span
                        style="font-weight: 600;">{{ \Carbon\Carbon::parse($data->tanggal_pinjam)->format('d F Y') }}</span>
                </div>
                <div class="d-flex align-items-center mb-1">
                    <span style="" class="me-2">Tgl. Kembali :</span>
                    <span
                        style="font-weight: 600;">{{ \Carbon\Carbon::parse($data->tanggal_kembali)->format('d F Y') }}</span>
                </div>
                <div class="d-flex align-items-center mb-1">
                    <span style="" class="me-2">Status :</span>
                    <span style="font-weight: 600;">
                       @if($data->status === 0)
                            <div class="chip-status-danger">menunggu pembayaran</div>
                        @elseif($data->status === 1)
                            <div class="chip-status-warning">menunggu konfirmasi pembayaran</div>
                        @elseif($data->status === 2)
                            <div class="chip-status-danger">pembayaran di tolak</div>
                        @elseif($data->status === 3)
                            <div class="chip-status-info">sedang meminjam</div>
                        @elseif($data->status === 4)
                            <div class="chip-status-success">selesai</div>
                        @endif
                    </span>
                </div>
            </div>
            <hr class="custom-divider"/>
            <div class="d-flex w-100 gap-3">
                <div class="flex-grow-1 d-flex gap-2">
                    <div class="w-100">
                        <div class="card-content">
                            <table id="table-data" class="display table w-100">
                                <thead>
                                <tr>
                                    <th width="5%" class="text-center">#</th>
                                    <th width="10%" class="text-center">Gambar</th>
                                    <th width="15%" class="text-center">Kategori</th>
                                    <th>No. Unit</th>
                                    <th width="10%" class="text-end">Harga</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data->keranjang as $keranjang)
                                    <tr>
                                        <td width="5%" class="text-center">{{ $loop->index + 1 }}</td>
                                        <td width="10%" class="text-center">
                                            <div class="d-flex justify-content-center w-100">
                                                <a href="{{ asset($keranjang->product->kategori->gambar) }}" target="_blank" class="box-product-image">
                                                    <img src="{{ asset($keranjang->product->kategori->gambar) }}" alt="product-image" />
                                                </a>
                                            </div>
                                        </td>
                                        <td width="15%" class="text-center">{{ $keranjang->product->kategori->nama }}</td>
                                        <td>{{ $keranjang->product->nama }}</td>
                                        <td width="10%" class="text-end">{{ number_format($keranjang->product->harga, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card-content" style="width: 350px; height: fit-content;">
                    <p style="font-size: 1em; font-weight: bold; color: var(--dark);">Ringkasan Belanja</p>
                    <hr class="custom-divider"/>
                    <div class="d-flex align-items-center justify-content-between mb-1" style="font-size: 1em;">
                        <span style="color: var(--dark-tint); font-size: 0.8em">Total</span>
                        <span id="lbl-sub-total"
                              style="color: var(--dark); font-weight: 600;">Rp{{ number_format($data->total, 0, ',', '.') }}</span>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-3" style="font-size: 1em;">
                        <span style="color: var(--dark-tint); font-size: 0.8em">DP</span>
                        <span id="lbl-shipment"
                              style="color: var(--dark); font-weight: 600;">Rp{{ number_format($data->dp, 0, ',', '.') }}</span>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-1" style="font-size: 1em;">
                        <span style="color: var(--dark-tint); font-size: 0.8em">Kekurangan</span>
                        <span id="lbl-total"
                              style="color: var(--dark); font-weight: bold;">Rp{{ number_format($data->kekurangan, 0, ',', '.') }}</span>
                    </div>

                    @if($data->status === 0 || $data->status === 2)
                        <hr class="custom-divider"/>
                        <a href="{{ route('customer.transaction.payment', ['id' => $data->id]) }}"
                           class="btn-action-primary" style="height: fit-content;">Bayar</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('morejs')
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
    <script src="{{ asset('/js/helper.js') }}"></script>
    <script>
        var path = '/{{ request()->path() }}';
        var table;

        function generateTable() {
            table = $('#table-data').DataTable({
                dom: 't',
                "aaSorting": [],
                "order": [],
                scrollX: true,
                responsive: true,
            });
        }

        $(document).ready(function () {
            generateTable();
        })
    </script>
@endsection
