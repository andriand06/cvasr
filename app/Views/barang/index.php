<?= $this->extend('layout/wrapper'); ?>
<?= $this->section('content'); ?>

<div class="wrapper">
    <div class="content-wrapper">
        <div class="container mt-3">
            <h1><?= $judul; ?></h1>

            <div class="row">
                <div class="col-md-4">
                    <form action="<?= base_url('barang'); ?>" method="post">
                        <div class="input-group">
                            <input type="text" class="form-control" name="keyword" placeholder="Cari Nama Barang" aria-label="Recipient's username" aria-describedby="basic-addon2" autocomplete="off" autofocus>
                            <div class="input-group-btn">
                                <button class="btn btn-flat" type="submit" name="submit"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <?php if (empty($isi)) : ?>
                <p style="color:red;" class="container mr-3">Maaf,Data tidak ditemukan.</p>
            <?php endif; ?>
            <?php if (session()->getFlashdata('pesan')) : ?>


                <div class="alert alert-success" data-flashdata="<?= session()->getFlashdata('pesan'); ?>">
                    <?php echo session()->getFlashdata('pesan'); ?>
                </div>


            <?php endif; ?>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">Kode</th>
                        <th scope="col">Nama Barang</th>
                        <th scope="col">Satuan</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Aksi</th>

                    </tr>

                </thead>
                <tbody>
                    <?php foreach ($isi as $b) : ?>
                        <tr>
                            <td><input type="hidden" value=" <?= $b['id']; ?>"></td>
                            <td><?= $b['Kode']; ?></td>
                            <td><?= $b['NamaBarang']; ?></td>
                            <td><?= $b['Satuan']; ?></td>
                            <td><?= $b['Jumlah']; ?></td>
                            <td><?= $b['Harga']; ?></td>
                            <td>

                                <a href="/barang/edit/<?= $b['id']; ?>" class="btn btn-warning">Edit</a>
                                <form action="/barang/<?= $b['id']; ?>" method="post" style="display : inline;">
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
            <a href="<?= base_url('barang/tambah'); ?>" class="btn btn-primary">Tambah Data Barang</a>
        </div>
    </div>
</div>


<?= $this->endSection(); ?>