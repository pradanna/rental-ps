@extends('admin.base')

@section('morecss')
    <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/style.admin.css') }}" rel="stylesheet">
@endsection

@section('content')
    @if (\Illuminate\Support\Facades\Session::has('failed'))
        <script>
            Swal.fire("Ooops", '{{ \Illuminate\Support\Facades\Session::get('failed') }}', "error")
        </script>
    @endif
    @if (\Illuminate\Support\Facades\Session::has('success'))
        <script>
            Swal.fire({
                title: 'Success',
                text: '{{ \Illuminate\Support\Facades\Session::get('success') }}',
                icon: 'success',
                timer: 700
            }).then(() => {
                window.location.reload();
            })
        </script>
    @endif
    <div class="p-3">
        <div class="d-flex justify-content-between align-items-center mb-1">
            <div>
                <p class="content-title">Peminjaman</p>
                <p class="content-sub-title">Manajemen data peminjaman</p>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Peminjaman</li>
                </ol>
            </nav>
        </div>
        <ul class="nav nav-pills mb-3 custom-tab-pills" id="transaction-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link custom-tab-link active" id="pills-new-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-new"
                        type="button" role="tab" aria-controls="pills-new" aria-selected="true">
                    Peminjaman Baru
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link custom-tab-link" id="pills-ready-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-ready"
                        type="button" role="tab" aria-controls="pills-ready" aria-selected="false">
                    Siap Di Ambil
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link custom-tab-link" id="pills-process-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-process"
                        type="button" role="tab" aria-controls="pills-process" aria-selected="false">
                    Peminjaman Berlangsung
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link custom-tab-link" id="pills-finish-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-finish"
                        type="button" role="tab" aria-controls="pills-finish" aria-selected="false">
                    Peminjaman Selesai
                </button>
            </li>
        </ul>
        <div class="tab-content" id="transaction-content">
            <div class="tab-pane fade show active" id="pills-new" role="tabpanel" aria-labelledby="pills-new-tab">
                <div class="card-content">
                    <div class="content-header mb-3">
                        <p class="header-title">Data Peminjaman Baru</p>
                    </div>
                    <hr class="custom-divider"/>
                    <table id="table-data-new-order" class="display table w-100">
                        <thead>
                        <tr>
                            <th width="5%" class="text-center">#</th>
                            <th>No. Peminjaman</th>
                            <th width="10%" class="text-end">Total</th>
                            <th width="10%" class="text-end">DP</th>
                            <th width="10%" class="text-end">Kekurangan</th>
                            <th width="8%" class="text-center">Detail</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-ready" role="tabpanel" aria-labelledby="pills-ready-tab">
                <div class="card-content">
                    <div class="content-header mb-3">
                        <p class="header-title">Data Pesanan Menunggu Di Ambil</p>
                    </div>
                    <hr class="custom-divider"/>
                    <table id="table-data-ready-order" class="display table w-100">
                        <thead>
                        <tr>
                            <th width="5%" class="text-center">#</th>
                            <th width="20%" class="text-center">No. Peminjaman</th>
                            <th>Nama</th>
                            <th width="15%" class="text-center">No. HP</th>
                            <th width="8%" class="text-center">Detail</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-process" role="tabpanel" aria-labelledby="pills-process-tab">
                <div class="card-content">
                    <div class="content-header mb-3">
                        <p class="header-title">Data Pesanan Di Proses</p>
                    </div>
                    <hr class="custom-divider"/>
                    <table id="table-data-process-order" class="display table w-100">
                        <thead>
                        <tr>
                            <th width="5%" class="text-center">#</th>
                            <th width="20%" class="text-center">No. Peminjaman</th>
                            <th>Nama</th>
                            <th width="15%" class="text-center">No. HP</th>
                            <th width="8%" class="text-center">Detail</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>

            <div class="tab-pane fade" id="pills-finish" role="tabpanel" aria-labelledby="pills-finish-tab">
                <div class="card-content">
                    <div class="content-header mb-3">
                        <p class="header-title">Data Pesanan Selesai</p>
                    </div>
                    <hr class="custom-divider"/>
                    <table id="table-data-finish-order" class="display table w-100">
                        <thead>
                        <tr>
                            <th width="5%" class="text-center">#</th>
                            <th width="12%" class="text-center">Tanggal</th>
                            <th width="20%" class="text-center">No. Peminjaman</th>
                            <th>Nama</th>
                            <th width="15%" class="text-end">Sub Total</th>
                            <th width="15%" class="text-end">Denda</th>
                            <th width="15%" class="text-end">Total</th>
                            <th width="8%" class="text-center">Detail</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>

    </div>

@endsection

