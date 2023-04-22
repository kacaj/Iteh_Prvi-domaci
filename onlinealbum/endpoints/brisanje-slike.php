<?php
require('../db/db.php');
require('../model/Slika.php');

$slika = new Slika($konekcija);
$slika->id = $_GET['id'];

echo json_encode($slika->brisanje());
