<?= $this->extend('layout/wrapper'); ?>
<?= $this->section('content'); ?>
<div class="wrapper">
    <div class="content-wrapper">
        <div class="card" style="width: 18rem;">
            <img class="card-img-top" src="..." alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title"></h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>

        <a href="/barang" class="btn btn-primary">Kembali</a>
    </div>
</div>

<?= $this->endSection(); ?>