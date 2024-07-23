@extends('admin.base')

@section('morecss')
    <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/style.admin.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="p-3">
        <div class="d-flex justify-content-between align-items-center mb-1">
            <div>
                <p class="content-title">Peminjaman</p>
                <p class="content-sub-title">Manajemen data peminjaman</p>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.transaction') }}">Peminjaman</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $data->no_peminjaman }}</li>
                </ol>
            </nav>
        </div>
        <div class="card-content">
            <div class="content-header mb-3">
                <p class="header-title" style="font-size: 0.8em">Data Pesanan</p>
            </div>
            <hr class="custom-divider"/>
            <div class="row w-100">
                <div class="col-8">
                    <div class="w-100 d-flex align-items-center mb-1"
                         style="font-size: 0.8em; font-weight: 600; color: var(--dark);">
                        <p style="margin-bottom: 0; font-weight: 500;" class="me-2">No. Peminjaman :</p>
                        <p style="margin-bottom: 0">{{ $data->no_peminjaman }}</p>
                    </div>
                    <div class="w-100 d-flex align-items-center mb-1"
                         style="font-size: 0.8em; font-weight: 600; color: var(--dark);">
                        <p style="margin-bottom: 0; font-weight: 500;" class="me-2">Peminjaman :</p>
                        <p style="margin-bottom: 0">{{ $data->user->username }}</p>
                    </div>
                    <div class="w-100 d-flex align-items-center mb-1"
                         style="font-size: 0.8em; font-weight: 600; color: var(--dark);">
                        <p style="margin-bottom: 0; font-weight: 500;" class="me-2">Tanggal Pinjam :</p>
                        <p style="margin-bottom: 0">{{ \Carbon\Carbon::parse($data->tanggal_pinjam)->format('d F Y') }}</p>
                    </div>
                    <div class="w-100 d-flex align-items-center mb-1"
                         style="font-size: 0.8em; font-weight: 600; color: var(--dark);">
                        <p style="margin-bottom: 0; font-weight: 500;" class="me-2">Tanggal Kembali :</p>
                        <p style="margin-bottom: 0">{{ \Carbon\Carbon::parse($data->tanggal_kembali)->format('d F Y') }}</p>
                    </div>
                </div>
                <div class="col-4"></div>
            </div>
            <hr class="custom-divider"/>
            <div class="row">
                <div class="col-12">
                    <table id="table-data-cart" class="display table w-100">
                        <thead>
                        <tr>
                            <th width="5%" class="text-center">#</th>
                            <th width="12%" class="text-center middle-header">Gambar</th>
                            <th width="15%" class="text-center middle-header">Kategori</th>
                            <th>Nama Product</th>
                            <th width="10%" class="text-end">Total</th>
                        </tr>
                        </thead>
                    </table>
                    <hr class="custom-divider"/>
                    <div class="w-100 d-flex justify-content-end mb-1" style="font-size: 0.8em; font-weight: bold; color: var(--dark);">
                        <div class="me-2 w-100 text-end" style="width: 80%">Sub Total :</div>
                        <div class="text-end" style="width: 20%">Rp.{{ number_format($data->sub_total, 0, ',', '.') }}</div>
                    </div>
                    <div class="w-100 d-flex justify-content-end mb-1" style="font-size: 0.8em; font-weight: bold; color: var(--dark);">
                        <div class="me-2 w-100 text-end" style="width: 80%">DP :</div>
                        <div class="text-end" style="width: 20%">Rp.{{ number_format($data->dp, 0, ',', '.') }}</div>
                    </div>
                    <hr class="custom-divider"/>
                    <div class="w-100 d-flex justify-content-end" style="font-size: 0.8em; font-weight: bold; color: var(--dark);">
                        <div class="me-2 w-100 text-end" style="width: 80%">Keterlambatan :</div>
                        <div class="text-end" style="width: 20%">{{ $keterlambatan }} hari</div>
                    </div>
                    <div class="w-100 d-flex justify-content-end" style="font-size: 0.8em; font-weight: bold; color: var(--dark);">
                        <div class="me-2 w-100 text-end" style="width: 80%">Kekurangan :</div>
                        <div class="text-end" style="width: 20%">Rp.{{ number_format($data->kekurangan, 0, ',', '.') }}</div>
                    </div>
                    <div class="w-100 d-flex justify-content-end" style="font-size: 0.8em; font-weight: bold; color: var(--dark);">
                        <div class="me-2 w-100 text-end" style="width: 80%">Total Denda :</div>
                        <div class="text-end" style="width: 20%">Rp.{{ number_format($total_denda, 0, ',', '.') }}</div>
                    </div>
                    <div class="w-100 d-flex justify-content-end" style="font-size: 0.8em; font-weight: bold; color: var(--dark);">
                        <div class="me-2 w-100 text-end" style="width: 80%"></div>
                        <div class="text-end" style="width: 20%">
                            <hr class="custom-divider" />
                        </div>
                    </div>
                    <div class="w-100 d-flex justify-content-end" style="font-size: 1em; font-weight: bold; color: var(--dark);">
                        <div class="me-2 w-100 text-end" style="width: 80%">Jumlah Yang Harus Di Bayar :</div>
                        <div class="text-end" style="width: 20%">Rp.{{ number_format(($total_denda + $data->kekurangan), 0, ',', '.') }}</div>
                    </div>
                </div>
                {{--                <div class="col-3">--}}
                {{--                    <div class="w-100" style="border: 1px solid var(--dark-tint); border-radius: 8px; padding: 0.5rem 0.5rem;">--}}
                {{--                        <p style="font-size: 0.8em; font-weight: 600; color: var(--dark);">Ringkasan Pembayaran</p>--}}
                {{--                        <hr class="custom-divider"/>--}}
                {{--                        <div class="w-100 mb-1" style="font-size: 0.8em; font-weight: 600; color: var(--dark);">--}}
                {{--                            {{ $data->pembayaran_status->bank }} ({{ $data->pembayaran_status->atas_nama }})--}}
                {{--                        </div>--}}
                {{--                        <img src="{{ $data->pembayaran_status->bukti }}" alt="img-transfer"--}}
                {{--                             style="width: 100%; height: auto; object-fit: cover; object-position: center center;">--}}
                {{--                    </div>--}}
                {{--                </div>--}}
            </div>

            <hr class="custom-divider"/>
            <div class="w-100 justify-content-end d-flex">
                <button class="btn-add" id="btn-confirm">
                    <span>Di Kembalikan</span>
                </button>
            </div>
        </div>
    </div>
