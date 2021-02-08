<?= $this->extend('pelamar/master/index') ?>
<?= $this->section('content') ?>
<!-- third party css -->
<link href="<?= base_url() ?>assets/libs/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url() ?>assets/libs/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url() ?>assets/libs/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url() ?>assets/libs/datatables/select.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<div class="card">
    <div class="card-body">
        <button type="button" class="btn btn-purple waves-effect waves-light mb-2" data-toggle="modal" data-target=".bs-example-modal-tambahlowongan"><i class="fa fa-plus"></i>
        </button>
        <?php

        use Myth\Auth\Collectors\Auth;

        $errors = session()->getFlashdata('failed');
        if (!empty($errors)) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong><i class="fas fa-times"></i> Failed</strong> data not added to database.
                <ul>
                    <?php foreach ($errors as $e) { ?>
                        <li><?= esc($e); ?></li>
                    <?php } ?>
                </ul>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
        <?php if (session()->getFlashData('success')) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong><i class="fas fa-check"></i> Success</strong> <?= session()->getFlashData('success'); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
        <div class="modal fade bs-example-modal-tambahlowongan" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myCenterModalLabel">Tambah Lowongan</h4>
                        <form action=" <?= base_url('/perusahaan/tambah/lowongan') ?>" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                            <?= csrf_token() ?>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="input-group row pb-2">
                            <label for="nama_lowongan" class="col-md-5">Nama Lowongan :</label>
                            <input type="text" name="nama_lowongan" id="nama_lowongan" class="form-control col-md-7" require placeholder="nama lowongan">
                        </div>
                        <div class="input-group row pb-2">
                            <label for="deskripsi_lowongan" class="col-md-5">Deskripsi Lowongan :</label>
                            <textarea name="deskripsi_lowongan" id="deskripsi_lowongan" cols="10" rows="5" style="width: 100%;" class="form-control col-md-7" require placeholder="deskripsi lowongan"></textarea>
                        </div>
                        <div class="input-group row pb-2">
                            <label for="kategori_lowongan" class="col-md-5">Kategori Lowongan :</label>
                            <select name="kategori_lowongan" id="kategori_lowongan" class="form-control">
                                <option value="teknologi">Teknologi</option>
                                <option value="kesehatan">Kesehatan</option>
                                <option value="pendidikan">Pendidikan</option>
                                <option value="teknik">Teknik</option>
                                <option value="administrasi">Administrasi</option>
                            </select>
                        </div>
                        <div class="input-group row pb-2">
                            <label for="kuota_lowongan" class="col-md-5">Kuota Lowongan :</label>
                            <input type="number" name="kuota_lowongan" id="kuota_lowongan" class="form-control" require placeholder="1">
                        </div>
                        <div class="input-group row pb-2">
                            <label for="status_lowongan" class="col-md-5">Status Lowongan :</label>
                            <select name="status_lowongan" id="status_lowongan" class="form-control">
                                <option value="tersedia">Tersedia</option>
                                <option value="tutup">Closed</option>
                            </select>
                        </div>
                        <div class="input-group row pb-2">
                            <label for="tanggal_lowongan" class="col-md-5">Tanggal Lowongan :</label>
                            <input type="date" name="tanggal_lowongan" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary float-right mt-2">Save lowongan</button>
                        </form>

                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <table id="datatable" class="table table-bordered dt-responsive nowrap text-center align middle" style="width: 100%;">
            <thead>
                <tr>
                    <th>Perusahaan</th>
                    <th>Name</th>
                    <th>Deskripsi</th>
                    <th>Kategori</th>
                    <th>Kuota/ Applied</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="text-center align middle">
                <?php foreach ($data_lowongans as $data_lowongan) { ?>
                    <tr>
                        <td><?= user()->username ?></td>
                        <td><?= $data_lowongan->name  ?></td>
                        <td><?= $data_lowongan->deskripsi  ?></td>
                        <td><?= $data_lowongan->kategori  ?></td>
                        <td><?= $data_lowongan->kuota ?> / <?= $data_lowongan->applier ?></td>
                        <td><?= $data_lowongan->status  ?></td>
                        <td><?= $data_lowongan->tanggal  ?></td>
                        <td>
                            <button type="button" class="btn btn-success waves-effect waves-light btn-sm" data-toggle="modal" data-target=".bs-example-modal-center<?= $data_lowongan->lowongan_id  ?>">Edit</button>
                            <div class="modal fade bs-example-modal-center<?= $data_lowongan->lowongan_id  ?>" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myCenterModalLabel">Edit Lowongan</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        </div>
                                        <form action="<?= base_url("perusahaan/update/lowongan/$data_lowongan->lowongan_id") ?>" method="post">
                                            <div class="modal-body">
                                                <div class="input-group row pb-2">
                                                    <label for="nama_lowongan" class="col-md-5">Nama Lowongan :</label>
                                                    <input type="text" name="nama_lowongan" id="nama_lowongan" class="form-control col-md-7" require placeholder="nama lowongan" value="<?= $data_lowongan->name ?>">
                                                </div>
                                                <div class="input-group row pb-2">
                                                    <label for="deskripsi_lowongan" class="col-md-5">Deskripsi Lowongan :</label>
                                                    <textarea name="deskripsi_lowongan" id="deskripsi_lowongan" cols="10" rows="5" style="width: 100%;" class="form-control col-md-7" require placeholder="deskripsi lowongan"><?= $data_lowongan->deskripsi  ?></textarea>
                                                </div>
                                                <div class="input-group row pb-2">
                                                    <label for="kategori_lowongan" class="col-md-5">Kategori Lowongan :</label>
                                                    <select name="kategori_lowongan" id="kategori_lowongan" class="form-control">
                                                        <option value="teknologi" <?= $data_lowongan->kategori == "teknologi" ? "selected" : '' ?>>Teknologi</option>
                                                        <option value="kesehatan" <?= $data_lowongan->kategori == "kesehatan" ? "selected" : '' ?>>Kesehatan</option>
                                                        <option value="pendidikan" <?= $data_lowongan->kategori == "pendidikan" ? "selected" : '' ?>>Pendidikan</option>
                                                        <option value="teknik" <?= $data_lowongan->kategori == "teknik" ? "selected" : '' ?>>Teknik</option>
                                                        <option value="administrasi" <?= $data_lowongan->kategori == "administrasi" ? "selected" : '' ?>>Administrasi</option>
                                                    </select>
                                                </div>
                                                <div class="input-group row pb-2">
                                                    <label for="kuota_lowongan" class="col-md-5">Kuota Lowongan :</label>
                                                    <input type="number" name="kuota_lowongan" id="kuota_lowongan" class="form-control" require placeholder="1" value="<?= $data_lowongan->kuota ?>">
                                                </div>
                                                <div class="input-group row pb-2">
                                                    <label for="status_lowongan" class="col-md-5">Status Lowongan :</label>
                                                    <select name="status_lowongan" id="status_lowongan" class="form-control">
                                                        <option value="tersedia" <?= $data_lowongan->status == "tersedia" ? "selected" : '' ?>>Tersedia</option>
                                                        <option value="tutup" <?= $data_lowongan->status == "tutup" ? "selected" : '' ?>>Closed</option>
                                                    </select>
                                                </div>
                                                <div class="input-group row pb-2">
                                                    <label for="tanggal_lowongan" class="col-md-5">Tanggal Lowongan :</label>
                                                    <input type="date" name="tanggal_lowongan" class="form-control" value="<?= $data_lowongan->tanggal ?>">
                                                </div>
                                                <button type="submit" class="btn btn-primary float-right mt-2 mb-2">Update lowongan</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
    </div>
</div>
</div>
<button type="button" class="btn btn-danger waves-effect waves-light btn-sm" data-toggle="modal" data-target=".bs-example-modal-center-delete<?= $data_lowongan->lowongan_id  ?>">Delete</button>
<div class="modal fade bs-example-modal-center-delete<?= $data_lowongan->lowongan_id  ?>" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myCenterModalLabel">Delete Lowongan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <span>Are you sure want delete ?</span>
            </div>
            <div class="modal-footer">
                <form action="<?= base_url("perusahaan/delete/lowongan/$data_lowongan->lowongan_id") ?>">
                    <button class="btn btn-primary btn-sm" data-dismiss="modal" aria-hidden="true">Cancle</button>
                    <button type="submit" class="btn btn-danger btn-sm">delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
<a href="<?= base_url("perusahaan/pelamar/$data_lowongan->lowongan_id") ?>" class="btn btn-primary waves-effect waves-light btn-sm">Pelamar</a>
<!-- <button type="button" class="btn btn-primary waves-effect waves-light btn-sm" data-toggle="modal" data-target=".bs-example-modal-center-delete<?= $data_lowongan->lowongan_id  ?>">View Pelamar</button> -->
</td>

</tr>
<?php } ?>
</tbody>
</table>
</div>
</div>
<!-- datatable js -->
<script src=" <?= base_url() ?>assets/libs/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/libs/datatables/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>assets/libs/datatables/dataTables.responsive.min.js"></script>
<script src="<?= base_url() ?>assets/libs/datatables/responsive.bootstrap4.min.js"></script>

<script src="<?= base_url() ?>assets/libs/datatables/dataTables.buttons.min.js"></script>
<script src="<?= base_url() ?>assets/libs/datatables/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>assets/libs/datatables/buttons.html5.min.js"></script>
<script src="<?= base_url() ?>assets/libs/datatables/buttons.flash.min.js"></script>
<script src="<?= base_url() ?>assets/libs/datatables/buttons.print.min.js"></script>

<script src="<?= base_url() ?>assets/libs/datatables/dataTables.keyTable.min.js"></script>
<script src="<?= base_url() ?>assets/libs/datatables/dataTables.select.min.js"></script>

<!-- Datatables init -->
<script src="<?= base_url() ?>assets/js/pages/datatables.init.js"></script>
<?= $this->endSection() ?>