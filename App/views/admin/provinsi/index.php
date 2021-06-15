<?php Flasher::flash(); ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar <?= $data['title'] ?></h3>
                <div class="card-tools">
                    <a href="<?= BASEURL ?>/Provinsi/create" class="btn btn-primary btn-sm">Tambah Data</a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="data" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($data['provinsi'] as $k) { ?>
                            <tr>
                                <td><?= $no ?></td>
                                <td><?= $k['nama'] ?></td>
                                <td>
                                    <a href="<?= BASEURL ?>/Provinsi/show/<?= $k['id']; ?>" class="btn btn-sm btn-primary">Detail</a>
                                    <a href="<?= BASEURL ?>/Provinsi/edit/<?= $k['id']; ?>" class="btn btn-sm btn-info">Edit</a>
                                    <a href="<?= BASEURL ?>/Provinsi/destroy/<?= $k['id']; ?>" class="btn btn-sm btn-danger">Hapus</a>
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