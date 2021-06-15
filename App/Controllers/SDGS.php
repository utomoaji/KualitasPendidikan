<?php

/**
 * 
 */
class SDGS extends Controller
{
    public function index()
    {
        $data['active'] = 'sdgs';
        $data['title'] = 'SDGS';
        $data['js'] = 'datatable';

        if (isset($_SESSION['nama'])) {
            $data['sdgs'] = $this->model('SDGS_model')->getAllSDGS();
            $data['kategori'] = $this->model('Kategori_model')->getAllKategori();
            $data['provinsi'] = $this->model('Provinsi_model')->getAllProvinsi();
            $this->view('templates/header', $data);
            $this->view('admin/sdgs/index', $data);
            $this->view('templates/footer', $data);
        } else {
            Flasher::setFlash('Hak Akses', 'Gagal', 'Anda tidak mempunyai akses', 'danger');
            $this->redirect('/Home');
        }
    }
    public function create()
    {
        $data['active'] = 'sdgs';
        $data['title'] = 'SDGS';
        $data['subtitle'] = 'tambah';
        if (isset($_SESSION['nama'])) {
            $data['kategori'] = $this->model('Kategori_model')->getAllKategori();
            $data['provinsi'] = $this->model('Provinsi_model')->getAllProvinsi();
            $this->view('templates/header', $data);
            $this->view('admin/sdgs/create', $data);
            $this->view('templates/footer');
        } else {
            Flasher::setFlash('Hak Akses', 'Gagal', 'Anda tidak mempunyai akses', 'danger');
            $this->redirect('/Home');
        }
    }
    public function store()
    {
        if (isset($_SESSION['nama'])) {
            if (empty(trim($_POST['provinsi'])) || empty(trim($_POST['kategori'])) || empty(trim($_POST['nilai']))) {
                Flasher::setFlash('SDGS', 'Gagal', 'ditambahkan, Silahkan Chek inputan anda, Jangan ada yang kosong', 'danger');
                $this->redirect('/sdgs/create');
            } else {
                $hasil = $this->model('SDGS_model')->addSDGS($_POST);
                if (!is_numeric($_POST['nilai'])) {
                    Flasher::setFlash('SDGS', 'Gagal', 'ditambahkan, Nilai harus angka', 'danger');
                    $this->redirect('/SDGS/create');
                } elseif ($hasil > 0) {
                    Flasher::setFlash('SDGS', 'Berhasil', 'ditambahkan', 'success');
                    $this->redirect('/SDGS');
                } else if ($hasil == 'dataada' &&  $hasil != null) {
                    Flasher::setFlash('SDGS', 'Gagal', 'ditambahkan, SDGS sudah tersedia', 'danger');
                    $this->redirect('/SDGS/create');
                } else {
                    Flasher::setFlash('SDGS', 'Gagal', 'ditambahkan, Silahkan Chek inputan anda', 'danger');
                    $this->redirect('/SDGS/create');
                }
            }
        } else {
            Flasher::setFlash('Hak Akses', 'Gagal', 'Anda tidak mempunyai akses', 'danger');
            $this->redirect('/Home');
        }
    }
    public function show($id)
    {
        $data['active'] = 'sdgs';
        $data['title'] = 'SDGS';
        $data['subtitle'] = 'detail';

        if (isset($_SESSION['nama'])) {
            $data['sdgs'] = $this->model('SDGS_model')->getSDGSById($id);
            $this->view('templates/header', $data);
            $this->view('admin/sdgs/show', $data);
            $this->view('templates/footer');
        } else {
            Flasher::setFlash('Hak Akses', 'Gagal', 'Anda tidak mempunyai akses', 'danger');
            $this->redirect('/Home');
        }
    }
    public function edit($id)
    {
        $data['active'] = 'sdgs';
        $data['title'] = 'SDGS';
        $data['subtitle'] = 'edit';
        if (isset($_SESSION['nama'])) {
            $data['kategori'] = $this->model('Kategori_model')->getAllKategori();
            $data['provinsi'] = $this->model('Provinsi_model')->getAllProvinsi();
            $data['sdgs'] = $this->model('SDGS_model')->getSDGSById($id);
            $this->view('templates/header', $data);
            $this->view('admin/sdgs/edit', $data);
            $this->view('templates/footer');
        } else {
            Flasher::setFlash('Hak Akses', 'Gagal', 'Anda tidak mempunyai akses', 'danger');
            $this->redirect('/Home');
        }
    }
    public function update($id)
    {
        if (isset($_SESSION['nama'])) {
            if (!empty(trim($_POST['nilai']))) {
                $before['sdgs']  = $this->model('SDGS_model')->getSDGSById($id);
                // die('nama provinsi ' . $before['sdgs']['nama_provinsi'] . ' == ' . $_POST['provinsi'] . ', nama kategori ' . $before['sdgs']['nama_kategori'] . ' == ' . $_POST['kategori'] . ' nilai ' . $before['sdgs']['nilai'] . ' == ' . $_POST['nilai']);
                // die(!is_numeric($_POST['nilai']));
                if ($_POST['kategori'] == $before['sdgs']['nama_kategori'] && $_POST['provinsi'] == $before['sdgs']['nama_provinsi']) {
                    if ($_POST['nilai'] == $before['sdgs']['nilai']) {
                        Flasher::setFlash('SDGS', 'Berhasil', 'tidak ada data yang diubah', 'info');
                        $this->redirect('/sdgs');
                    } else {
                        if (!is_numeric($_POST['nilai'])) {
                            Flasher::setFlash('SDGS', 'Gagal', 'Nilai harus berupa angka', 'danger');
                            $this->redirect('/sdgs/edit/' . $id);
                        } else {
                            $this->model('SDGS_model')->updateNilaiSDGS($_POST);
                            Flasher::setFlash('SDGS', 'Berhasil', 'Nilai diubah', 'success');
                            $this->redirect('/sdgs');
                        }
                    }
                } elseif ($_POST['kategori'] == $before['sdgs']['nama_kategori']) {
                    if ($_POST['nilai'] == $before['sdgs']['nilai']) {
                        $this->model('SDGS_model')->updateProvinsiSDGS($_POST);
                        Flasher::setFlash('SDGS', 'Berhasil', 'Provinsi diubah', 'info');
                        $this->redirect('/sdgs');
                    } else {
                        if (!is_numeric($_POST['nilai'])) {
                            Flasher::setFlash('SDGS', 'Gagal', 'Nilai harus berupa angka', 'danger');
                            $this->redirect('/sdgs/edit/' . $id);
                        } else {
                            $this->model('SDGS_model')->updateWitoutKategoriSDGS($_POST);
                            Flasher::setFlash('SDGS', 'Berhasil', 'Nilai dan provinsi diubah', 'success');
                            $this->redirect('/sdgs');
                        }
                    }
                } elseif ($_POST['provinsi'] == $before['sdgs']['nama_provinsi']) {
                    if ($_POST['nilai'] == $before['sdgs']['nilai']) {
                        $this->model('SDGS_model')->updateKategoriSDGS($_POST);
                        Flasher::setFlash('SDGS', 'Berhasil', 'Kategori diubah', 'info');
                        $this->redirect('/sdgs');
                    } else {
                        if (!is_numeric($_POST['nilai'])) {
                            Flasher::setFlash('SDGS', 'Gagal', 'Nilai harus berupa angka', 'danger');
                            $this->redirect('/sdgs/edit/' . $id);
                        } else {
                            $this->model('SDGS_model')->updateWitoutProvinsiSDGS($_POST);
                            Flasher::setFlash('SDGS', 'Berhasil', 'Nilai dan provinsi diubah', 'success');
                            $this->redirect('/sdgs');
                        }
                    }
                } else {
                    Flasher::setFlash('SDGS', 'Gagal', 'ditambahkan, Silahkan Chek inputan anda', 'danger');
                    $this->redirect('/sdgs/edit/' . $id);
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
            if ($this->model('SDGS_model')->destroySDGS($id) > 0) {
                Flasher::setFlash('SDGS', 'Berhasil', 'dihapus', 'success');
                $this->redirect('/sdgs');
            } else {
                Flasher::setFlash('SDGS', 'Gagal', 'dihapus, Silahkan Chek data anda', 'danger');
                $this->redirect('/sdgs');
            }
        } else {
            Flasher::setFlash('Hak Akses', 'Gagal', 'Anda tidak mempunyai akses', 'danger');
            $this->redirect('/Home');
        }
    }
    public function import()
    {
        $data['active'] = 'sdgs';
        $data['title'] = 'SDGS';
        $data['subtitle'] = 'import';

        if (isset($_SESSION['nama'])) {
            $data['kategori'] = $this->model('Kategori_model')->getAllKategori();
            $this->view('templates/header', $data);
            $this->view('admin/sdgs/import', $data);
            $this->view('templates/footer');
        } else {
            Flasher::setFlash('Hak Akses', 'Gagal', 'Anda tidak mempunyai akses', 'danger');
            $this->redirect('/Home');
        }
    }
    public function upload()
    {
        // $this->model('SDGS_model')->proses($_POST['kategori']);
        // if (isset($_SESSION['nama'])) {
        //     Flasher::setFlash('SDGS', 'Berhasil', 'Import data berhasil', 'success');
        //     $this->redirect('/sdgs');
        // } else {
        //     Flasher::setFlash('Hak Akses', 'Gagal', 'Anda tidak mempunyai akses', 'danger');
        //     $this->redirect('/Home');
        // }

        if (isset($_SESSION['nama'])) {
            if (empty(trim($_POST['kategori']))) {
                Flasher::setFlash('SDGS', 'Gagal', 'diimport, Silahkan Chek inputan anda, Jangan ada yang kosong', 'danger');
                $this->redirect('/sdgs/import');
            } else {
                $hasil = $this->model('SDGS_model')->proses($_POST);
                // die($hasil);
                if ($hasil > 0) {
                    Flasher::setFlash('SDGS', 'Berhasil', 'diimport', 'success');
                    $this->redirect('/SDGS');
                } else if ($hasil == 'dataada' &&  $hasil != null) {
                    Flasher::setFlash('SDGS', 'Gagal', 'diimport, mungkin beberapa data sudah ter import', 'danger');
                    $this->redirect('/SDGS/import');
                } else {
                    Flasher::setFlash('SDGS', 'Gagal', 'ditambahkan, Silahkan Chek inputan anda', 'danger');
                    $this->redirect('/SDGS/import');
                }
            }
        } else {
            Flasher::setFlash('Hak Akses', 'Gagal', 'Anda tidak mempunyai akses', 'danger');
            $this->redirect('/Home');
        }
    }
    // public function proses($id)
    // {
    //     $file_mimes = array('application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

    //     if (isset($_FILES['sdgs']['name']) && in_array($_FILES['sdgs']['type'], $file_mimes)) {

    //         $arr_file = explode('.', $_FILES['sdgs']['name']);
    //         $extension = end($arr_file);
    //         // die($id);
    //         if ('csv' == $extension) {
    //             $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
    //         } else {
    //             $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
    //         }

    //         $spreadsheet = $reader->load($_FILES['sdgs']['tmp_name']);
    //         $sheetData = $spreadsheet->getActiveSheet()->toArray();

    //         for ($i = 1; $i < count($sheetData); $i++) {
    //             $provinsi = $this->model('Provinsi_model')->getProvinsiByNama($sheetData[$i][0]);

    //             $exist = $this->model('SDGS_model')->getSDGSByKategoriProvinsiTahun($id, $provinsi['id'], $sheetData[$i][2]);
    //             // var_dump($exist, $provinsi, $sheetData[$i][2], $id);
    //             if ($exist) {
    //                 die('masuk if');
    //             } else {
    //                 die('masuk else');
    //                 if ($provinsi) {
    //                     // die('masuk if');
    //                     $hasil['provinsi'] = $this->model('Provinsi_model')->getProvinsiByNama($sheetData[$i][0]);

    //                     $data['nilai'] = $sheetData[$i][1];
    //                     $data['kategori'] = $id;
    //                     $data['provinsi'] = $hasil['provinsi']['id'];
    //                     $data['tahun'] = $sheetData[$i][2];

    //                     $this->model('SDGS_model')->addSDGS($data);
    //                 } else {
    //                     $sheet['provinsi'] = $sheetData[$i][0];

    //                     $this->model('Provinsi_model')->addProvinsi($sheet);
    //                     $hasil['provinsi'] = $this->model('Provinsi_model')->getProvinsiByNama($sheetData[$i][0]);

    //                     $data['tahun'] = $sheetData[$i][2];
    //                     $data['nilai'] = $sheetData[$i][1];
    //                     $data['kategori'] = $id;
    //                     $data['provinsi'] = $hasil['provinsi']['id'];

    //                     $this->model('SDGS_model')->addSDGS($data);
    //                 }
    //             }
    //         }
    //         // die();
    //     }
    // }
}
