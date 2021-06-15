<?php

/**
 * 
 */
class User extends Controller
{

    public function tambahUser()
    {
        if (empty(trim($_POST['email'])) || empty(trim($_POST['nama'])) || empty(trim($_POST['password']))) {
            Flasher::setFlash('Pendaftaran', 'Gagal', 'ditambahkan, Silahkan Chek inputan anda, Jangan ada yang kosong', 'danger');
            $this->redirect('/Home/register');
        } else {
            $hasilRegis = $this->model('User_model')->addUSER($_POST);
            if ($hasilRegis > 0) {
                Flasher::setFlash('Pendaftaran', 'Berhasil', 'ditambahkan', 'success');
                $this->redirect('/Home/login');
            } else if ($hasilRegis == 'emailada' &&  $hasilRegis != null) {
                Flasher::setFlash('Pendaftaran', 'Gagal', 'ditambahkan, Email Telah di gunakan, silahkan gunakan email lainnya', 'danger');
                $this->redirect('/Home/register');
            } else if ($hasilRegis == 'namaada' &&  $hasilRegis != null) {
                Flasher::setFlash('Pendaftaran', 'Gagal', 'ditambahkan, Nama Telah di gunakan, silahkan gunakan Nama lainnya', 'danger');
                $this->redirect('/Home/register');
            } else {
                Flasher::setFlash('Pendaftaran', 'Gagal', 'ditambahkan, Silahkan Chek inputan anda', 'danger');
                $this->redirect('/Home/register');
            }
        }
    }

