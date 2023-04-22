<?php

class Korisnik
{

    private $konekcija;
    private $tabela = "korisnik";

    public $id;
    public $korisnicko_ime;
    public $sifra;

    public function __construct($konekcija)
    {
        $this->konekcija = $konekcija;
    }


    public function login()
    {
        $sql = "SELECT * FROM " . $this->tabela . " WHERE korisnicko_ime = '$this->korisnicko_ime' AND sifra = '$this->sifra'";

        if ($rez = $this->konekcija->query($sql)) {

            $korisnik = $rez->fetch_assoc();
            return $korisnik;
        }
        return null;
    }
}
