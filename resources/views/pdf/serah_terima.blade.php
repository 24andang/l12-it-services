<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan PDF</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 14px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            border: 1px solid #555;
            padding: 8px;
            text-align: left;
        }

        b {
            text-align: right;
        }

        .footer {
            margin-top: 40px;
            text-align: right;
            font-style: italic;
        }
    </style>
</head>

<body>
    <table>
        <tr>
            <td>
                <img src="images/logo-dfa.png" alt="logo-dfa" style="width: 42%;">
            </td>
            <td style="width: 20%;">
                <b>No. {{\Carbon\Carbon::parse($outcoming_date)->format('my')}}{{ sprintf('%02d', $id) }}</b>
            </td>
        </tr>
    </table>
    <h1>Serah Terima</h1>

    <p>
        Dengan ini, pada tanggal <em>{{\Carbon\Carbon::parse($outcoming_date)->format('d/m/Y')}}</em> departemen IT telah melakukan proses serah terima dan edukasi penggunaan perangkat di bawah ini, dan telah dimengerti dengan baik oleh penerima.
    </p>

    <table class="table">
        <tr>
            <td>Kode</td>
            <th>{{$code}}</th>
        </tr>
        <tr>
            <td>Item</td>
            <th>{{$name}}</th>
        </tr>
        <tr>
            <td>Qty</td>
            <th>{{$qty}}</th>
        </tr>
        <tr>
            <td>Ket</td>
            <th>{{$info}}</th>
        </tr>
    </table>

    <table style="width:100%; text-align:center; margin-top:50px;">
        <tr>
            <td style="width:50%;">
                <p>Diterima oleh:</p>
                <br><br><br>
                <p>{{ $recipient }}</p>
            </td>
            <td style="width:50%;">
                <p>Diserahkan oleh:</p>
                <br><br><br>
                <p>{{ $pic }}</p>
            </td>
        </tr>
    </table>

    <div class="footer">
        Dicetak pada: {{ now()->format('d/m/Y H:i') }}
    </div>
</body>

</html>