<?php

/**
 * 
 */
class Provinsi_Model
{
    private $table = 'provinsi';
    private $db;

    function __construct()
    {
        $this->db = new Database;
    }

    public function getAllProvinsi()
    {
        $this->db->query('SELECT * FROM ' . $this->table);
        return $this->db->resultSet();
    }
    public function getProvinsiById($id)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id=:id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }
    public function getProvinsiByNama($nama)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE nama=:nama');
        $this->db->bind('nama', $nama);
        return $this->db->single();
    }
    //
    public function addProvinsi($data)
    {
        $hasilProvinsi['provinsi'] = $this->getProvinsiByNama($data['provinsi']);
        if (!empty($hasilProvinsi['provinsi']['nama']) > 0) {
            return 'provinsiada';
        } else {
            $query = "INSERT INTO " . $this->table . "(nama) VALUES (:nama)";
            $this->db->query($query);
            $this->db->bind('nama', $data['provinsi']);
            $this->db->execute();
            return $this->db->rowCount();
        }
    }
    public function updateProvinsi($data)
    {
        $query = 'UPDATE ' . $this->table . " SET nama = :nama WHERE id = :id";

        $this->db->query($query);
        $this->db->bind('nama', $data['provinsi']);
        $this->db->bind('id', $data['id']);

        $this->db->execute();

        return $this->db->rowCount();
    }
    public function destroyProvinsi($id)
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
}
