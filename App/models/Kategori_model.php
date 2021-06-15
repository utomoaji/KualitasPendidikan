<?php

/**
 * 
 */
class Kategori_Model
{
    private $table = 'kategori';
    private $db;

    function __construct()
    {
        $this->db = new Database;
    }

    public function getAllKategori()
    {
        $this->db->query('SELECT * FROM ' . $this->table);
        return $this->db->resultSet();
    }
    public function getKategoriById($id)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id=:id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }
    public function getNamaKategoriById($id)
    {
        $this->db->query('SELECT nama FROM ' . $this->table . ' WHERE id=:id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }
    public function getKategoriByNama($nama)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE nama=:nama');
        $this->db->bind('nama', $nama);
        return $this->db->single();
    }
    //
    public function addKategori($data)
    {
        $hasilKategori['kategori'] = $this->getKategoriByNama($data['kategori']);
        if (!empty($hasilKategori['kategori']['nama']) > 0) {
            return 'kategoriada';
        } else {
            $query = "INSERT INTO " . $this->table . "(nama) VALUES (:nama)";
            $this->db->query($query);
            $this->db->bind('nama', $data['kategori']);
            $this->db->execute();
            return $this->db->rowCount();
        }
    }
    public function updateKategori($data)
    {
        $query = 'UPDATE ' . $this->table . " SET nama = :nama WHERE id = :id";

        $this->db->query($query);
        $this->db->bind('nama', $data['kategori']);
        $this->db->bind('id', $data['id']);

        $this->db->execute();

        return $this->db->rowCount();
    }
    public function destroyKategori($id)
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
