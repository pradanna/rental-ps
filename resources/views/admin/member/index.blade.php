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
                <p class="content-title">Member</p>
                <p class="content-sub-title">Manajemen data member</p>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Member</li>
                </ol>
            </nav>
        </div>
        <div class="kategori">
            <div class="container-admin px-3">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-container p-4">
                            <div class="content-header mb-3">
                                <p class="header-title">Data Member</p>
                            </div>
                            <hr class="custom-divider"/>
                            <table id="table-data" class="table table-striped" style="width:100%">
                                <thead>
                                <tr>
                                    <th width="5%" class="text-center">#</th>
                                    <th width="15%" class="text-center">Username</th>
                                    <th width="15%" class="text-center">Nama</th>
                                    <th width="15%" class="text-center">No. Hp</th>
                                    <th class="text-start">Alamat</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    {{--                    <div class="col-md-4">--}}

                    {{--                    </div>--}}
                </div>
            </div>
        </div>
    </div>

@endsection

@section('morejs')
    <script src="{{ asset('/js/helper.js') }}"></script>
    <script>
        var path = '/{{ request()->path() }}';
        var table;

        function generateTable() {
            table = $('#table-data').DataTable({
                ajax: {
                    type: 'GET',
                    url: path,
                    // 'data': data
                },
                "aaSorting": [],
                "order": [],
                scrollX: true,
                responsive: true,
                paging: true,
                "fnDrawCallback": function (setting) {
                    eventDelete();
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false, className: 'text-center middle-header',},
                    {
                        data: 'user.username',
                        className: 'middle-header text-center',
                    },
                    {
                        data: 'nama',
                        className: 'middle-header text-center',
                    },
                    {
                        data: 'no_hp',
                        className: 'middle-header text-center',
                    },
                    {
                        data: 'alamat',
                        className: 'middle-header',
                    },
                ],
            });
        }

        function eventDelete() {
            $('.btn-table-action-delete').on('click', function (e) {
                e.preventDefault();
                let id = this.dataset.id;
                AlertConfirm('Konfirmasi', 'Apakah anda yakin ingin menghapus data?', function () {
                    let url = path + '/' + id + '/delete';
                    BaseDeleteHandler(url, id);
                })
            })
        }

        $(document).ready(function () {
            generateTable();
        });
    </script>
@endsection
