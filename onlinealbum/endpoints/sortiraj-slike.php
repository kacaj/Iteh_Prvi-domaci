<?php
require('../db/db.php');
require('../model/Slika.php');

$slika = new Slika($konekcija);

echo json_encode($slika->sortiraj($_GET['kolona'], $_GET['direction']));
