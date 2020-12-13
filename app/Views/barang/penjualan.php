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

                            <?php if (session()->getFlashdata('pesan')) : ?>


                                <div class="alert alert-success" data-flashdata="<?= session()->getFlashdata('pesan'); ?>">
                                    <?php echo session()->getFlashdata('pesan'); ?>
                                </div>

                            <?php endif;  ?>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="panel panel-primary">
                                <h5 class="panel-heading" id="nota"><i class='fa fa-file-text-o fa-fw'></i>Informasi Nota</h5>
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
                                <h5 class="panel-heading" id="pelanggan"><i class='fa fa-file-text-o fa-fw'></i>Informasi Pelanggan</h5>
                                <div class="panel-body">
                                    <div class="form-horizontal">
                                        <div class="form-group">
                                            <label for="namapelanggan" id="labelpelanggan" class="col-sm-4 control-label">Pelanggan</label>
                                            <div class="col-sm-8">

                                                <form action="" method="get">
                                                    <?= csrf_field(); ?>
                                                    <select name="namapelanggan" id="listpelanggan" class="custom-select" onchange="this.form.submit()">
                                                        <option value=""> Pilih Pelanggan</option>
                                                        <?php foreach ($pelanggan as $p) : ?>

                                                            <option><?= $p['namapelanggan']; ?></option>
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
                            <h5 class='judul-transaksi' id="judultransaksi">
                                <i class='fa fa-shopping-cart fa-fw'></i> Penjualan <i class='fa fa-angle-right fa-fw'></i> Transaksi
                            </h5>

                            <div class="row">
                                <div class="col-sm-8">
                                    <a href="/barang/reset" class="btn btn-warning" id="reset">Reset Keranjang</a>
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



                            <form action="/barang/perbarui" method="post">
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
                                                    <td><?= $i['kode'] //($i['kode']) ? $i['kode'] : old('kode'); 
                                                        ?></td>
                                                    <td><?= $i['namabarang'] //($i['namabarang']) ? $i['namabarang'] : old('namabarang'); 
                                                        ?></td>
                                                    <td><?= $i['satuan'] //($i['satuan']) ? $i['satuan'] : old('satuan'); 
                                                        ?> </td>
                                                    <td>
                                                        <!--<input type="text" name="jumlah" id="jumlah" value="--><?= $i['jumlah'] //($i['jumlah']) ? $i['jumlah'] : old('jumlah'); 
                                                                                                                    ?>
                                                        <!--" style="width:25px;">-->
                                                    </td>
                                                    <td><?= $i['harga'] //($i['harga']) ? $i['harga'] : old('harga'); 
                                                        ?></td>
                                                    <td><?= $i['jumlah'] * $i['harga']; ?></td>
                                                    <td id="aksi"><a href="/barang/hapustransaksi/?kode=<?= $i['kode']; ?>" onclick="confirm('apakah anda yakin ingin menghapus data barang ini');" class="btn btn-danger" id="hapus"><i class="glyphicon glyphicon-remove"></i></a> </td>
                                                </tr>
                                            <?php endforeach; ?>

                                        <?php endif; ?>

                                </table>
                                <?php
                                $totalbayar = 0;
                                if (isset($_SESSION['isi'])) {
                                    foreach ($_SESSION['isi'] as $key => $value) {
                                        $totalbayar += $value['harga'] * $value['jumlah'];
                                    }
                                }
                                ?>
                                <div class='alert alert-info TotalBayar'>

                                    <h2>Total : <span id='TotalBayar'>Rp <?php echo number_format($totalbayar); ?> </span></h2>
                                    <input type="hidden" id='TotalBayarHidden'>
                                </div>
                                <!--
                                <div class="form-group" id="perbarui">

                                    <input type="submit" class="btn btn-primary" value="Perbarui">
                                </div>
                                            -->
                            </form>
                            <a href="" onclick="window.print()" class="btn btn-warning" id="cetak">Cetak</a>



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