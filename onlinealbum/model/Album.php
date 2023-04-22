<?php

class Album
{

    private $konekcija;
    private $tabela = "album";

    public $id;
    public $naziv_albuma;
    public $opis_albuma;

    public function __construct($konekcija)
    {
        $this->konekcija = $konekcija;
    }

    public function get()
    {
        $sql = "SELECT * FROM " . $this->tabela;

        $albumi = array();
        $rez = $this->konekcija->query($sql);

        if ($rez->num_rows > 0) {
            while ($row = $rez->fetch_assoc()) {
                array_push($albumi, $row);
            }
        }
        return $albumi;
    }
}
