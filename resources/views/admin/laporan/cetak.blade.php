<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="css/bootstrap3.min.css" rel="stylesheet">
    <style>
        .report-title {
            font-size: 14px;
            font-weight: bolder;
        }

        .f-bold {
            font-weight: bold;
        }

        .footer {
            position: fixed;
            bottom: 0cm;
            right: 0cm;
            height: 2cm;
        }

        .f-small {
            font-size: 0.8em;
        }

        .f-semi-bold {
            font-weight: 600;
        }

        .middle-header {
            vertical-align: middle !important;
        }
    </style>
</head>
<body>
<div class="text-center f-bold report-title">Laporan Penjualan</div>
<div class="text-center f-small">Periode Laporan {{ $start }} - {{ $end }}</div>
<hr/>
<table id="my-table" class="table display f-small">
    <thead>
    <tr>
        <th width="5%" class="text-center f-small f-semi-bold">#</th>
        <th width="15%" class="text-center f-semi-bold">Tanggal Pinjam</th>
        <th width="15%" class="text-center f-semi-bold">No. Peminjaman</th>
        <th class="f-semi-bold">Customer</th>
        <th width="12%" class="text-right f-semi-bold">Total</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $v)
        <tr>
            <td class="text-center f-small middle-header">{{ $loop->index + 1 }}</td>
            <td class="f-small middle-header text-center">{{ $v->tanggal_pinjam }}</td>
            <td class="f-small middle-header text-center">{{ $v->no_peminjaman }}</td>
            <td class="f-small middle-header">{{ $v->user->member->nama }}</td>
            <td class="f-small middle-header text-right">
                {{ number_format($v->total, 0, ',', '.') }}
            </td>
        </tr>
    @endforeach
    </tbody>

</table>
<hr/>
<div class="row">
    <div class="col-xs-7"></div>
    <div class="col-xs-4">
        <div class="text-right">
            <p class="text-right f-bold">Total Pendapatan : {{ number_format($data->sum('total'), 0, ',', '.') }}</p>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-8"></div>
    <div class="col-xs-3">
        <div class="text-center">
            <p class="text-center">{{ \Carbon\Carbon::now()->format('Y-m-d') }}</p>
            <br>
            <br>
            <br>
            <p class="text-center">Admin</p>
        </div>
    </div>
</div>
</body>
</html>
