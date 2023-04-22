<?php

class Slika
{

    private $konekcija;
    private $tabela = "slike";

    public $id;
    public $naziv_slike;
    public $opis_slike;
    public $id_album;
    public $img_path;

    public function __construct($konekcija)
    {
        $this->konekcija = $konekcija;
    }

    public function get()
    {
        $sql = "SELECT slike.*, a.id AS _id, a.naziv_albuma, a.opis_albuma FROM " . $this->tabela . " JOIN album a ON slike.id_album = a.id";

        $slike = array();
        $res = $this->konekcija->query($sql);

        if ($res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                array_push($slike, $row);
            }
        }
        return $slike;
    }

    public function sortiraj($kolona, $direction)
    {
        $sql = "SELECT slike.*, a.id AS _id, a.naziv_albuma FROM " . $this->tabela . "
            JOIN album a ON slike.id_album = a.id 
            ORDER BY `$kolona` $direction";
        $slike = array();
        $res = $this->konekcija->query($sql);

        if ($res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                array_push($slike, $row);
            }
        }
        return $slike;
    }

    public function dodaj()
    {
        $sql = "INSERT INTO " . $this->tabela . " (naziv_slike, opis_slike, id_album, img_path)
        VALUES ('" . $this->naziv_slike . "', '" . $this->opis_slike . "', " . $this->id_album . ", '$this->img_path')";
        if ($this->konekcija->query($sql)) {
            return true;
        }

        return false;
    }

    public function brisanje()
    {
        $sql = "DELETE FROM " . $this->tabela . " WHERE id = " . $this->id;
        if ($this->konekcija->query($sql)) {
            return "Uspesno obrisano";
        }
        return "Doslo je do greske";
    }

    public function izmenaNaziva()
    {
        $sql = "UPDATE " . $this->tabela . " SET naziv_slike = '$this->naziv_slike' WHERE id = " . $this->id;
        if ($this->konekcija->query($sql)) {
            return true;
        }
        return false;
    }

    public function izmenaOpisa()
    {
        $sql = "UPDATE " . $this->tabela . " SET opis_slike = '$this->opis_slike' WHERE id = " . $this->id;
        if ($this->konekcija->query($sql)) {
            return true;
        }
        return false;
    }
}
