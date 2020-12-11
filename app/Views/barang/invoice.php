<html>

<head>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #000000;
            text-align: center;
            height: 20px;
            margin: 8px;
        }
    </style>
</head>

<body>
    <div style="font-size:64px; color:'#dddddd'"><i>Invoice</i></div>
    <p>
        <i>CV.Anugerah Sinar Rezeki</i><br>
        Jambi, Indonesia
    </p>
    <hr>
    <hr>
    <p></p>
    <p>
        Pelanggan: <?= $pembeli->username ?><br>
        Alamat : <?= $model->alamat ?><br>
        No.Hp :
        Transaksi No : <?= $model->id ?><br>
        Tanggal : <?= date('Y-m-d', strtotime($model->created_date)) ?><br>
    </p>
    <table cellpadding="6">
        <tr>
            <th><strong>Barang</strong></th>
            <th><strong>Harga Satuan</strong></th>
            <th><strong>Jumlah</strong></th>
            <th><strong>Ongkir</strong></th>
            <th><strong>Total Harga</strong></th>
        </tr>
        <tr>
            <td><?= $barang->nama ?></td>
            <td><?= "Rp " . number_format($barang->harga, 2, ',', '.')  ?></td>
            <td><?= $model->jumlah ?></td>
            <td><?= $model->ongkir ?></td>
            <td><?= "Rp " . number_format($model->total_harga, 2, ',', '.')  ?></td>
        </tr>
    </table>
</body>

</html>