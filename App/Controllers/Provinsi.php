<?php

/**
 * 
 */
class Provinsi extends Controller
{
    public function index()
    {
        $data['active'] = 'provinsi';
        $data['title'] = 'Provinsi';
        $data['js'] = 'datatable';

        if (isset($_SESSION['nama'])) {
            $data['provinsi'] = $this->model('Provinsi_model')->getAllProvinsi();
            $this->view('templates/header', $data);
            $this->view('admin/provinsi/index', $data);
            $this->view('templates/footer', $data);
        } else {
            Flasher::setFlash('Hak Akses', 'Gagal', 'Anda tidak mempunyai akses', 'danger');
            $this->redirect('/Home');
        }
    }
    public function create()
    {
        $data['active'] = 'provinsi';
        $data['title'] = 'Provinsi';
        $data['subtitle'] = 'tambah';
        if (isset($_SESSION['nama'])) {
            $this->view('templates/header', $data);
            $this->view('admin/provinsi/create', $data);
            $this->view('templates/footer');
        } else {
            Flasher::setFlash('Hak Akses', 'Gagal', 'Anda tidak mempunyai akses', 'danger');
            $this->redirect('/Home');
        }
    }
    public function store()
    {
        if (isset($_SESSION['nama'])) {
            if (empty(trim($_POST['provinsi']))) {
                Flasher::setFlash('Provinsi', 'Gagal', 'ditambahkan, Silahkan Chek inputan anda, Jangan ada yang kosong', 'danger');
                $this->redirect('/Provinsi/create');
            } else {
                $hasil = $this->model('Provinsi_model')->addProvinsi($_POST);
                if ($hasil > 0) {
                    Flasher::setFlash('Provinsi', 'Berhasil', 'ditambahkan', 'success');
                    $this->redirect('/Provinsi');
                } else if ($hasil == 'provinsiada' &&  $hasil != null) {
                    Flasher::setFlash('Provinsi', 'Gagal', 'ditambahkan, Provinsi Telah di gunakan', 'danger');
                    $this->redirect('/Provinsi/create');
                } else {
                    Flasher::setFlash('Provinsi', 'Gagal', 'ditambahkan, Silahkan Chek inputan anda', 'danger');
                    $this->redirect('/Provinsi/create');
                }
            }
        } else {
            Flasher::setFlash('Hak Akses', 'Gagal', 'Anda tidak mempunyai akses', 'danger');
            $this->redirect('/Home');
        }
    }
    public function show($id)
    {
        $data['active'] = 'provinsi';
        $data['title'] = 'Provinsi';
        $data['subtitle'] = 'detail';

        if (isset($_SESSION['nama'])) {
            $data['provinsi'] = $this->model('Provinsi_model')->getProvinsiById($id);
            $this->view('templates/header', $data);
            $this->view('admin/provinsi/show', $data);
            $this->view('templates/footer');
        } else {
            Flasher::setFlash('Hak Akses', 'Gagal', 'Anda tidak mempunyai akses', 'danger');
            $this->redirect('/Home');
        }
    }
    public function edit($id)
    {
        $data['active'] = 'provinsi';
        $data['title'] = 'Provinsi';
        $data['subtitle'] = 'edit';
        if (isset($_SESSION['nama'])) {
            $data['provinsi'] = $this->model('Provinsi_model')->getProvinsiById($id);
            $this->view('templates/header', $data);
            $this->view('admin/provinsi/edit', $data);
            $this->view('templates/footer');
        } else {
            Flasher::setFlash('Hak Akses', 'Gagal', 'Anda tidak mempunyai akses', 'danger');
            $this->redirect('/Home');
        }
    }
    public function update($id)
    {
        if (isset($_SESSION['nama'])) {
            if (!empty(trim($_POST['provinsi']))) {
                $before  = $this->model('Provinsi_model')->getProvinsiById($id);
                if ($_POST['provinsi'] == $before['nama']) {
                    Flasher::setFlash('Provinsi', 'Info', 'Provinsi Sama dengan yang asli', 'info');
                    $this->redirect('/Provinsi');
                } elseif ($this->model('Provinsi_model')->updateProvinsi($_POST) > 0) {
                    Flasher::setFlash('Provinsi', 'Berhasil', 'diubah', 'success');
                    $this->redirect('/Provinsi');
                } else {
                    Flasher::setFlash('Provinsi', 'Gagal', 'ditambahkan, Silahkan Chek inputan anda', 'danger');
                    $this->redirect('/Provinsi/edit/' . $id);
                }
            } else {
                Flasher::setFlash('Provinsi', 'Gagal', 'ditambahkan, Silahkan Chek inputan anda, Jangan ada yang kosong', 'danger');
                $this->redirect('/Provinsi/edit/' . $id);
            }
        } else {
            Flasher::setFlash('Hak Akses', 'Gagal', 'Anda tidak mempunyai akses', 'danger');
            $this->redirect('/Home');
        }
    }
    public function destroy($id)
    {
        if (isset($_SESSION['nama'])) {
            if ($this->model('Provinsi_model')->destroyProvinsi($id) > 0) {
                Flasher::setFlash('Provinsi', 'Berhasil', 'dihapus', 'success');
                $this->redirect('/Provinsi');
            } else {
                Flasher::setFlash('Provinsi', 'Gagal', 'dihapus, Silahkan Chek data anda', 'danger');
                $this->redirect('/Provinsi');
            }
        } else {
            Flasher::setFlash('Hak Akses', 'Gagal', 'Anda tidak mempunyai akses', 'danger');
            $this->redirect('/Home');
        }
    }
}
