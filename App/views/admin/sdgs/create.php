<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Tambah Data <?= $data['title'] ?></h3>
            </div>
            <div class="card-body">
                <form action="<?= BASEURL ?>/sdgs/store" method="post">
                    <div class="row">
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label>Kategori</label>
                                <select name="kategori" class="form-control">
                                    <option selected value="">Pilih Data</option>
                                    <?php foreach ($data['kategori'] as $k) { ?>
                                        <option value="<?= $k['id'] ?>"><?= $k['nama'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label>Provinsi</label>
                                <select name="provinsi" class="form-control">
                                    <option selected value="">Pilih Data</option>
                                    <?php foreach ($data['provinsi'] as $p) { ?>
                                        <option value="<?= $p['id'] ?>"><?= $p['nama'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label>Tahun</label>
                                <div class="input-group mb-3">
                                    <input type="text" name="tahun" class="form-control" placeholder="Masukan tahun">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-gg"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Nilai</label>
                        <div class="input-group mb-3">
                            <input type="text" name="nilai" class="form-control" placeholder="Masukan nilai">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-globe"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="submit" class="btn btn-primary btn-sm float-right" value="Tambah nilai">
                </form>
                <a href="<?= BASEURL ?>/sdgs" class="btn btn-danger btn-sm">Kembali</a>
            </div>
        </div>
    </div>
</div>