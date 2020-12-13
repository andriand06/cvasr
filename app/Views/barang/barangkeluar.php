<?= $this->extend('layout/wrapper'); ?>
<?= $this->section('content'); ?>
<h1></h1>
<div class="wrapper">
    <div class="content-wrapper">

        <div class="container">
            <h1><?= $judul; ?></h1>
            <div class="row">
                <div class="col md-8">

                    <?php

                    use CodeIgniter\I18n\Time;

                    if (session()->getFlashdata('error')) : ?>
                        <div class="container mt-3">
                            <div class="alert alert-danger" data-flashdata="<?= session()->getFlashdata('error'); ?>">
                                <?php echo session()->getFlashdata('error'); ?>
                            </div>
                        </div>
                    <?php endif;  ?>
                    <?php if (session()->getFlashdata('pesan')) : ?>
                        <div class="container mt-3">
                            <div class="alert alert-success" data-flashdata="<?= session()->getFlashdata('pesan'); ?>">
                                <?php echo session()->getFlashdata('pesan'); ?>
                            </div>
                        </div>
                    <?php endif;  ?>
                    <div class="container">
                        <div class="row">
                            <div class='col-md-8'>
                                <label for="tgl">Tanggal</label>
                                <input type="datetime" name="tanggal" id="tgl" value="<?php echo new Time('now'); ?>">
                                <h5 class='judul-transaksi' id="judultransaksi">
                                    <i class='fa fa-shopping-cart fa-fw'></i> Transaksi <i class='fa fa-angle-right fa-fw'></i> Barang Keluar
                                </h5>

                                <div class="row">
                                    <div class="col-md-4">
                                        <a href="/barang/resetbarang" class="btn btn-warning" id="reset">Reset Keranjang</a>
                                        <form action="" method="post" class="form-inline">

                                            <div class="input-group" id="barang">


                                                <label for="namabarang">Nama Barang</label>
                                                <select name="namabarang" id="namabarang" class="form-control">
                                                    <option value="">Pilih Barang</option>
                                                    <?php foreach ($barang as $b) : ?>
                                                        <option value="<?= $b['NamaBarang']; ?> "><?= $b['NamaBarang']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="input-group" id="button">
                                                <input type="number" name="jumlah" id="jumlah" class="form-control" placeholder="Jumlah" autocomplete="off">
                                                <input type="submit" value="Tambah" class="btn btn-primary">

                                            </div>
                                        </form>
                                    </div>

                                </div>

                            </div>

                            <form action="/barang/transaksi" method="post">
                                <table class='table table-bordered' id='TabelTransaksi'>
                                    <thead>
                                        <tr>

                                            <th style='width:75px;'>Kode </th>
                                            <th>Nama Barang</th>
                                            <th style='width:100px;'>Satuan</th>
                                            <th style='width:75px;'>Jumlah</th>
                                            <th style='width:100px;'>Harga</th>
                                            <th style='width:100px;'>Sub Total</th>
                                            <th id="aksi"></th>


                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (isset($_POST['namabarang'])) : ?>

                                            <?php foreach ($isi as $i) :  ?>
                                                <tr>
                                                    <td><input type="text" name="kode[]" class="form-control" value="<?= $i['kode']
                                                                                                                        ?>">
                                                    </td>
                                                    <td><input type="text" name="namabarang[]" class="form-control" value="<?= $i['namabarang']
                                                                                                                            ?>" style="width: 140px;"></td>
                                                    <td><input type="text" name="satuan[]" class="form-control" value="<?= $i['satuan']
                                                                                                                        ?>" style="width: 50px;"></td>
                                                    <td><input type="number" name="jumlah[]" class="form-control" value="<?= $i['jumlah']
                                                                                                                            ?>" style="width: 55px;"></td>
                                                    <td><input type="text" name="harga[]" class="form-control" value="<?= $i['harga']
                                                                                                                        ?>" style="width: 70px;"></td>
                                                    <td><input type="text" name="subtotal[]" class="form-control" value="<?= $i['jumlah'] * $i['harga']
                                                                                                                            ?>" style="width: 85px;"></td>

                                                </tr>
                                            <?php endforeach; ?>

                                        <?php endif; ?>

                                </table>
                                <input type="submit" value="Tambah Barang Keluar" id="button" class="btn btn-primary">
                            </form>
                            <a href="" onclick="window.print()" id="cetak" class="btn btn-warning">Cetak</a>

                        </div>

                    </div>

                </div>
            </div>


        </div>
    </div>
</div>


<?= $this->endSection(); ?>