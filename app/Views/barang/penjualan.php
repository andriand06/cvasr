<?= $this->extend('layout/wrapper'); ?>
<?= $this->section('content'); ?>
<?php

use CodeIgniter\I18n\Time;
?>
<div class="wrapper">
    <div class="content-wrapper">

        <div class="container-fluid">
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

                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="panel panel-primary">
                        <h5 class="panel-heading"><i class='fa fa-file-text-o fa-fw'></i>Informasi Nota</h5>
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
                                        <input type="text" id="tanggak" name="tanggal" value="<?= new Time('now') ?>" disabled>
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
                </div>
            </div>
            <div class="row">
                <div class="col md-8">
                    <div class="table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Ko</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


<?= $this->endSection(); ?>