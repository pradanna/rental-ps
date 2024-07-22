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
            <p style="color: var(--dark); font-size: 1.5em; font-weight: bold">Transaksi Peminjaman</p>
            <div class="card-content">
                <table id="table-data" class="display table w-100">
                    <thead>
                    <tr>
                        <th width="5%" class="text-center">#</th>
                        <th>No. Penjualan</th>
                        <th width="10%" class="text-center">Tanggal Pinjam</th>
                        <th width="10%" class="text-center">Tanggal Kembali</th>
                        <th width="10%" class="text-end">Total</th>
                        <th width="10%" class="text-end">DP</th>
                        <th width="10%" class="text-end">Kekurangan</th>
                        <th width="13%" class="text-center">Status</th>
                        <th width="8%" class="text-center"></th>
                    </tr>
                    </thead>
                </table>
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
                ajax: {
                    type: 'GET',
                    url: path,
                },
                "aaSorting": [],
                "order": [],
                scrollX: true,
                responsive: true,
                // paging: true,
                "fnDrawCallback": function (setting) {
                },
                'dom': 't',
                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        searchable: false,
                        orderable: false,
                        className: 'text-center middle-header',
                    },
                    {
                        data: 'no_peminjaman',
                        className: 'middle-header',
                    },
                    {
                        data: 'tanggal_pinjam',
                        className: 'middle-header text-center',
                    },
                    {
                        data: 'tanggal_kembali',
                        className: 'middle-header text-center',
                    },
                    {
                        data: 'total',
                        className: 'middle-header text-end',
                        render: function (data) {
                            return data.toLocaleString('id-ID');
                        }
                    },

                    {
                        data: 'dp',
                        className: 'middle-header text-end',
                        render: function (data) {
                            return data.toLocaleString('id-ID');
                        }
                    },
                    {
                        data: 'kekurangan',
                        className: 'middle-header text-end',
                        render: function (data) {
                            return data.toLocaleString('id-ID');
                        }
                    },
                    {
                        data: 'status',
                        orderable: false,
                        className: 'middle-header text-center',
                        render: function (data) {
                            let status = '-';
                            switch (data) {
                                case 0:
                                    status = '<div class="chip-status-danger">menunggu pembayaran</div>';
                                    break;
                                case  1:
                                    status = '<div class="chip-status-warning">menunggu konfirmasi pembayaran</div>';
                                    break;
                                case  2:
                                    status = '<div class="chip-status-danger">pembayaran di tolak</div>';
                                    break;
                                case  3:
                                    status = '<div class="chip-status-info">barang siap diambil</div>';
                                    break;
                                case  4:
                                    status = '<div class="chip-status-info">sedang meminjam</div>';
                                    break;
                                case  5:
                                    status = '<div class="chip-status-success">selesai</div>';
                                    break;
                                default:
                                    break;
                            }
                            return status;
                        }
                    },
                    {
                        data: null,
                        orderable: false,
                        className: 'text-center middle-header',
                        render: function (data) {
                            let id = data['id'];
                            let urlDetail = path + '/' + id;
                            return '<div class="w-100 d-flex justify-content-center align-items-center gap-1">' +
                                '<a style="color: var(--dark-tint)" href="' + urlDetail + '" class="btn-table-action-delete" data-id="' + id + '"><span class="material-symbols-outlined" style="font-size: 0.8em;">more_vert</span></a>' +
                                '</div>';
                        }
                    }
                ],
            });
        }

        $(document).ready(function () {
            generateTable();
        })
    </script>
@endsection