@endsection

@section('morejs')
    <script src="{{ asset('/js/helper.js') }}"></script>
    <script>
        var path = '/{{ request()->path() }}';
        var table;

        function generateTableKeranjang() {
            table = $('#table-data-cart').DataTable({
                ajax: {
                    type: 'GET',
                    url: path,
                    'data': function (d) {
                        d.status = 1
                    }
                },
                "aaSorting": [],
                "order": [],
                scrollX: true,
                responsive: true,
                paging: true,
                "fnDrawCallback": function (setting) {
                },
                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        searchable: false,
                        orderable: false,
                        className: 'text-center middle-header',
                    },
                    {
                        data: 'product.kategori.gambar',
                        orderable: false,
                        className: 'middle-header text-center',
                        render: function (data) {
                            if (data !== null) {
                                return '<div class="w-100 d-flex justify-content-center">' +
                                    '<a href="' + data + '" target="_blank" class="box-product-image">' +
                                    '<img src="' + data + '" alt="product-image" />' +
                                    '</a>' +
                                    '</div>';
                            }
                            return '-';
                        }
                    },
                    {
                        data: 'product.kategori.nama',
                        className: 'middle-header',
                    },
                    {
                        data: 'product.nama',
                        className: 'middle-header',
                    },

                    {
                        data: 'total',
                        className: 'middle-header text-end',
                        render: function (data) {
                            return data.toLocaleString('id-ID');
                        }
                    },
                ],
            });
        }

        function eventChangeConfirmation() {
            $('.payment-status').on('change', function () {
                changeConfirmationHandler();
            })
        }

        function changeConfirmationHandler() {
            let val = $('input[name=payment-status]:checked').val();
            let elPanelReason = $('#panel-reason');
            if (val === '0') {
                elPanelReason.removeClass('d-none');
            } else {
                elPanelReason.addClass('d-none');
            }
        }

        function eventSaveConfirmation() {
            $('#btn-confirm').on('click', function (e) {
                e.preventDefault();
                AlertConfirm('Konfirmasi', 'Apakah anda yakin ingin melakukan konfirmasi pengembalian?', function () {
                    saveConfirmationHandler();
                })
            })
        }

        async function saveConfirmationHandler() {
            try {
                let status = $('input[name=payment-status]:checked').val();
                let reason = $('#reason').val();
                await $.post(path, {status, reason});
                Swal.fire({
                    title: 'Success',
                    text: 'Berhasil melakukan konfirmasi data...',
                    icon: 'success',
                    timer: 700
                }).then(() => {
                    window.location.href = '/admin/peminjaman';
                })
            }catch (e) {
                let error_message = JSON.parse(e.responseText);
                ErrorAlert('Error', error_message.message);
            }
        }

        $(document).ready(function () {
            generateTableKeranjang();
            eventChangeConfirmation();
            eventSaveConfirmation();
        })
    </script>
@endsection