@section('morejs')
    <script src="{{ asset('/js/helper.js') }}"></script>
    <script>
        var path = '/{{ request()->path() }}';
        var table, tableReady, tableProcess, tableFinish;

        function generateTableNewOrder() {
            table = $('#table-data-new-order').DataTable({
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
                        data: 'no_peminjaman',
                        className: 'middle-header',
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
                        data: null,
                        orderable: false,
                        className: 'text-center middle-header',
                        render: function (data) {
                            let id = data['id'];
                            let urlDetail = path + '/' + id + '/peminjaman-baru';
                            return '<div class="w-100 d-flex justify-content-center align-items-center gap-1">' +
                                '<a style="color: var(--dark-tint)" href="' + urlDetail + '" class="btn-table-action" data-id="' + id + '"><span class="material-symbols-outlined" style="font-size: 0.8em;">more_vert</span></a>' +
                                '</div>';
                        }
                    }
                ],
            });
        }

        function generateTableReady() {
            tableReady = $('#table-data-ready-order').DataTable({
                ajax: {
                    type: 'GET',
                    url: path,
                    'data': function (d) {
                        d.status = 2
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
                        data: 'no_peminjaman',
                        className: 'middle-header text-center',
                    },
                    {
                        data: 'user.member.nama',
                        className: 'middle-header',
                    },
                    {
                        data: 'user.member.no_hp',
                        className: 'middle-header text-center',
                    },
                    {
                        data: null,
                        orderable: false,
                        className: 'text-center middle-header',
                        render: function (data) {
                            let id = data['id'];
                            let urlDetail = path + '/' + id + '/siap-diambil';
                            return '<div class="w-100 d-flex justify-content-center align-items-center gap-1">' +
                                '<a style="color: var(--dark-tint)" href="' + urlDetail + '" class="btn-table-action" data-id="' + id + '"><span class="material-symbols-outlined" style="font-size: 0.8em;">more_vert</span></a>' +
                                '</div>';
                        }
                    }
                ],
            });
        }

        function generateTableProcess() {
            tableProcess = $('#table-data-process-order').DataTable({
                ajax: {
                    type: 'GET',
                    url: path,
                    'data': function (d) {
                        d.status = 3
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
                        data: 'no_peminjaman',
                        className: 'middle-header text-center',
                    },
                    {
                        data: 'user.member.nama',
                        className: 'middle-header',
                    },
                    {
                        data: 'user.member.no_hp',
                        className: 'middle-header text-center',
                    },
                    {
                        data: null,
                        orderable: false,
                        className: 'text-center middle-header',
                        render: function (data) {
                            let id = data['id'];
                            let urlDetail = path + '/' + id + '/peminjaman-proses';
                            return '<div class="w-100 d-flex justify-content-center align-items-center gap-1">' +
                                '<a style="color: var(--dark-tint)" href="' + urlDetail + '" class="btn-table-action" data-id="' + id + '"><span class="material-symbols-outlined" style="font-size: 0.8em;">more_vert</span></a>' +
                                '</div>';
                        }
                    }
                ],
            });
        }

        function generateTableFinish() {
            tableFinish = $('#table-data-finish-order').DataTable({
                ajax: {
                    type: 'GET',
                    url: path,
                    'data': function (d) {
                        d.status = 4
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
                        data: 'tanggal_pinjam',
                        className: 'middle-header text-center',
                    },
                    {
                        data: 'no_peminjaman',
                        className: 'middle-header text-center',
                    },
                    {
                        data: 'user.member.nama',
                        className: 'middle-header',
                    },
                    {
                        data: 'sub_total',
                        className: 'middle-header text-end',
                        render: function (data) {
                            return data.toLocaleString('id-ID');
                        }
                    },
                    {
                        data: 'denda',
                        className: 'middle-header text-end',
                        render: function (data) {
                            return data.toLocaleString('id-ID');
                        }
                    },
                    {
                        data: 'total',
                        className: 'middle-header text-end',
                        render: function (data) {
                            return data.toLocaleString('id-ID');
                        }
                    },
                    {
                        data: null,
                        orderable: false,
                        className: 'text-center middle-header',
                        render: function (data) {
                            let id = data['id'];
                            let urlDetail = path + '/' + id + '/peminjaman-selesai';
                            return '<div class="w-100 d-flex justify-content-center align-items-center gap-1">' +
                                '<a style="color: var(--dark-tint)" href="' + urlDetail + '" class="btn-table-action" data-id="' + id + '"><span class="material-symbols-outlined" style="font-size: 0.8em;">more_vert</span></a>' +
                                '</div>';
                        }
                    }
                ],
            });
        }

        function eventChangeTab() {
            $('#transaction-tab').on('shown.bs.tab', function (e) {
                if (e.target.id === 'pills-ready-tab') {
                    tableReady.columns.adjust();
                }

                if (e.target.id === 'pills-process-tab') {
                    tableProcess.columns.adjust();
                }

                if (e.target.id === 'pills-finish-tab') {
                    tableFinish.columns.adjust();
                }
            })
        }
        $(document).ready(function () {
            generateTableNewOrder();
            generateTableReady();
            generateTableProcess();
            generateTableFinish();
            eventChangeTab();
        });
    </script>
@endsection
