<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar <?= $data['title'] ?></h3>
                <div class="card-tools">
                    <a href="<?= BASEURL ?>/sdgs/create" class="btn btn-primary btn-sm">Tambah Data</a>
                    <a href="<?= BASEURL ?>/sdgs/import" class="btn btn-primary btn-sm">Import Data</a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="data" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Kategori</th>
                            <th>Provinsi</th>
                            <th>Tahun</th>
                            <th>Nilai</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($data['sdgs'] as $k) { ?>
                            <tr>
                                <td><?= $no ?></td>
                                <td><?= $k['nama_kategori'] ?></td>
                                <td><?= $k['nama_provinsi'] ?></td>
                                <td><?= $k['nilai'] ?></td>
                                <td><?= $k['tahun'] ?></td>
                                <td>
                                    <a href="<?= BASEURL ?>/sdgs/show/<?= $k['id']; ?>" class="btn btn-sm btn-primary">Detail</a>
                                    <a href="<?= BASEURL ?>/sdgs/edit/<?= $k['id']; ?>" class="btn btn-sm btn-info">Edit</a>
                                    <a href="<?= BASEURL ?>/sdgs/destroy/<?= $k['id']; ?>" class="btn btn-sm btn-danger">Hapus</a>
                                </td>
                            </tr>
                            <?php $no++; ?>
                        <?php } ?>

                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>
<!-- $this->model('Kategori_model')->getNamaKategoriById($k['kategori_id']); -->