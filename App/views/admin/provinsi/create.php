<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Tambah Data <?= $data['title'] ?></h3>
            </div>
            <div class="card-body">
                <form action="<?= BASEURL ?>/Provinsi/store" method="post">
                    <div class="form-group">
                        <label>Provinsi</label>
                        <div class="input-group mb-3">
                            <input type="text" name="provinsi" class="form-control" placeholder="Masukan Provinsi">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-globe"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="submit" class="btn btn-primary btn-sm float-right" value="Tambah Provinsi">
                </form>
                <a href="<?= BASEURL ?>/Provinsi" class="btn btn-danger btn-sm">Kembali</a>
            </div>
        </div>
    </div>
</div>