    public function masuk()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        if (!empty(trim($email)) && !empty(trim($password))) {
            if ($this->model('User_model')->loginUser($_POST) > 0) {
                // die('masuk if setelah model user : ' . $email . ' ' . $password);
                Flasher::setFlash('Login', 'Berhasil', 'Selamat Datang ' . $email, 'success');
                $this->redirect('/User/dashboard');
            } else {
                // die('masuk ' . $email . ' ' . $password);
                Flasher::setFlash('Login', 'Gagal', 'Ada kesalahan Silahkan Chek inputan anda', 'danger');
                $this->redirect('/Home/login');
            }
        } else {
            Flasher::setFlash('Login', 'Gagal', 'Silahkan Chek inputan anda', 'danger');
            $this->redirect('/Home/login');
        }
    }

    public function logout()
    {
        session_destroy();
        $this->redirect('/Home');
    }

    public function updateData()
    {
        if (empty(trim($_POST['email'])) || empty(trim($_POST['nama'])) || empty(trim($_POST['alamat'])) || empty(trim($_POST['nohp']))) {
            Flasher::setFlash('Setting', 'Gagal', 'Silahkan Chek inputan anda, Jangan ada yang kosong', 'danger');
            $this->redirect('/User/setting');
        } else {

            if (empty($_FILES['foto']['name']) > 0) {
                if (!empty(trim($_POST['password']))) {
                    $Hasilupdate = $this->model('Users_model')->settingWithPassnoFoto($_POST);
                    if ($Hasilupdate > 0) {
                        Flasher::setFlash('Setting', 'Berhasil', 'Data telah di perbaharui', 'success');
                        $this->redirect('/User/setting');
                    } else if ($Hasilupdate == 'emailada' &&  $Hasilupdate != null) {
                        Flasher::setFlash('Setting', 'Gagal', 'diupdate, Email Telah di gunakan, silahkan gunakan email lainnya', 'danger');
                        $this->redirect('/User/setting');
                    } else if ($Hasilupdate == 'namaada' &&  $Hasilupdate != null) {
                        Flasher::setFlash('Setting', 'Gagal', 'diupdate, Nama Telah di gunakan, silahkan gunakan Nama lainnya', 'danger');
                        $this->redirect('/User/setting');
                    } else {
                        Flasher::setFlash('Setting', 'Gagal', 'diupdate, Silahkan Chek inputan anda', 'danger');
                        $this->redirect('/User/setting');
                    }
                } else {
                    // die('masuk sini');
                    $Hasilupdate = $this->model('Users_model')->settingNoPassnoFoto($_POST);
                    // die($Hasilupdate);
                    if ($Hasilupdate > 0) {
                        Flasher::setFlash('Setting', 'Berhasil', 'Data telah di perbaharui', 'success');
                        $this->redirect('/User/setting');
                    } else if ($Hasilupdate == 'emailada' &&  $Hasilupdate != null) {
                        Flasher::setFlash('Setting', 'Gagal', 'diupdate, Email Telah di gunakan, silahkan gunakan email lainnya', 'danger');
                        $this->redirect('/User/setting');
                    } else if ($Hasilupdate == 'namaada' &&  $Hasilupdate != null) {
                        Flasher::setFlash('Setting', 'Gagal', 'diupdate, Nama Telah di gunakan, silahkan gunakan Nama lainnya', 'danger');
                        $this->redirect('/User/setting');
                    } else {
                        Flasher::setFlash('Setting', 'Gagal', 'diupdate, Silahkan Chek inputan anda', 'danger');
                        $this->redirect('/User/setting');
                    }
                }
            } else {
                if (!empty(trim($_POST['password']))) {
                    $Hasilupdate = $this->model('Users_model')->settingWithPassWithphoto($_POST);
                    if ($Hasilupdate > 0) {
                        Flasher::setFlash('Setting', 'Berhasil', 'Data telah di perbaharui', 'success');
                        $this->redirect('/User/setting');
                    } else if ($Hasilupdate == 'emailada' &&  $Hasilupdate != null) {
                        Flasher::setFlash('Setting', 'Gagal', 'diupdate, Email Telah di gunakan, silahkan gunakan email lainnya', 'danger');
                        $this->redirect('/User/setting');
                    } else if ($Hasilupdate == 'namaada' &&  $Hasilupdate != null) {
                        Flasher::setFlash('Setting', 'Gagal', 'diupdate, Nama Telah di gunakan, silahkan gunakan Nama lainnya', 'danger');
                        $this->redirect('/User/setting');
                    } else {
                        Flasher::setFlash('Setting', 'Gagal', 'diupdate, Silahkan Chek inputan anda', 'danger');
                        $this->redirect('/User/setting');
                    }
                } else {
                    // die('masuk');
                    $Hasilupdate = $this->model('Users_model')->settingNoPassWithphoto($_POST);
                    if ($Hasilupdate > 0) {
                        Flasher::setFlash('Setting', 'Berhasil', 'Data telah di perbaharui', 'success');
                        $this->redirect('/User/setting');
                    } else if ($Hasilupdate == 'emailada' &&  $Hasilupdate != null) {
                        Flasher::setFlash('Setting', 'Gagal', 'diupdate, Email Telah di gunakan, silahkan gunakan email lainnya', 'danger');
                        $this->redirect('/User/setting');
                    } else if ($Hasilupdate == 'namaada' &&  $Hasilupdate != null) {
                        Flasher::setFlash('Setting', 'Gagal', 'diupdate, Nama Telah di gunakan, silahkan gunakan Nama lainnya', 'danger');
                        $this->redirect('/User/setting');
                    } else {
                        Flasher::setFlash('Setting', 'Gagal', 'diupdate, Silahkan Chek inputan anda', 'danger');
                        $this->redirect('/User/setting');
                    }
                }
            }
        }
    }

    public function setting()
    {
        if (isset($_SESSION['nama'])) {
            $data['judul'] = 'Setting';
            $data['user'] = $this->model('Users_model')->getUserByid($_SESSION['id_user']);
            $this->view('templates/headerH', $data);
            $this->view('home/setting', $data);
            $this->view('templates/footer');
        } else {
            $this->view('home/index');
        }
    }

    public function dashboard()
    {
        $data['active'] = 'dashboard';
        if (isset($_SESSION['nama'])) {
            $data['title'] = 'Dashboard';
            $data['user'] = $this->model('User_model')->getUserByid($_SESSION['id_user']);
            // var_dump($data['user']);
            // die();
            $this->view('templates/header', $data);
            $this->view('admin/dashboard', $data);
            $this->view('templates/footer');
        } else {
            $this->view('templates/header', $data);
            $this->view('login');
            $this->view('templates/footer');
        }
    }

    public function deleteUser($id)
    {
        // die('masuk');
        if (isset($_SESSION['nama'])) {

            if ($this->model('Users_model')->DeleteUserUsr($id) > 0) {
                Flasher::setFlash('Member', 'Berhasil', 'dihapus', 'success');
                $this->redirect('/User/member');
            } else {
                Flasher::setFlash('Member', 'Gagal', 'dihapus, Silahkan Chek data anda', 'danger');
                $this->redirect('/User/member');
            }
        } else {
            $this->view('home/index');
        }
    }
}
