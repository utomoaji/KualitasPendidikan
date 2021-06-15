<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Import Excel Data <?= $data['title'] ?></h3>
            </div>
            <div class="card-body">
                <form action="<?= BASEURL ?>/sdgs/upload" enctype="multipart/form-data" method="post">
                    <div class="form-group">
                        <label>Kategori</label>
                        <select name="kategori" class="form-control">
                            <option selected value="">Pilih Data</option>
                            <?php foreach ($data['kategori'] as $k) { ?>
                                <option value="<?= $k['id'] ?>"><?= $k['nama'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>File Excel</label>
                        <div class="custom-file">
                            <input type="file" name="sdgs" class="custom-file-input" id="customFile">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                    </div>
                    <input type="submit" class="btn btn-primary btn-sm float-right" value="Import data">
                </form>
                <a href="<?= BASEURL ?>/sdgs" class="btn btn-danger btn-sm">Kembali</a>
            </div>
        </div>
    </div>
</div>