<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Detail Data <?= $data['title'] ?> <?= $data['kategori']['nama'] ?> </h3>
            </div>
            <div class="card-body">
                <form action="#" method="post">
                    <input type="hidden" name="id" value="<?= $data['kategori']['id'] ?>">
                    <div class="form-group">
                        <label>Kategori</label>
                        <div class="input-group mb-3">
                            <input type="text" name="kategori" class="form-control" value="<?= $data['kategori']['nama'] ?>" placeholder="Kategori" readonly>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-tag"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <input type="submit" class="btn btn-primary btn-sm float-right" value="Tambah Kategori"> -->
                </form>
                <a href="<?= BASEURL ?>/Kategori" class="btn btn-danger btn-sm">Kembali</a>
            </div>
        </div>
    </div>
</div>