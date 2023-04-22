<?php
require('../db/db.php');
require('../model/Korisnik.php');

$korisnik = new Korisnik($konekcija);
$korisnik->korisnicko_ime = $_GET['korisnicko_ime'];
$korisnik->sifra = $_GET['sifra'];
$k = $korisnik->login();
echo json_encode($k ? $k : false);
