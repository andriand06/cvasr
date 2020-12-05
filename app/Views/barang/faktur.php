<?= $this->extend('layout/wrapper'); ?>
<?= $this->section('content'); ?>
<h1></h1>
<div class="wrapper">
    <div class="content-wrapper">

        <div class="container">
            <h1><?= $judul; ?></h1>
            <div class="row">
                <div class="col md-8">

                    <?php if (session()->getFlashdata('pesan')) : ?>
                        <div class="container mt-3">
                            <div class="alert alert-success" data-flashdata="<?= session()->getFlashdata('pesan'); ?>">
                                <?php echo session()->getFlashdata('pesan'); ?>
                            </div>
                        </div>
                    <?php endif;  ?>

                </div>
            </div>
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
        </div>
    </div>
</div>


<?= $this->endSection(); ?>