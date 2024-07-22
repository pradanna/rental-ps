@extends('customer.base')

@section('morecss')
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"
            integrity="sha256-FZsW7H2V5X9TGinSjjwYJ419Xka27I8XPDmWryGlWtw=" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css"
          integrity="sha256-5uKiXEwbaQh9cgd2/5Vp6WmMnsUr3VZZw0a8rKnOKNU=" crossorigin="anonymous">
    {{-- DATA TABLES --}}
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" />
    <link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css" />
    <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/style.member.css') }}" rel="stylesheet">
    <style>
        .btn-table-action-delete {
            width: 25px;
            height: 25px;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: var(--danger);
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }

        .btn-table-action-delete:hover {
            color: white;
            text-decoration: none;
        }
    </style>
@endsection

@section('content')
    <div class="sewaps">
        <div class="p-4">
            <p style="color: var(--dark); font-size: 1.5em; font-weight: bold">Keranjang Sewa</p>
            <div class="d-flex" style="gap: 1rem">
                <div class="flex-grow-1">
                    <div class="card-content">
                        <table id="table-data" class="display table w-100">
                            <thead>
                            <tr>
                                <th width="5%" class="text-center">#</th>
                                <th width="10%" class="text-center">Gambar</th>
                                <th width="15%" class="text-center">Kategori</th>
                                <th>No. Unit</th>
                                <th width="10%" class="text-end">Harga</th>
                                <th width="8%" class="text-center"></th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="cart-action-container">
                    <p style="font-size: 1em; font-weight: bold; color: var(--dark);">Ringkasan Belanja</p>
                    <hr class="custom-divider"/>
                    <div class="w-100">
                        <div class="w-100 mb-1">
                            <label for="pcb_date" class="form-label input-label">Tanggal Kembali</label>
                            <input type="date" class="text-input"
                                   id="pcb_date"
                                   name="pcb_date" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" />
                        </div>
                    </div>
                    <hr class="custom-divider"/>
                    <div class="d-flex align-items-center justify-content-between mb-1" style="font-size: 1em;">
                        <span style="color: var(--dark-tint); font-size: 0.8em">Total</span>
                        <span id="lbl-sub-total"
                              style="color: var(--dark); font-weight: 600;">Rp{{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                    <hr class="custom-divider"/>
                    <a href="#" class="btn-action-primary mb-1" id="btn-checkout" style="padding: 0.75rem 1rem; height: fit-content;">Checkout</a>
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
                ajax: {
                    type: 'GET',
                    url: path,
                },
                "aaSorting": [],
                "order": [],
                scrollX: true,
                responsive: true,
                paging: true,
                "fnDrawCallback": function (setting) {
                    eventDelete();
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
                        className: 'middle-header text-center',
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

                    {
                        data: null,
                        orderable: false,
                        className: 'text-center middle-header',
                        render: function (data) {
                            let id = data['id'];
                            return '<div class="w-100 d-flex justify-content-center align-items-center gap-1">' +
                                '<a href="#" class="btn-table-action-delete" data-id="' + id + '"><i class="material-symbols-outlined" style="font-size: 0.8em">delete</i></a>' +
                                '</div>';
                        }
                    }
                ],
            });
        }

        function eventDelete() {
            $('.btn-table-action-delete').on('click', function (e) {
                e.preventDefault();
                let id = this.dataset.id;
                let url = path + '/' + id + '/delete';
                BaseDeleteHandler(url, id);
            })
        }

        $(document).ready(function () {
            generateTable();
        })
    </script>
@endsection
