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
<div class="text-center f-bold report-title">Nota Peminjaman</div>
<hr/>
<div class="row" style="margin-bottom: 5px;">
    <div class="col-xs-2 f-small f-semi-bold">No. Peminjaman</div>
    <div class="col-xs-9 f-small">: {{ $data->no_peminjaman }}</div>
</div>
<div class="row" style="margin-bottom: 5px;">
    <div class="col-xs-2 f-small f-semi-bold">Peminjaman</div>
    <div class="col-xs-9 f-small">: {{ $data->user->username }}</div>
</div>
<div class="row" style="margin-bottom: 5px;">
    <div class="col-xs-2 f-small f-semi-bold">Tanggal Pinjam</div>
    <div class="col-xs-9 f-small">: {{ \Carbon\Carbon::parse($data->tanggal_pinjam)->format('d F Y') }}</div>
</div>
<div class="row" style="margin-bottom: 5px;">
    <div class="col-xs-2 f-small f-semi-bold">Tanggal Kembali</div>
    <div class="col-xs-9 f-small">: {{ $data->tanggal_kembali }}</div>
</div>
<table id="my-table" class="table display f-small">
    <thead>
    <tr>
        <th width="5%" class="text-center f-small f-semi-bold">#</th>
        <th width="15%" class="text-center f-semi-bold">Kategori</th>
        <th class="f-semi-bold">Nama Product</th>
        <th width="12%" class="text-right f-semi-bold">Total</th>
    </tr>
    </thead>
    <tbody>
        @foreach($data->keranjang as $v)
            <tr>
                <td class="text-center f-small middle-header">{{ $loop->index + 1 }}</td>
                <td class="f-small middle-header text-center">{{ $v->product->kategori->nama }}</td>
                <td class="f-small middle-header">{{ $v->product->nama }}</td>
                <td class="f-small middle-header text-right">
                    {{ number_format($v->total, 0, ',', '.') }}
                </td>
            </tr>
        @endforeach
    </tbody>

</table>
<hr/>
<div class="row" style="margin-bottom: 5px;">
    <div class="col-xs-9 f-small f-semi-bold" style="text-align: right">Sub Total :</div>
    <div class="col-xs-2 f-small" style="text-align: right">{{ number_format($data->sub_total, 0, ',', '.') }}</div>
</div>
<div class="row" style="margin-bottom: 5px;">
    <div class="col-xs-9 f-small f-semi-bold" style="text-align: right">DP :</div>
    <div class="col-xs-2 f-small" style="text-align: right">{{ number_format($data->dp, 0, ',', '.') }}</div>
</div>
<div class="row" style="margin-bottom: 5px;">
    <div class="col-xs-9 f-small f-semi-bold" style="text-align: right">Keterlambatan :</div>
    <div class="col-xs-2 f-small" style="text-align: right">{{ $keterlambatan }} hari</div>
</div>
<div class="row" style="margin-bottom: 5px;">
    <div class="col-xs-9 f-small f-semi-bold" style="text-align: right">Kekurangan :</div>
    <div class="col-xs-2 f-small" style="text-align: right">{{ number_format($data->kekurangan, 0, ',', '.') }}</div>
</div>
<div class="row" style="margin-bottom: 5px;">
    <div class="col-xs-9 f-small f-semi-bold" style="text-align: right">Total Denda :</div>
    <div class="col-xs-2 f-small" style="text-align: right">{{ number_format($total_denda, 0, ',', '.') }}</div>
</div>
<div class="row" style="margin-bottom: 5px;">
    <div class="col-xs-9 f-small f-semi-bold" style="text-align: right">Jumlah Yang Harus Di Bayar :</div>
    <div class="col-xs-2 f-small" style="text-align: right">{{ number_format(($total_denda + $data->kekurangan), 0, ',', '.') }}</div>
</div>
<div class="row">
    <div class="col-xs-7"></div>
    <div class="col-xs-4">
        <div class="text-right">
            {{--            <p class="text-right f-bold">Total Pendapatan : {{ number_format($data->sum('total'), 0, ',', '.') }}</p>--}}
        </div>
    </div>
</div>
</body>
</html>
