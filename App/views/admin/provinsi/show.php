<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Detail Data <?= $data['title'] ?> <?= $data['provinsi']['nama'] ?> </h3>
            </div>
            <div class="card-body">
                <form action="#" method="post">
                    <input type="hidden" name="id" value="<?= $data['provinsi']['id'] ?>">
                    <div class="form-group">
                        <label>Provinsi</label>
                        <div class="input-group mb-3">
                            <input type="text" name="provinsi" class="form-control" value="<?= $data['provinsi']['nama'] ?>" placeholder="Provinsi" readonly>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-globe"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <input type="submit" class="btn btn-primary btn-sm float-right" value="Tambah provinsi"> -->
                </form>
                <a href="<?= BASEURL ?>/provinsi" class="btn btn-danger btn-sm">Kembali</a>
            </div>
        </div>
    </div>
</div>