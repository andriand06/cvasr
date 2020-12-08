<?= $this->extend('layout/wrapper'); ?>
<?= $this->section('content'); ?>
<?php

use CodeIgniter\I18n\Time;
?>
<div class="wrapper">
    <div class="content-wrapper">

        <div class="container-fluid">
            <div class="panel-parameter">
                <div class="panel-body">


                    <h1><?= $judul; ?></h1>
                    <div class="row">
                        <div class="col-md-12">

                            <?php if (session()->getFlashdata('error')) : ?>


                                <div class="alert alert-danger" data-flashdata="<?= session()->getFlashdata('error'); ?>">
                                    <?php echo session()->getFlashdata('error'); ?>
                                </div>

                            <?php endif;  ?>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="panel panel-primary">
                                <h5 class="panel-heading"><i class='fa fa-file-text-o fa-fw'></i>Informasi Nota</h5>
                                <div class="panel-body">
                                    <div class="form-horizontal">
                                        <div class="form-group">
                                            <label for="nonota" class="col-sm-4 control-label">No.Nota</label>
                                            <div class="col-sm-8">
                                                <input type="text" id="nonota" name="nonota" value="ASR<?php echo strtoupper(uniqid()) ?>" disabled>
                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <label for="tanggal" class="col-sm-4 control-label">Tanggal</label>
                                            <div class="col-sm-8">
                                                <input type="text" id="tanggal" name="tanggal" value="<?= new Time('now', 'Asia/Jakarta') ?>" disabled>
                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <label for="kasir" class="col-sm-4 control-label">Kasir</label>
                                            <div class="col-sm-8">
                                                <input type="text" id="kasir" name="kasir" value="<?= $username; ?>" disabled>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="panel panel-primary">
                                <h5 class="panel-heading"><i class='fa fa-file-text-o fa-fw'></i>Informasi Pelanggan</h5>
                                <div class="panel-body">
                                    <div class="form-horizontal">
                                        <div class="form-group">
                                            <label for="namapelanggan" class="col-sm-4 control-label">Pelanggan</label>
                                            <div class="col-sm-8">

                                                <form action="" method="get">
                                                    <?= csrf_field(); ?>
                                                    <select name="namapelanggan" id="namapelanggan" class="custom-select" onchange="this.form.submit()">
                                                        <option> Pilih Pelanggan</option>
                                                        <?php foreach ($pelanggan as $p) : ?>
                                                            <?php
                                                            $selected = '';
                                                            if ($p['namapelanggan']) {
                                                                $selected = 'selected';
                                                            }
                                                            ?>
                                                            <option selected><?= $p['namapelanggan']; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </form>
                                            </div>
                                        </div>
                                        <?php
                                        if (isset($_GET['namapelanggan'])) : ?>

                                            <div class="form-group">
                                                <label for="namapelanggan" class="col-sm-4 control-label">Nama Pelanggan </label>
                                                <div class="col-sm-8">
                                                    <input type="text" id="namapelanggan" name="namapelanggan" value="<?= $query['namapelanggan']; ?>" disabled>
                                                </div>

                                            </div>

                                            <div class="form-group">
                                                <label for="nonota" class="col-sm-4 control-label">No Telp</label>
                                                <div class="col-sm-8">
                                                    <input type="text" id="notelp" name="notelp" value="<?= $query['notelp']; ?>" disabled>
                                                </div>

                                            </div>
                                            <div class="form-group">
                                                <label for="alamat" class="col-sm-4 control-label">Alamat</label>
                                                <div class="col-sm-8">
                                                    <input type="text" id="alamat" name="alamat" value="<?= $query['alamat']; ?>" disabled>
                                                </div>

                                            </div>
                                        <?php endif; ?>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class='col-sm-8'>
                            <h5 class='judul-transaksi'>
                                <i class='fa fa-shopping-cart fa-fw'></i> Penjualan <i class='fa fa-angle-right fa-fw'></i> Transaksi
                            </h5>

                            <div class="row">
                                <div class="col-sm-8">
                                    <form action="" method="post">
                                        <div class="form-group">
                                            <label for="namabarang">Nama Barang</label>
                                            <a href="/barang/reset" class="btn btn-warning">Reset Keranjang</a>
                                            <select name="namabarang" id="namabarang" class="form-control">
                                                <option value="">Pilih Barang</option>
                                                <?php foreach ($barang as $b) : ?>
                                                    <option value="<?= $b['NamaBarang']; ?> "><?= $b['NamaBarang']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <input type="submit" value="Tambah" class="btn btn-primary" style="display :block">
                                        </div>
                                    </form>
                                </div>

                            </div>




                            <table class='table table-bordered' id='TabelTransaksi'>
                                <thead>
                                    <tr>

                                        <th style='width:75px;'>Kode </th>
                                        <th>Nama Barang</th>
                                        <th style='width:100px;'>Satuan</th>
                                        <th style='width:75px;'>Jumlah</th>
                                        <th style='width:100px;'>Harga</th>
                                        <th style='width:100px;'>Sub Total</th>


                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (isset($_POST['namabarang'])) : ?>

                                        <?php foreach ($_SESSION['isi'] as $i) : ?>
                                            <tr>
                                                <td><input type="text" value="<?= $i['kode']; ?>" style='width:45px;'></td>
                                                <td><input type="text" value="<?= $i['namabarang']; ?>" style='width:65px;'></td>
                                                <td><input type="text" value="<?= $i['satuan']; ?>" style='width:35px;'></td>
                                                <td><input type="text" name="jumlah" id="jumlah" value="" style='width:35px;'></td>
                                                <td><input type="text" name="harga" id="harga" value="<?= $i['harga']; ?>"></td>
                                                <td><input type="text" value="<?= $subtotal ?>"></td>
                                            </tr>
                                        <?php endforeach; ?>

                                    <?php endif; ?>
                                    <?php if (!isset($_POST['namabarang'])) : ?>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td> </td>
                                            <td>Data tidak tersedia</td>
                                        </tr>
                                    <?php endif; ?>

                            </table>

                            <div class='alert alert-info TotalBayar'>

                                <h2>Total : <span id='TotalBayar'>Rp. 0</span></h2>
                                <input type="hidden" id='TotalBayarHidden'>
                            </div>

                            <div class="form-group">
                                <a href="" class="btn btn-warning">Cetak</a>
                            </div>




                        </div>

                    </div>



                </div>
            </div>

        </div>
    </div>
</div>
</div>
</div>


<?= $this->endSection(); ?>