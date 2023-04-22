<?php
require('../db/db.php');
require('../model/Slika.php');

$slika = new Slika($konekcija);
$slika->id = $_POST['id'];
$error = false;
$errorPoruka = 'Greska kod izmene ';
if (isset($_POST['naziv'])) {
    $slika->naziv_slike = $_POST['naziv'];
    if (!$slika->izmenaNaziva()) {
        $error = true;
        $errorPoruka .= 'naziva';
    }
}

if ($error)
    $errorPoruka .= 'i ';

if (isset($_POST['opis'])) {
    $slika->opis_slike = $_POST['opis'];
    if (!$slika->izmenaOpisa()) {
        $errorPoruka .= 'opisa ';
    }
}

if ($error)
    echo $errorPoruka;
else echo "Uspesna izmena!";
