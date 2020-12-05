<?= $this->extend('layout/wrapper'); ?>
<?= $this->section('content'); ?>
<h1></h1>
<div class="wrapper">
    <div class="content-wrapper">

        <div class="container">
            <h1><?= $judul; ?></h1>
            <div class="row">
                <div class="col md-8">

                    <?php if (session()->getFlashdata('error')) : ?>
                        <div class="container mt-3">
                            <div class="alert alert-danger" data-flashdata="<?= session()->getFlashdata('error'); ?>">
                                <?php echo session()->getFlashdata('error'); ?>
                            </div>
                        </div>
                    <?php endif;  ?>

                    <div class="container">
                        <div class="row">
                            <div class="col-md-8">

                                <div class="form-group">
                                    <label for="namabarang">Nama Barang :</label>
                                    <form action="/barang/read" method="post">
                                        <?= csrf_field(); ?>
                                        <select class="custom-select" onchange="this.form.submit()" id="namabarang" name="namabarang">

                                            <?php if ($selected) : ?>

                                                <option value="<?= $barang['NamaBarang']; ?>" selected><?= $barang['NamaBarang']; ?></option>


                                            <?php endif; ?>
                                            <?php if ($selected == '') : ?>
                                                <?php foreach ($barang as $b) : ?>
                                                    <option><?= $b['NamaBarang']; ?></option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>



                                        </select>
                                    </form>
                                    <input type="submit" class="btn btn-primary" value="Ambil Data">
                                </div>


                                <?php if ($selected) : ?>
                                    <form action="/barang/transaksi" method="post">
                                        <div class="form-group">

                                            <label for="kode">Kode</label>
                                            <input type="text" class="form-control" id="kode" name="kode" autocomplete="off" value="<?= (old('kode')) ? old('kode') : $barang['Kode'] ?>">

                                        </div>
                                        <div class="form-group">
                                            <label for="namabarang">Nama Barang</label>
                                            <input type="text" class="form-control" id="namabarang" name="namabarang" autocomplete="off" value="<?= (old('namabarang')) ? old('namabarang') : $barang['NamaBarang'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="satuan">Satuan </label>
                                            <select class="form-control" id="satuan" name="satuan">
                                                <option>Ball</option>
                                                <option>Dus</option>
                                                <option>Pcs</option>
                                            </select>
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
                                            <input type="text" class="form-control" id="Harga" name="harga" autocomplete="off" value="<?= (old('harga')) ? old('harga') : $barang['Harga'] ?>">

                                            <input type="submit" class="btn btn-primary" value="Tambah Data">
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($Jumlah) : ?>
                                        <div class="row">
                                            <div class="col md-8">
                                                <div class="table-responsive">


                                                    <table class="table">
                                                        <thead>
                                                            <tr>
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
                                                <a href="/barang/penjualan" class="btn btn-primary">Tambah Barang</a>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    </form>
                            </div>
                        </div>

                    </div>

                </div>
            </div>


        </div>
    </div>
</div>


<?= $this->endSection(); ?>