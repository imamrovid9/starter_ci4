<?= $this->extend('pelamar/master/index') ?>
<?= $this->section('content') ?>
<!-- third party css -->
<link href="<?= base_url() ?>assets/libs/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url() ?>assets/libs/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url() ?>assets/libs/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url() ?>assets/libs/datatables/select.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <?php $errors = session()->getFlashdata('failed');
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
            <table id="datatable" class="table table-bordered dt-responsive nowrap text-center align middle" style="width: 100%;">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="text-center align middle">
                    <?php foreach ($data_lowongans as $data_lowongan) { ?>
                        <tr>
                            <td><a href="<?= base_url('perusahaan/detail/perusahaan/' .  $data_lowongan->username); ?>"><?= $data_lowongan->username ?></a></td>
                            <td><?= $data_lowongan->ket ?></td>
                            <td>
                                <button type=" button" class="btn btn-purple waves-effect waves-light" data-toggle="modal" data-target=".bs-example-modal-center-actionnn<?= $data_lowongan->data_lowongan_id ?>">Terima Lamaran</button>
                                <div class="modal fade bs-example-modal-center-actionnn<?= $data_lowongan->data_lowongan_id ?>" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myCenterModalLabel">Menerima Lamaran</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="<?= base_url('perusahaan/ubah/pelamar/' . $data_lowongan->data_lowongan_id) ?>" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                                                    <div class="form-group">
                                                        <select class="form-control" data-toggle="select2" name="status">
                                                            <option value="lolos" <?= $data_lowongan->ket == 'lolos' ? 'selected' : '' ?>>Lolos</option>
                                                            <option value="tidak lolos" <?= $data_lowongan->ket == 'tidak lolos' ? 'selected' : '' ?>>Tidak Lolos</option>
                                                            <option value="pending" <?= $data_lowongan->ket == 'pending' ? 'selected' : '' ?>>Pending</option>
                                                        </select>
                                                    </div>
                                                    <button type="submit" class="btn btn-success">Ubah Lamaran</button>
                                                </form>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->
                            </td>
                        </tr>
                    <?php } ?>

                </tbody>
            </table>
        </div>
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