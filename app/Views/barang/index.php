<?= $this->extend('layout/wrapper'); ?>
<?= $this->section('content'); ?>

<div class="wrapper">
    <div class="content-wrapper">
        <?php if (session()->getFlashdata('pesan')) : ?>
            <div class="container mt-3">
                <div class="alert alert-success" data-flashdata="<?= session()->getFlashdata('pesan'); ?>">
                    <?php echo session()->getFlashdata('pesan'); ?>
                </div>
            </div>

        <?php endif; ?>
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