<?php

/**
 * 
 */
class Kategori extends Controller
{
    public function index()
    {
        $data['active'] = 'kategori';
        $data['title'] = 'Kategori';
        $data['js'] = 'datatable';
        // $data['script'] = "";

        if (isset($_SESSION['nama'])) {
            $data['kategori'] = $this->model('Kategori_model')->getAllKategori();
            // die($data['kategori']);
            $this->view('templates/header', $data);
            $this->view('admin/kategori/index', $data);
            $this->view('templates/footer', $data);
        } else {
            Flasher::setFlash('Hak Akses', 'Gagal', 'Anda tidak mempunyai akses', 'danger');
            $this->redirect('/Home');
        }
    }
    public function create()
    {
        $data['active'] = 'kategori';
        $data['title'] = 'Kategori';
        $data['subtitle'] = 'create';
        if (isset($_SESSION['nama'])) {
            $this->view('templates/header', $data);
            $this->view('admin/kategori/create', $data);
            $this->view('templates/footer');
        } else {
            Flasher::setFlash('Hak Akses', 'Gagal', 'Anda tidak mempunyai akses', 'danger');
            $this->redirect('/Home');
        }
    }
    public function store()
    {
        if (isset($_SESSION['nama'])) {
            if (empty(trim($_POST['kategori']))) {
                Flasher::setFlash('Kategori', 'Gagal', 'ditambahkan, Silahkan Chek inputan anda, Jangan ada yang kosong', 'danger');
                $this->redirect('/Kategori/create');
            } else {
                $hasil = $this->model('Kategori_model')->addKategori($_POST);
                if ($hasil > 0) {
                    Flasher::setFlash('Kategori', 'Berhasil', 'ditambahkan', 'success');
                    $this->redirect('/Kategori');
                } else if ($hasil == 'kategoriada' &&  $hasil != null) {
                    Flasher::setFlash('Kategori', 'Gagal', 'ditambahkan, Kategori Telah di gunakan', 'danger');
                    $this->redirect('/Kategori/create');
                } else {
                    Flasher::setFlash('Kategori', 'Gagal', 'ditambahkan, Silahkan Chek inputan anda', 'danger');
                    $this->redirect('/Kategori/create');
                }
            }
        } else {
            Flasher::setFlash('Hak Akses', 'Gagal', 'Anda tidak mempunyai akses', 'danger');
            $this->redirect('/Home');
        }
    }
    public function show($id)
    {
        $data['active'] = 'kategori';
        $data['title'] = 'Kategori';
        $data['subtitle'] = 'detail';

        if (isset($_SESSION['nama'])) {
            $data['kategori'] = $this->model('Kategori_model')->getKategoriById($id);
            $this->view('templates/header', $data);
            $this->view('admin/kategori/show', $data);
            $this->view('templates/footer', $data);
        } else {
            Flasher::setFlash('Hak Akses', 'Gagal', 'Anda tidak mempunyai akses', 'danger');
            $this->redirect('/Home');
        }
    }
    public function edit($id)
    {
        $data['active'] = 'kategori';
        $data['title'] = 'Kategori';
        $data['subtitle'] = 'edit';

        if (isset($_SESSION['nama'])) {
            $data['kategori'] = $this->model('Kategori_model')->getKategoriById($id);
            $this->view('templates/header', $data);
            $this->view('admin/kategori/edit', $data);
            $this->view('templates/footer', $data);
        } else {
            Flasher::setFlash('Hak Akses', 'Gagal', 'Anda tidak mempunyai akses', 'danger');
            $this->redirect('/Home');
        }
    }
    public function update($id)
    {
        // die($_POST['kategori']);
        if (isset($_SESSION['nama'])) {
            if (!empty(trim($_POST['kategori']))) {
                $before  = $this->model('Kategori_model')->getKategoriById($id);
                if ($_POST['kategori'] == $before['nama']) {
                    Flasher::setFlash('Kategori', 'Info', 'Kategori Sama dengan yang asli', 'info');
                    $this->redirect('/Kategori');
                } elseif ($this->model('Kategori_model')->updateKategori($_POST) > 0) {
                    Flasher::setFlash('Kategori', 'Berhasil', 'diubah', 'success');
                    $this->redirect('/Kategori');
                } else {
                    Flasher::setFlash('Kategori', 'Gagal', 'ditambahkan, Silahkan Chek inputan anda', 'danger');
                    $this->redirect('/Kategori/edit/' . $id);
                }
            } else {
                Flasher::setFlash('Kategori', 'Gagal', 'ditambahkan, Silahkan Chek inputan anda, Jangan ada yang kosong', 'danger');
                $this->redirect('/Kategori/edit/' . $id);
            }
        } else {
            Flasher::setFlash('Hak Akses', 'Gagal', 'Anda tidak mempunyai akses', 'danger');
            $this->redirect('/Home');
        }
    }
    public function destroy($id)
    {
        if (isset($_SESSION['nama'])) {
            if ($this->model('Kategori_model')->destroyKategori($id) > 0) {
                Flasher::setFlash('Kategori', 'Berhasil', 'dihapus', 'success');
                $this->redirect('/Kategori');
            } else {
                Flasher::setFlash('Kategori', 'Gagal', 'dihapus, Silahkan Chek data anda', 'danger');
                $this->redirect('/Kategori');
            }
        } else {
            Flasher::setFlash('Hak Akses', 'Gagal', 'Anda tidak mempunyai akses', 'danger');
            $this->redirect('/Home');
        }
    }
}
