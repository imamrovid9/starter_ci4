<?= $this->extend('pelamar/master/index') ?>
<?= $this->section('content') ?>
<div class="card" style="min-height: 100%;">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="container">
                    <div class="float-left pl-4">
                        <h4>Nama Perusahaan : <?= $perusahaan->username ?></h4><br>
                    </div>
                    <img src="<?= base_url("img/$perusahaan->image") ?>" alt="Update image profile" class="pt-5">
                </div>
                <div class="text-center align-middle">
                    <a href="<?= base_url('/') ?>" class="btn btn-secondary  mt-5">Back</a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group col-md-10">
                    <label for="inputCity">Lokasi Perusahaan</label>
                    <input type="text" class="form-control" id="inputCity" value="<?= $perusahaan->city ?>" readonly>
                </div>
                <div class="form-group col-md-10">
                    <label for="lokasi">Deskripsi Perusahaan</label>
                    <textarea id="lokasi" cols="30" rows="10" readonly style="width: 100%;"><?= $perusahaan->description ?></textarea>
                </div>
            </div>

        </div>
    </div>
</div>
<?= $this->endSection() ?>