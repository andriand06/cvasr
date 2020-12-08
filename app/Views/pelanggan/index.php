<?= $this->extend('layout/wrapper'); ?>
<?= $this->section('content'); ?>

<div class="wrapper">
    <div class="content-wrapper">
        <div class="container mt-3">
            <h1><?= $judul; ?></h1>

            <div class="row">
                <div class="col-md-4">
                    <form action="<?= base_url('pelanggan'); ?>" method="post">
                        <div class="input-group">
                            <input type="text" class="form-control" name="keyword" placeholder="Cari Nama Barang" aria-label="Recipient's username" aria-describedby="basic-addon2" autocomplete="off" autofocus>
                            <div class="input-group-btn">
                                <button class="btn btn-flat" type="submit" name="submit"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="container mt-3">
                    <div class="alert alert-success" data-flashdata="<?= session()->getFlashdata('pesan'); ?>">
                        <?php echo session()->getFlashdata('pesan'); ?>
                    </div>
                </div>


            <?php endif; ?>
            <?php if (empty($isi)) : ?>
                <p style="color:red;" class="container mr-3">Maaf,Data tidak ditemukan.</p>
            <?php endif; ?>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">Nama Pelanggan</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">No Telp</th>

                        <th scope="col">Aksi</th>

                    </tr>

                </thead>
                <tbody>
                    <?php foreach ($isi as $b) : ?>
                        <tr>
                            <td><input type="hidden" value=" <?= $b['id']; ?>"></td>
                            <td><?= $b['namapelanggan']; ?></td>
                            <td><?= $b['alamat']; ?></td>
                            <td><?= $b['notelp']; ?></td>

                            <td>

                                <a href="/pelanggan/edit/<?= $b['id']; ?>" class="btn btn-warning">Edit</a>
                                <form action="/pelanggan/<?= $b['id']; ?>" method="post" style="display : inline;">
                                    <?= csrf_field(); ?>
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('apakah anda yakin menghapus data ini?');">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="container">
            <a href="<?= base_url('pelanggan/tambah'); ?>" class="btn btn-primary">Tambah Data Pelanggan</a>
            <?= $pager->links(); ?>
        </div>

    </div>
</div>


<?= $this->endSection(); ?>