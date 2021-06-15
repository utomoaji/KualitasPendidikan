<?php

require '../vendor/autoload.php';
require_once 'Provinsi_model.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
// use Provinsi_Model as ModelProvinsi;

/**
 * 
 */
class SDGS_Model
{
    private $table = 'sdgs';
    private $db;

    function __construct()
    {
        $this->db = new Database;
    }

    public function getAllSDGS()
    {
        $this->db->query('SELECT kategori.nama as nama_kategori, provinsi.nama as nama_provinsi, sdgs.* FROM ' . $this->table . ' INNER JOIN kategori ON sdgs.kategori_id = kategori.id INNER JOIN provinsi ON sdgs.provinsi_id = provinsi.id');
        return $this->db->resultSet();
    }
    public function getSDGSById($id)
    {
        $this->db->query('SELECT kategori.nama as nama_kategori, provinsi.nama as nama_provinsi, sdgs.* FROM ' . $this->table . ' INNER JOIN kategori ON sdgs.kategori_id = kategori.id INNER JOIN provinsi ON sdgs.provinsi_id = provinsi.id WHERE sdgs.id=:id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }
    public function getSDGSByUserID($user_id)
    {
        $this->db->query('SELECT kategori.nama as nama_kategori, provinsi.nama as nama_provinsi, sdgs.* FROM ' . $this->table . ' INNER JOIN kategori ON sdgs.kategori_id = kategori.id INNER JOIN provinsi ON sdgs.provinsi_id = provinsi.id WHERE user_id=:user_id');
        $this->db->bind('user_id', $user_id);
        return $this->db->single();
    }
    public function getSDGSByProvinsiId($provinsi_id)
    {
        $this->db->query('SELECT sdgs.* FROM ' . $this->table . ' INNER JOIN kategori ON sdgs.kategori_id = kategori.id INNER JOIN provinsi ON sdgs.provinsi_id = provinsi.id WHERE provinsi_id=:provinsi_id');
        $this->db->bind('provinsi_id', $provinsi_id);
        return $this->db->single();
    }
    public function getSDGSByKategoriId($kategori_id)
    {
        $this->db->query('SELECT sdgs.* FROM ' . $this->table . ' INNER JOIN kategori ON sdgs.kategori_id = kategori.id INNER JOIN provinsi ON sdgs.provinsi_id = provinsi.id WHERE kategori_id=:kategori_id');
        $this->db->bind('kategori_id', $kategori_id);
        return $this->db->single();
    }
    public function getSDGSByKategoriProvinsiTahun($kategori_id, $provinsi_id, $tahun)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE tahun=:tahun AND kategori_id=:kategori_id AND provinsi_id=:provinsi_id');
        $this->db->bind('kategori_id', $kategori_id);
        $this->db->bind('provinsi_id', $provinsi_id);
        $this->db->bind('tahun', $tahun);
        return $this->db->single();
    }
    public function addSDGS($data)
    {
        $hasil['res'] = $this->getSDGSByKategoriProvinsiTahun($data['kategori'], $data['provinsi'], $data['tahun']);
        if (!empty($hasil['res']) > 0) {
            return 'dataada';
        } else {
            $query = "INSERT INTO " . $this->table . "(nilai, provinsi_id, kategori_id, user_id, tahun) VALUES (:nilai, :provinsi_id, :kategori_id, :user_id, :tahun)";
            $this->db->query($query);
            $this->db->bind('nilai', $data['nilai']);
            $this->db->bind('provinsi_id', $data['provinsi']);
            $this->db->bind('kategori_id', $data['kategori']);
            $this->db->bind('user_id', $_SESSION['id_user']);
            $this->db->bind('tahun', $data['tahun']);
            $this->db->execute();
            return $this->db->rowCount();
        }
    }
    public function updateSDGS($data)
    {
        $query = 'UPDATE ' . $this->table . " SET nilai = :nilai, provinsi_id = :provinsi_id, kategori_id = :kategori_id WHERE id = :id";

        $this->db->query($query);
        $this->db->bind('nilai', $data['nilai']);
        $this->db->bind('provinsi_id', $data['provinsi']);
        $this->db->bind('kategori_id', $data['kategori']);
        $this->db->bind('id', $data['idsdgs']);

        $this->db->execute();

        return $this->db->rowCount();
    }
    public function updateKategoriSDGS($data)
    {
        $query = 'UPDATE ' . $this->table . " SET kategori_id = :kategori_id WHERE id = :id";

        $this->db->query($query);
        $this->db->bind('kategori_id', $data['kategori']);
        $this->db->bind('id', $data['idsdgs']);

        $this->db->execute();

        return $this->db->rowCount();
    }
    public function updateProvinsiSDGS($data)
    {
        $query = 'UPDATE ' . $this->table . " SET provinsi_id = :provinsi_id WHERE id = :id";

        $this->db->query($query);
        $this->db->bind('provinsi_id', $data['provinsi']);
        $this->db->bind('id', $data['idsdgs']);

        $this->db->execute();

        return $this->db->rowCount();
    }
    public function updateNilaiSDGS($data)
    {
        $query = 'UPDATE ' . $this->table . " SET nilai = :nilai WHERE id = :id";

        $this->db->query($query);
        $this->db->bind('nilai', $data['nilai']);
        $this->db->bind('id', $data['idsdgs']);

        $this->db->execute();

        return $this->db->rowCount();
    }
    public function updateWitoutNilaiSDGS($data)
    {
        $query = 'UPDATE ' . $this->table . " SET provinsi_id = :provinsi_id, kategori_id = :kategori_id WHERE id = :id";

        $this->db->query($query);
        $this->db->bind('provinsi_id', $data['provinsi']);
        $this->db->bind('kategori_id', $data['kategori']);
        $this->db->bind('id', $data['idsdgs']);

        $this->db->execute();

        return $this->db->rowCount();
    }
    public function updateWitoutKategoriSDGS($data)
    {
        $query = 'UPDATE ' . $this->table . " SET provinsi_id = :provinsi_id, nilai = :nilai WHERE id = :id";

        $this->db->query($query);
        $this->db->bind('provinsi_id', $data['provinsi']);
        $this->db->bind('kategori_id', $data['kategori']);
        $this->db->bind('id', $data['idsdgs']);

        $this->db->execute();

        return $this->db->rowCount();
    }
    public function updateWitoutProvinsiSDGS($data)
    {
        $query = 'UPDATE ' . $this->table . " SET kategori_id = :kategori_id, nilai = :nilai WHERE id = :id";

        $this->db->query($query);
        $this->db->bind('provinsi_id', $data['provinsi']);
        $this->db->bind('kategori_id', $data['kategori']);
        $this->db->bind('id', $data['idsdgs']);

        $this->db->execute();

        return $this->db->rowCount();
    }
    public function destroySDGS($id)
    {
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

    public function proses($data)
    {
        $provinsiModel = new Provinsi_Model();
        $file_mimes = array('application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        if (isset($_FILES['sdgs']['name']) && in_array($_FILES['sdgs']['type'], $file_mimes)) {

            $arr_file = explode('.', $_FILES['sdgs']['name']);
            $extension = end($arr_file);

            if ('csv' == $extension) {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
            } else {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }

            $spreadsheet = $reader->load($_FILES['sdgs']['tmp_name']);
            $sheetData = $spreadsheet->getActiveSheet()->toArray();

            for ($i = 1; $i < count($sheetData); $i++) {
                $provinsi = $provinsiModel->getProvinsiByNama($sheetData[$i][0]);

                $exist = $this->getSDGSByKategoriProvinsiTahun($data['kategori'], $provinsi['id'], $sheetData[$i][2]);
                if ($exist) {
                    return 'dataada';
                } else {
                    if ($provinsi) {

                        $hasil['provinsi'] = $provinsiModel->getProvinsiByNama($sheetData[$i][0]);

                        $data['nilai'] = $sheetData[$i][1];
                        $data['kategori'] = $data['kategori'];
                        $data['provinsi'] = $hasil['provinsi']['id'];
                        $data['tahun'] = $sheetData[$i][2];

                        $this->addSDGS($data);
                    } else {
                        $sheet['provinsi'] = $sheetData[$i][0];
                        $provinsiModel->addProvinsi($sheet);
                        $hasil['provinsi'] = $provinsiModel->getProvinsiByNama($sheetData[$i][0]);

                        $data['tahun'] = $sheetData[$i][2];
                        $data['nilai'] = $sheetData[$i][1];
                        $data['kategori'] = $data['kategori'];
                        $data['provinsi'] = $hasil['provinsi']['id'];

                        $this->addSDGS($data);
                    }
                }
            }
            return 1;
        }
    }
}
