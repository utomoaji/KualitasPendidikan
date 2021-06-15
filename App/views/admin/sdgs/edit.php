<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Data <?= $data['title'] ?> </h3>
            </div>
            <div class="card-body">
                <form action="<?= BASEURL ?>/sdgs/update/<?= $data['sdgs']['id'] ?>" method="post">
                    <input type="hidden" name="idsdgs" value="<?= $data['sdgs']['id'] ?>">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Kategori</label>
                                <select name="kategori" class="form-control">
                                    <option selected value="<?= $data['sdgs']['nama_kategori'] ?>"><?= $data['sdgs']['nama_kategori'] ?></option>
                                    <?php foreach ($data['kategori'] as $k) { ?>
                                        <option value="<?= $k['id'] ?>"><?= $k['nama'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Provinsi</label>
                                <select name="provinsi" class="form-control">
                                    <option selected value="<?= $data['sdgs']['nama_provinsi'] ?>"><?= $data['sdgs']['nama_provinsi'] ?></option>
                                    <?php foreach ($data['provinsi'] as $p) { ?>
                                        <option value="<?= $p['id'] ?>"><?= $p['nama'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Nilai</label>
                        <div class="input-group mb-3">
                            <input type="text" name="nilai" class="form-control" placeholder="Masukan nilai" value="<?= $data['sdgs']['nilai'] ?>">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-globe"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="submit" class="btn btn-primary btn-sm float-right" value="Ubah Provinsi">
                </form>
                <a href="<?= BASEURL ?>/sdgs" class="btn btn-danger btn-sm">Kembali</a>
            </div>
        </div>
    </div>
</div>