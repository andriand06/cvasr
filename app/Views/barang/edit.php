<?= $this->extend('layout/wrapper'); ?>
<?= $this->section('content'); ?>
<div class="wrapper">
    <div class="content-wrapper">
        <div class="container mt-3">
            <div class="card">
                <h5 class="card-header">
                    <span class="logo-lg"><b><?= $judul; ?></b></span>

                </h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">

                            <form action="/barang/update/<?= $isi['id']; ?>" method="post" novalidate>
                                <?= csrf_field(); ?>
                                <?php
                                if (session()->getFlashdata('pesan')) : ?>
                                    <div class="container mt-3">
                                        <div class="alert alert-success" data-flashdata="<?= session()->getFlashdata('pesan'); ?>">
                                            <?php echo session()->getFlashdata('pesan'); ?>
                                        </div>
                                    </div>

                                <?php endif;  ?>

                                <div class="form-group">
                                    <label for="kode">Kode</label>
                                    <input type="text" class="form-control <?= ($validation->hasError('kode')) ? 'is-invalid' : ''; ?>" id="kode" name="kode" autocomplete="off" value="<?= (old('kode')) ? old('kode') : $isi['Kode'] ?>">
                                    <div class="invalid-feedback" style="color:red;">
                                        <?= $validation->getError('kode'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="namabarang">Nama Barang</label>
                                    <input type="text" class="form-control <?= ($validation->hasError('namabarang')) ? 'is-invalid' : ''; ?>" id="namabarang" name="namabarang" autocomplete="off" value="<?= (old('namabarang')) ? old('namabarang') : $isi['NamaBarang'] ?>">
                                    <div class="invalid-feedback" style="color:red;">
                                        <?= $validation->getError('namabarang'); ?>
                                    </div>
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
                                    <input type="text" class="form-control <?= ($validation->hasError('jumlah')) ? 'is-invalid' : ''; ?>" id="jumlah" name="jumlah" autocomplete="off" value="<?= (old('jumlah')) ? old('jumlah') : $isi['Jumlah'] ?>">
                                    <div class="invalid-feedback" style="color:red;">
                                        <?= $validation->getError('jumlah'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Harga">Harga</label>
                                    <input type="text" class="form-control <?= ($validation->hasError('harga')) ? 'is-invalid' : ''; ?>" id="Harga" name="harga" autocomplete="off" value="<?= (old('harga')) ? old('harga') : $isi['Harga'] ?>">
                                    <div class="invalid-feedback" style="color:red;">
                                        <?= $validation->getError('harga'); ?>
                                    </div>
                                </div>
                                <input type="submit" class="btn btn-primary" value="Ubah Data">
                                <a href="/barang" class="btn btn-primary">Kembali</a>

                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>