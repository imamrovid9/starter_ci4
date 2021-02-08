<?= $this->extend('pelamar/master/index') ?>
<?= $this->section('content') ?>
<div class="card">
    <div class="card-body">
        <?php
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




        <form action="<?= base_url('pelamar/profile/' . user()->username); ?>" method="post" enctype="multipart/form-data" accept-charset="utf-8">
            <?= csrf_field(); ?>
            <input type="hidden" value="<?= user()->username ?>" name="username">
            <input type="hidden" name="oldfoto" value="<?= $user->image ?>">
            <div class="row ">
                <div class="col-md-6">
                    <div class="container">
                        <div class="container">
                            <img src="<?= base_url("img/$user->image") ?>" alt="Update image profile">
                        </div>
                        <div class="input-group pt-4">
                            <div class="custom-file">
                                <input type="file" name="image" class="custom-file-input" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04">
                                <label class="custom-file-label" for="inputGroupFile04">Upload Image Profile</label>
                            </div>
                        </div>


                    </div>
                </div>
                <div class="col-md-6">

                    <div class="form-row">
                        <div class="form-group col-md-10">
                            <label for="inputCity">City</label>
                            <input type="text" class="form-control" id="inputCity" name="city" value="<?= $user->city ?>" require placeholder="city">
                        </div>
                        <div class="form-group col-md-10">
                            <label for="inputState">Gender</label>
                            <select id="inputState" class="form-control" name="gender" require>
                                <option <?= $user->gender === null ? '' : 'selected' ?>>Choose...</option>
                                <option value="l" <?= $user->gender == "l" ? 'selected' : '' ?>>Male</option>
                                <option value="p" <?= $user->gender == "p" ? 'selected' : '' ?>>Female</option>
                            </select>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary pull-right mr-5">Update</button>
        </form>
    </div>

</div>
</form>
</div>
</div>
<?= $this->endSection() ?>