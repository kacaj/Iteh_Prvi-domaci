<?php
$server = "localhost";
$korisnickoime = "root";
$sifra = "";
$baza = "onlinealbum";

$konekcija = new mysqli($server, $korisnickoime, $sifra, $baza);

if ($konekcija->connect_error) {
    die("Connection failed: " . $konekcija->connect_error);
}
