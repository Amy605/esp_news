<?php
class Article {
    private $conn;

    public function __construct() {
        $this->conn = new mysqli("localhost", "mglsi_user", "passer", "mglsi_news");
        $this->conn->set_charset("utf8mb4");
        if ($this->conn->connect_error) {
            die("Erreur : " . $this->conn->connect_error);
        }
    }

    public function getTous($cat_id = null) {
        if ($cat_id) {
            $id = (int)$cat_id;
            $sql = "SELECT a.*, c.libelle FROM Article a
                    JOIN Categorie c ON a.categorie = c.id
                    WHERE a.categorie = $id
                    ORDER BY a.dateCreation DESC";
        } else {
            $sql = "SELECT a.*, c.libelle FROM Article a
                    JOIN Categorie c ON a.categorie = c.id
                    ORDER BY a.dateCreation DESC";
        }
        return $this->conn->query($sql);
    }

    public function getParId($id) {
        $id = (int)$id;
        $res = $this->conn->query("SELECT a.*, c.libelle FROM Article a
                                   JOIN Categorie c ON a.categorie = c.id
                                   WHERE a.id = $id");
        return $res->fetch_assoc();
    }

    public function getCategories() {
        return $this->conn->query("SELECT * FROM Categorie ORDER BY libelle");
    }
}
?>