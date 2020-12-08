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
                            <div class="col-md-8">

                                <div class="form-group">
                                    <label for="namabarang">Nama Barang :</label>
                                    <form action="/barang/read" method="get">
                                        <?= csrf_field(); ?>
                                        <select class="custom-select" onchange="this.form.submit()" id="namabarang" name="namabarang">

                                            <?php foreach ($barang as $b) : ?>
                                                <option selected><?= $b['NamaBarang']; ?></option>
                                            <?php endforeach; ?>




                                        </select>
                                        <input type="datetime" name="tgl" id="tgl" value="<?php echo new Time('now'); ?>">
                                    </form>

                                </div>

                                <?php if (isset($_GET['namabarang'])) : ?>

                                    <form action="" method="post">
                                        <?php
                                        list($day, $month, $year, $hour, $min, $sec) = explode("/", date('d/m/Y/h/i/s'));
                                        $tgl = $month . $day . $year . $hour . $min;

                                        ?>
                                        <div class="form-group">

                                            <label for="kodetransaksi">Kode Transaksi</label>
                                            <input type="text" class="form-control" id="kodetransaksi" name="kodetransaksi" autocomplete="off" value="ASR<?= $tgl ?> " disabled>

                                        </div>
                                        <div class="form-group">

                                            <label for="kode">Kode</label>
                                            <input type="text" class="form-control" id="kode" name="kode" autocomplete="off" value="<?= (old('kode')) ? old('kode') : $brg['Kode'] ?>">

                                        </div>
                                        <div class="form-group">
                                            <label for="namabarang">Nama Barang</label>
                                            <input type="text" class="form-control" id="namabarang" name="namabarang" autocomplete="off" value="<?= (old('namabarang')) ? old('namabarang') : $brg['NamaBarang'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="satuan">Satuan </label>
                                            <input type="text" class="form-control" id="satuan" name="satuan" autocomplete="off" value="<?= (old('satuan')) ? old('satuan') : $brg['Satuan'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="jumlah">Jumlah</label>
                                            <input type="text" class="form-control <?= ($validation->hasError('jumlah')) ? 'is-invalid' : ''; ?>" id="jumlah" name="jumlah" autocomplete="off" value="<?= old('jumlah'); ?>">
                                            <div class="invalid-feedback" style="color:red;">
                                                <?= $validation->getError('jumlah'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="Harga">Harga</label>
                                            <input type="text" class="form-control" id="Harga" name="harga" autocomplete="off" value="<?= (old('harga')) ? old('harga') : $brg['Harga'] ?>">

                                            <input type="submit" class="btn btn-primary" value="Tambah Data">
                                        </div>
                                    <?php endif; ?>
                                    </form>
                                    <?php if ($Jumlah) : ?>
                                        <div class="row">
                                            <div class="col md-8">
                                                <div class="table-responsive">


                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Kode Transaksi</th>
                                                                <th scope="col">Kode</th>
                                                                <th scope="col">Nama Barang</th>
                                                                <th scope="col">Satuan</th>
                                                                <th scope="col">Jumlah</th>
                                                                <th scope="col">Harga</th>
                                                                <th scope="col">Total</th>
                                                            </tr>

                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>ASR<?= $tgl ?> </td>
                                                                <td><?= $Kode; ?></td>
                                                                <td><?= $NamaBarang; ?></td>
                                                                <td><?= $Satuan; ?></td>
                                                                <td><?= $Jumlah; ?></td>
                                                                <td><?= $Harga; ?></td>
                                                                <td><?= $Total; ?></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <form action="/barang/transaksi" method="post">
                                                    <?php
                                                    list($day, $month, $year, $hour, $min, $sec) = explode("/", date('d/m/Y/h/i/s'));
                                                    $tgl = $month . $day . $year . $hour . $min . $sec;

                                                    ?>
                                                    <div class="form-group">


                                                        <input type="hidden" class="form-control" id="kodetransaksi" name="kodetransaksi" autocomplete="off" value="ASR<?= $tgl ?> ">

                                                    </div>
                                                    <div class="form-group">


                                                        <input type="hidden" class="form-control" id="kode" name="kode" autocomplete="off" value="<?= (old('kode')) ? old('kode') : $brg['Kode'] ?>">

                                                    </div>
                                                    <div class="form-group">

                                                        <input type="hidden" class="form-control" id="namabarang" name="namabarang" autocomplete="off" value="<?= (old('namabarang')) ? old('namabarang') : $brg['NamaBarang'] ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="hidden" class="form-control" id="satuan" name="satuan" autocomplete="off" value="<?= (old('satuan')) ? old('satuan') : $Satuan ?>">

                                                    </div>
                                                    <div class="form-group">

                                                        <input type="hidden" class="form-control <?= ($validation->hasError('jumlah')) ? 'is-invalid' : ''; ?>" id="jumlah" name="jumlah" autocomplete="off" value="<?= $Jumlah ?>">

                                                    </div>
                                                    <div class="form-group">

                                                        <input type="hidden" class="form-control" id="Harga" name="harga" autocomplete="off" value="<?= (old('harga')) ? old('harga') : $Harga ?>">

                                                        <input type="submit" class="btn btn-primary" value="Tambah Barang Keluar">
                                                    </div>

                                                </form>

                                            </div>
                                        </div>
                                    <?php endif; ?>


                            </div>
                        </div>

                    </div>

                </div>
            </div>


        </div>
    </div>
</div>


<?= $this->endSection(); ?>