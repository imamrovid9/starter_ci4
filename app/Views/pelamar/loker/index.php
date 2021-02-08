<?= $this->extend('pelamar/master/index') ?>
<?= $this->section('content') ?>
<!-- third party css -->
<link href="<?= base_url() ?>assets/libs/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url() ?>assets/libs/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url() ?>assets/libs/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url() ?>assets/libs/datatables/select.bootstrap4.min.css" rel="stylesheet" type="text/css" />

<div class="card">
    <div class="card-body">
        <?php
        $errors = session()->getFlashdata('failed');
        if (!empty($errors)) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong><i class="fas fa-times"></i> Failed</strong> Anda Sudah Melamar.
                <!--  -->
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
        <table id="datatable" class="table table-bordered dt-responsive nowrap text-center align middle" style="width: 100%;">
            <thead>
                <tr>
                    <th>Perusahaan</th>
                    <th>Lowongan</th>
                    <th>Deskripsi</th>
                    <th>Kategori</th>
                    <th>Kuota/ Applied</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="text-center align middle">
                <?php if (is_array($lowongans) || is_object($lowongans)) { ?>
                    <?php foreach ($lowongans as $lowongan) { ?>
                        <tr>
                            <td><a href="<?= base_url('pelamar/detail/perusahaan/' .  $lowongan->username); ?>"><?= $lowongan->username ?></a></td>
                            <td><?= $lowongan->name ?></td>
                            <td><?= $lowongan->deskripsi ?></td>
                            <td><?= $lowongan->kategori ?></td>
                            <td><?= $lowongan->kuota ?> / <?= $lowongan->applier ?></td>
                            <td><?= $lowongan->status ?></td>
                            <td><?= $lowongan->tanggal ?></td>
                            <td>
                                <?php if ($lowongan->status == "tutup") { ?>
                                    <span class="badge badge-pill badge-danger">Loker Tidak Tersedia</span>
                                <?php } else { ?>
                                    <button type="button" class="btn btn-sm btn-purple waves-effect waves-light" data-toggle="modal" data-target=".bs-example-modal-center-asda<?= $lowongan->lowongan_id ?>">Lamar</button>
                                    <div class="modal fade bs-example-modal-center-asda<?= $lowongan->lowongan_id ?>" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="myCenterModalLabel">Lamar</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="<?= base_url('pelamar/lamar/' .  $lowongan->lowongan_id); ?>" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                                                        <?= csrf_field(); ?>
                                                        <div class="text-center align-middle">
                                                            <button type="submit" class="btn btn-primary">Lamar</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->
                                <?php } ?>


                            </td>
                        </tr>
                <?php }
                }; ?>


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