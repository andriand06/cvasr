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
                            <form action="save" method="post" novalidate>
                                <?= csrf_field(); ?>
                                <?php if (session()->getFlashdata('pesan')) : ?>
                                    <div class="container mt-3">
                                        <div class="alert alert-success" data-flashdata="<?= session()->getFlashdata('pesan'); ?>">
                                            <?php echo session()->getFlashdata('pesan'); ?>
                                        </div>
                                    </div>
                                <?php endif;  ?>
                                <div class="form-group">
                                    <label for="namapelanggan">Nama Pelanggan</label>
                                    <input type="text" class="form-control <?= ($validation->hasError('namapelanggan')) ? 'is-invalid' : ''; ?>" id="namapelanggan" name="namapelanggan" autocomplete="off" value="<?= old('namapelanggan'); ?>">
                                    <div class="invalid-feedback" style="color:red;">
                                        <?= $validation->getError('namapelanggan'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <input type="text" class="form-control <?= ($validation->hasError('alamat')) ? 'is-invalid' : ''; ?>" id="alamat" name="alamat" autocomplete="off" value="<?= old('alamat'); ?>">
                                    <div class="invalid-feedback" style="color:red;">
                                        <?= $validation->getError('alamat'); ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="notelp">No Telp</label>
                                    <input type="text" class="form-control <?= ($validation->hasError('notelp')) ? 'is-invalid' : ''; ?>" id="notelp" name="notelp" autocomplete="off" value="<?= old('notelp'); ?>">
                                    <div class="invalid-feedback" style="color:red;">
                                        <?= $validation->getError('notelp'); ?>
                                    </div>
                                </div>

                                <input type="submit" class="btn btn-primary" value="Tambah Data Pelanggan">
                                <a href="/pelanggan/index" class="btn btn-primary">Kembali</a>

                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>