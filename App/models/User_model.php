<?php

/**
 * 
 */
class User_Model
{
    private $table = 'users';
    private $db;

    function __construct()
    {
        $this->db = new Database;
    }

    public function getAlluser()
    {
        $this->db->query('SELECT * FROM ' . $this->table);
        return $this->db->resultSet();
    }
    public function getUserByid($id)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id=:id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }
    public function getUserByUsername($username)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE username=:username');
        $this->db->bind('username', $username);
        return $this->db->single();
    }
    public function getUserByEmail($email)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE email=:email');
        $this->db->bind('email', $email);
        return $this->db->single();
    }
    public function getUserByNama($nama)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE nama=:nama');
        $this->db->bind('nama', $nama);
        return $this->db->single();
    }

    public function addUSER($data)
    {
        $role = 1;
        $password = password_hash($data['password'], PASSWORD_DEFAULT);
        $username =  $this->slugify($data['nama']);

        $hasilEmail['user'] = $this->getUserByEmail($data['email']);
        $hasilNama['user'] = $this->getUserByNama($data['nama']);
        if (!empty($hasilEmail['user']['email']) > 0) {
            return 'emailada';
        } else if (!empty($hasilNama['user']['nama']) > 0) {
            return 'namaada';
        } else {
            $query = "INSERT INTO " . $this->table . "(username, nama, avatar, email, password, role_id) VALUES (:username, :nama, :avatar, :email, :password, :role_id)";

            $this->db->query($query);

            $this->db->bind('username', $username);
            $this->db->bind('nama', $data['nama']);
            $this->db->bind('avatar', 'https://ui-avatars.com/api/?name=' . $data['nama']);
            $this->db->bind('email', $data['email']);
            $this->db->bind('password', $password);
            $this->db->bind('role_id', $role);
            // die($this->db->execute());
            $this->db->execute();

            return $this->db->rowCount();
        }
    }

    public function loginUser($data)
    {
        $dataUser = $this->getHash($data['email']);
        // var_dump($dataUser['id']);
        if (password_verify($data['password'], $dataUser['password'])) {
            $_SESSION['id_user'] = $dataUser['id'];
            $_SESSION['nama'] = $dataUser['nama'];
            $_SESSION['email'] = $dataUser['email'];
            $_SESSION['username'] = $dataUser['username'];
            $_SESSION['avatar'] = $dataUser['avatar'];
            $_SESSION['role'] = $dataUser['role_id'];
            return 1;
        } else {
            return 0;
        }
    }

    public function getHash($email)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE email=:email');
        $this->db->bind('email', $email);
        return $this->db->single();
    }

    public function settingWithPassWithphoto($data)
    {
        $password = password_hash($data['password'], PASSWORD_DEFAULT);
        $username =  $this->slugify($data['nama']);

        $hasilEmail['user'] = $this->getUserByEmail($data['email']);
        $hasilNama['user'] = $this->getUserByNama($data['nama']);

        if ($hasilEmail['user']['id'] == $_SESSION['id_user']) {
            if ($hasilNama['user']['nama'] == $_SESSION['nama']) {
                $nama     = $_FILES['foto']['name'];
                $asal = $_FILES['foto']['tmp_name'];
                $namaFile = 'image/projek/' . basename($nama);
                $time = time();

                $ex = strtolower(pathinfo($nama, PATHINFO_EXTENSION));
                if ($ex != "jpg" && $ex != "png" && $ex != "jpeg") {
                    return 0;
                } else {
                    if (file_exists($namaFile)) {
                        if ($ex == "jpg") {
                            $namaFile = str_replace(".jpg", "", $namaFile);
                            $namaFile = $namaFile . "_" . $time . ".jpg";
                            $nama = str_replace(".jpg", "", $nama);
                            $nama = $nama . "_" . $time . ".jpg";
                        } else if ($ex == "png") {
                            $namaFile = str_replace(".png", "", $namaFile);
                            $namaFile = $namaFile . "_" . $time . ".png";
                            $nama = str_replace(".png", "", $nama);
                            $nama = $nama . "_" . $time . ".png";
                        } else if ($ex == "jpeg") {
                            $namaFile = str_replace(".jpeg", "", $namaFile);
                            $namaFile = $namaFile . "_" . $time . ".jpeg";
                            $nama = str_replace(".jpeg", "", $nama);
                            $nama = $nama . "_" . $time . ".jpeg";
                        }
                    }

                    move_uploaded_file($asal, $namaFile);

                    $query = "UPDATE " . $this->table . " SET nama = :nama, password = :password, username = :username, email = :email, foto = :foto, nohp = :nohp, alamat = :alamat, facebook = :facebook, instagram = :instagram, pekerjaan = :pekerjaan WHERE id = :id";

                    $this->db->query($query);

                    $this->db->bind('nama', $data['nama']);
                    $this->db->bind('password', $password);
                    $this->db->bind('username', $username);
                    $this->db->bind('email', $data['email']);
                    $this->db->bind('foto', $nama);
                    $this->db->bind('nohp', $data['nohp']);
                    $this->db->bind('alamat', $data['alamat']);
                    $this->db->bind('facebook', $data['facebook']);
                    $this->db->bind('instagram', $data['instagram']);
                    $this->db->bind('pekerjaan', $data['pekerjaan']);
                    $this->db->bind('id', $_SESSION['id_user']);

                    $this->db->execute();

                    $_SESSION['nama'] = $data['nama'];
                    return $this->db->rowCount();
                }
            } else {
                if (!empty($hasilNama['user']['nama']) > 0) {
                    return 'namaada';
                } else {


                    $nama     = $_FILES['foto']['name'];
                    $asal = $_FILES['foto']['tmp_name'];
                    $namaFile = 'image/projek/' . basename($nama);
                    $time = time();

                    $ex = strtolower(pathinfo($nama, PATHINFO_EXTENSION));
                    if ($ex != "jpg" && $ex != "png" && $ex != "jpeg") {
                        return 0;
                    } else {
                        if (file_exists($namaFile)) {
                            if ($ex == "jpg") {
                                $namaFile = str_replace(".jpg", "", $namaFile);
                                $namaFile = $namaFile . "_" . $time . ".jpg";
                                $nama = str_replace(".jpg", "", $nama);
                                $nama = $nama . "_" . $time . ".jpg";
                            } else if ($ex == "png") {
                                $namaFile = str_replace(".png", "", $namaFile);
                                $namaFile = $namaFile . "_" . $time . ".png";
                                $nama = str_replace(".png", "", $nama);
                                $nama = $nama . "_" . $time . ".png";
                            } else if ($ex == "jpeg") {
                                $namaFile = str_replace(".jpeg", "", $namaFile);
                                $namaFile = $namaFile . "_" . $time . ".jpeg";
                                $nama = str_replace(".jpeg", "", $nama);
                                $nama = $nama . "_" . $time . ".jpeg";
                            }
                        }

                        move_uploaded_file($asal, $namaFile);

                        $query = "UPDATE " . $this->table . " SET nama = :nama, password = :password, username = :username, email = :email, foto = :foto, nohp = :nohp, alamat = :alamat, facebook = :facebook, instagram = :instagram, pekerjaan = :pekerjaan WHERE id = :id";

                        $this->db->query($query);

                        $this->db->bind('nama', $data['nama']);
                        $this->db->bind('password', $password);
                        $this->db->bind('username', $username);
                        $this->db->bind('email', $data['email']);
                        $this->db->bind('foto', $nama);
                        $this->db->bind('nohp', $data['nohp']);
                        $this->db->bind('alamat', $data['alamat']);
                        $this->db->bind('facebook', $data['facebook']);
                        $this->db->bind('instagram', $data['instagram']);
                        $this->db->bind('pekerjaan', $data['pekerjaan']);
                        $this->db->bind('id', $_SESSION['id_user']);

                        $this->db->execute();

                        $_SESSION['nama'] = $data['nama'];
                        return $this->db->rowCount();
                    }
                }
            }
        } else {
            if (!empty($hasilEmail['user']['email']) > 0) {
                return 'emailada';
            } else if (!empty($hasilNama['user']['nama']) > 0) {
                return 'namaada';
            } else {


                $nama     = $_FILES['foto']['name'];
                $asal = $_FILES['foto']['tmp_name'];
                $namaFile = 'image/projek/' . basename($nama);
                $time = time();

                $ex = strtolower(pathinfo($nama, PATHINFO_EXTENSION));
                if ($ex != "jpg" && $ex != "png" && $ex != "jpeg") {
                    return 0;
                } else {
                    if (file_exists($namaFile)) {
                        if ($ex == "jpg") {
                            $namaFile = str_replace(".jpg", "", $namaFile);
                            $namaFile = $namaFile . "_" . $time . ".jpg";
                            $nama = str_replace(".jpg", "", $nama);
                            $nama = $nama . "_" . $time . ".jpg";
                        } else if ($ex == "png") {
                            $namaFile = str_replace(".png", "", $namaFile);
                            $namaFile = $namaFile . "_" . $time . ".png";
                            $nama = str_replace(".png", "", $nama);
                            $nama = $nama . "_" . $time . ".png";
                        } else if ($ex == "jpeg") {
                            $namaFile = str_replace(".jpeg", "", $namaFile);
                            $namaFile = $namaFile . "_" . $time . ".jpeg";
                            $nama = str_replace(".jpeg", "", $nama);
                            $nama = $nama . "_" . $time . ".jpeg";
                        }
                    }

                    move_uploaded_file($asal, $namaFile);

                    $query = "UPDATE " . $this->table . " SET nama = :nama, password = :password, username = :username, email = :email, foto = :foto, nohp = :nohp, alamat = :alamat, facebook = :facebook, instagram = :instagram, pekerjaan = :pekerjaan WHERE id = :id";

                    $this->db->query($query);

                    $this->db->bind('nama', $data['nama']);
                    $this->db->bind('password', $password);
                    $this->db->bind('username', $username);
                    $this->db->bind('email', $data['email']);
                    $this->db->bind('foto', $nama);
                    $this->db->bind('nohp', $data['nohp']);
                    $this->db->bind('alamat', $data['alamat']);
                    $this->db->bind('facebook', $data['facebook']);
                    $this->db->bind('instagram', $data['instagram']);
                    $this->db->bind('pekerjaan', $data['pekerjaan']);
                    $this->db->bind('id', $_SESSION['id_user']);

                    $this->db->execute();

                    $_SESSION['nama'] = $data['nama'];
                    return $this->db->rowCount();
                }
            }
        }
    }

    public function settingNoPassWithphoto($data)
    {
        $username =  $this->slugify($data['nama']);

        $hasilEmail['user'] = $this->getUserByEmail($data['email']);
        $hasilNama['user'] = $this->getUserByNama($data['nama']);


        if ($hasilEmail['user']['id'] == $_SESSION['id_user']) {
            if ($hasilNama['user']['nama'] == $_SESSION['nama']) {
                $nama     = $_FILES['foto']['name'];
                $asal = $_FILES['foto']['tmp_name'];
                $namaFile = 'image/projek/' . basename($nama);
                $time = time();

                $ex = strtolower(pathinfo($nama, PATHINFO_EXTENSION));
                if ($ex != "jpg" && $ex != "png" && $ex != "jpeg") {
                    return 0;
                } else {
                    if (file_exists($namaFile)) {
                        if ($ex == "jpg") {
                            $namaFile = str_replace(".jpg", "", $namaFile);
                            $namaFile = $namaFile . "_" . $time . ".jpg";
                            $nama = str_replace(".jpg", "", $nama);
                            $nama = $nama . "_" . $time . ".jpg";
                        } else if ($ex == "png") {
                            $namaFile = str_replace(".png", "", $namaFile);
                            $namaFile = $namaFile . "_" . $time . ".png";
                            $nama = str_replace(".png", "", $nama);
                            $nama = $nama . "_" . $time . ".png";
                        } else if ($ex == "jpeg") {
                            $namaFile = str_replace(".jpeg", "", $namaFile);
                            $namaFile = $namaFile . "_" . $time . ".jpeg";
                            $nama = str_replace(".jpeg", "", $nama);
                            $nama = $nama . "_" . $time . ".jpeg";
                        }
                    }

                    move_uploaded_file($asal, $namaFile);

                    $query = "UPDATE " . $this->table . " SET nama = :nama, username = :username, email = :email, foto = :foto, nohp = :nohp, alamat = :alamat, facebook = :facebook, instagram = :instagram, pekerjaan = :pekerjaan WHERE id = :id";

                    $this->db->query($query);

                    $this->db->bind('nama', $data['nama']);
                    $this->db->bind('username', $username);
                    $this->db->bind('email', $data['email']);
                    $this->db->bind('foto', $nama);
                    $this->db->bind('nohp', $data['nohp']);
                    $this->db->bind('alamat', $data['alamat']);
                    $this->db->bind('facebook', $data['facebook']);
                    $this->db->bind('instagram', $data['instagram']);
                    $this->db->bind('pekerjaan', $data['pekerjaan']);
                    $this->db->bind('id', $_SESSION['id_user']);

                    $this->db->execute();

                    $_SESSION['nama'] = $data['nama'];
                    return $this->db->rowCount();
                }
            } else {
                if (!empty($hasilNama['user']['nama']) > 0) {
                    return 'namaada';
                } else {


                    $nama     = $_FILES['foto']['name'];
                    $asal = $_FILES['foto']['tmp_name'];
                    $namaFile = 'image/projek/' . basename($nama);
                    $time = time();

                    $ex = strtolower(pathinfo($nama, PATHINFO_EXTENSION));
                    if ($ex != "jpg" && $ex != "png" && $ex != "jpeg") {
                        return 0;
                    } else {
                        if (file_exists($namaFile)) {
                            if ($ex == "jpg") {
                                $namaFile = str_replace(".jpg", "", $namaFile);
                                $namaFile = $namaFile . "_" . $time . ".jpg";
                                $nama = str_replace(".jpg", "", $nama);
                                $nama = $nama . "_" . $time . ".jpg";
                            } else if ($ex == "png") {
                                $namaFile = str_replace(".png", "", $namaFile);
                                $namaFile = $namaFile . "_" . $time . ".png";
                                $nama = str_replace(".png", "", $nama);
                                $nama = $nama . "_" . $time . ".png";
                            } else if ($ex == "jpeg") {
                                $namaFile = str_replace(".jpeg", "", $namaFile);
                                $namaFile = $namaFile . "_" . $time . ".jpeg";
                                $nama = str_replace(".jpeg", "", $nama);
                                $nama = $nama . "_" . $time . ".jpeg";
                            }
                        }

                        move_uploaded_file($asal, $namaFile);

                        $query = "UPDATE " . $this->table . " SET nama = :nama, username = :username, email = :email, foto = :foto, nohp = :nohp, alamat = :alamat, facebook = :facebook, instagram = :instagram, pekerjaan = :pekerjaan WHERE id = :id";

                        $this->db->query($query);

                        $this->db->bind('nama', $data['nama']);
                        $this->db->bind('username', $username);
                        $this->db->bind('email', $data['email']);
                        $this->db->bind('foto', $nama);
                        $this->db->bind('nohp', $data['nohp']);
                        $this->db->bind('alamat', $data['alamat']);
                        $this->db->bind('facebook', $data['facebook']);
                        $this->db->bind('instagram', $data['instagram']);
                        $this->db->bind('pekerjaan', $data['pekerjaan']);
                        $this->db->bind('id', $_SESSION['id_user']);

                        $this->db->execute();

                        $_SESSION['nama'] = $data['nama'];
                        return $this->db->rowCount();
                    }
                }
            }
        } else {
            if (!empty($hasilEmail['user']['email']) > 0) {
                return 'emailada';
            } else if (!empty($hasilNama['user']['nama']) > 0) {
                return 'namaada';
            } else {


                $nama     = $_FILES['foto']['name'];
                $asal = $_FILES['foto']['tmp_name'];
                $namaFile = 'image/projek/' . basename($nama);
                $time = time();

                $ex = strtolower(pathinfo($nama, PATHINFO_EXTENSION));
                if ($ex != "jpg" && $ex != "png" && $ex != "jpeg") {
                    return 0;
                } else {
                    if (file_exists($namaFile)) {
                        if ($ex == "jpg") {
                            $namaFile = str_replace(".jpg", "", $namaFile);
                            $namaFile = $namaFile . "_" . $time . ".jpg";
                            $nama = str_replace(".jpg", "", $nama);
                            $nama = $nama . "_" . $time . ".jpg";
                        } else if ($ex == "png") {
                            $namaFile = str_replace(".png", "", $namaFile);
                            $namaFile = $namaFile . "_" . $time . ".png";
                            $nama = str_replace(".png", "", $nama);
                            $nama = $nama . "_" . $time . ".png";
                        } else if ($ex == "jpeg") {
                            $namaFile = str_replace(".jpeg", "", $namaFile);
                            $namaFile = $namaFile . "_" . $time . ".jpeg";
                            $nama = str_replace(".jpeg", "", $nama);
                            $nama = $nama . "_" . $time . ".jpeg";
                        }
                    }

                    move_uploaded_file($asal, $namaFile);

                    $query = "UPDATE " . $this->table . " SET nama = :nama, username = :username, email = :email, foto = :foto, nohp = :nohp, alamat = :alamat, facebook = :facebook, instagram = :instagram, pekerjaan = :pekerjaan WHERE id = :id";

                    $this->db->query($query);

                    $this->db->bind('nama', $data['nama']);
                    $this->db->bind('username', $username);
                    $this->db->bind('email', $data['email']);
                    $this->db->bind('foto', $nama);
                    $this->db->bind('nohp', $data['nohp']);
                    $this->db->bind('alamat', $data['alamat']);
                    $this->db->bind('facebook', $data['facebook']);
                    $this->db->bind('instagram', $data['instagram']);
                    $this->db->bind('pekerjaan', $data['pekerjaan']);
                    $this->db->bind('id', $_SESSION['id_user']);

                    $this->db->execute();

                    $_SESSION['nama'] = $data['nama'];
                    return $this->db->rowCount();
                }
            }
        }
    }

    public function settingWithPassnoFoto($data)
    {
        $password = password_hash($data['password'], PASSWORD_DEFAULT);
        $username =  $this->slugify($data['nama']);

        $hasilEmail['user'] = $this->getUserByEmail($data['email']);
        $hasilNama['user'] = $this->getUserByNama($data['nama']);

        if ($hasilEmail['user']['id'] == $_SESSION['id_user']) {
            if ($hasilNama['user']['nama'] == $_SESSION['nama']) {
                $query = "UPDATE " . $this->table . " SET nama = :nama, password = :password, username = :username, email = :email, nohp = :nohp, alamat = :alamat, facebook = :facebook, instagram = :instagram, pekerjaan = :pekerjaan WHERE id = :id";

                $this->db->query($query);

                $this->db->bind('nama', $data['nama']);
                $this->db->bind('password', $password);
                $this->db->bind('username', $username);
                $this->db->bind('email', $data['email']);
                $this->db->bind('nohp', $data['nohp']);
                $this->db->bind('alamat', $data['alamat']);
                $this->db->bind('facebook', $data['facebook']);
                $this->db->bind('instagram', $data['instagram']);
                $this->db->bind('pekerjaan', $data['pekerjaan']);
                $this->db->bind('id', $_SESSION['id_user']);

                $this->db->execute();

                $_SESSION['nama'] = $data['nama'];
                return $this->db->rowCount();
            } else {
                if (!empty($hasilNama['user']['nama']) > 0) {
                    return 'namaada';
                } else {


                    $query = "UPDATE " . $this->table . " SET nama = :nama, password = :password, username = :username, email = :email, nohp = :nohp, alamat = :alamat, facebook = :facebook, instagram = :instagram, pekerjaan = :pekerjaan WHERE id = :id";

                    $this->db->query($query);

                    $this->db->bind('nama', $data['nama']);
                    $this->db->bind('password', $password);
                    $this->db->bind('username', $username);
                    $this->db->bind('email', $data['email']);
                    $this->db->bind('nohp', $data['nohp']);
                    $this->db->bind('alamat', $data['alamat']);
                    $this->db->bind('facebook', $data['facebook']);
                    $this->db->bind('instagram', $data['instagram']);
                    $this->db->bind('pekerjaan', $data['pekerjaan']);
                    $this->db->bind('id', $_SESSION['id_user']);

                    $this->db->execute();

                    $_SESSION['nama'] = $data['nama'];
                    return $this->db->rowCount();
                }
            }
        } else {
            if (!empty($hasilEmail['user']['email']) > 0) {
                return 'emailada';
            } else if (!empty($hasilNama['user']['nama']) > 0) {
                return 'namaada';
            } else {


                $query = "UPDATE " . $this->table . " SET nama = :nama, password = :password, username = :username, email = :email, nohp = :nohp, alamat = :alamat, facebook = :facebook, instagram = :instagram, pekerjaan = :pekerjaan WHERE id = :id";

                $this->db->query($query);

                $this->db->bind('nama', $data['nama']);
                $this->db->bind('password', $password);
                $this->db->bind('username', $username);
                $this->db->bind('email', $data['email']);
                $this->db->bind('nohp', $data['nohp']);
                $this->db->bind('alamat', $data['alamat']);
                $this->db->bind('facebook', $data['facebook']);
                $this->db->bind('instagram', $data['instagram']);
                $this->db->bind('pekerjaan', $data['pekerjaan']);
                $this->db->bind('id', $_SESSION['id_user']);

                $this->db->execute();

                $_SESSION['nama'] = $data['nama'];
                return $this->db->rowCount();
            }
        }
    }

    public function settingNoPassnoFoto($data)
    {
        $username =  $this->slugify($data['nama']);

        $hasilEmail['user'] = $this->getUserByEmail($data['email']);
        $hasilNama['user'] = $this->getUserByNama($data['nama']);

        // die(empty($hasilNama['user']['nama']));
        // die();
        if ($hasilEmail['user']['id'] == $_SESSION['id_user']) {
            if ($hasilNama['user']['nama'] == $_SESSION['nama']) {
                $query = "UPDATE " . $this->table . " SET nama = :nama, username = :username, email = :email, nohp = :nohp, alamat = :alamat, facebook = :facebook, instagram = :instagram, pekerjaan = :pekerjaan WHERE id = :id";

                $this->db->query($query);

                $this->db->bind('nama', $data['nama']);
                $this->db->bind('username', $username);
                $this->db->bind('email', $data['email']);
                $this->db->bind('nohp', $data['nohp']);
                $this->db->bind('alamat', $data['alamat']);
                $this->db->bind('facebook', $data['facebook']);
                $this->db->bind('instagram', $data['instagram']);
                $this->db->bind('pekerjaan', $data['pekerjaan']);
                $this->db->bind('id', $_SESSION['id_user']);

                $this->db->execute();

                $_SESSION['nama'] = $data['nama'];
                return $this->db->rowCount();
            } else {
                if (!empty($hasilNama['user']['nama']) > 0) {
                    return 'namaada';
                } else {


                    $query = "UPDATE " . $this->table . " SET nama = :nama, username = :username, email = :email, nohp = :nohp, alamat = :alamat, facebook = :facebook, instagram = :instagram, pekerjaan = :pekerjaan WHERE id = :id";

                    $this->db->query($query);

                    $this->db->bind('nama', $data['nama']);
                    $this->db->bind('username', $username);
                    $this->db->bind('email', $data['email']);
                    $this->db->bind('nohp', $data['nohp']);
                    $this->db->bind('alamat', $data['alamat']);
                    $this->db->bind('facebook', $data['facebook']);
                    $this->db->bind('instagram', $data['instagram']);
                    $this->db->bind('pekerjaan', $data['pekerjaan']);
                    $this->db->bind('id', $_SESSION['id_user']);

                    $this->db->execute();

                    $_SESSION['nama'] = $data['nama'];
                    return $this->db->rowCount();
                }
            }
        } else {
            if (!empty($hasilEmail['user']['email']) > 0) {
                return 'emailada';
            } else if (!empty($hasilNama['user']['nama']) > 0) {
                return 'namaada';
            } else {

                $query = "UPDATE " . $this->table . " SET nama = :nama, username = :username, email = :email, nohp = :nohp, alamat = :alamat, facebook = :facebook, instagram = :instagram, pekerjaan = :pekerjaan WHERE id = :id";

                $this->db->query($query);

                $this->db->bind('nama', $data['nama']);
                $this->db->bind('username', $username);
                $this->db->bind('email', $data['email']);
                $this->db->bind('nohp', $data['nohp']);
                $this->db->bind('alamat', $data['alamat']);
                $this->db->bind('facebook', $data['facebook']);
                $this->db->bind('instagram', $data['instagram']);
                $this->db->bind('pekerjaan', $data['pekerjaan']);
                $this->db->bind('id', $_SESSION['id_user']);

                $this->db->execute();

                $_SESSION['nama'] = $data['nama'];
                return $this->db->rowCount();
            }
        }
    }

    public function DeleteUserUsr($id)
    {
        // die('masuk');
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";

        $this->db->query($query);
        $this->db->bind('id', $id);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function slugify($text)
    {
        // replace non letter or digits by -
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, '-');

        // remove duplicate -
        $text = preg_replace('~-+~', '-', $text);

        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }
}
