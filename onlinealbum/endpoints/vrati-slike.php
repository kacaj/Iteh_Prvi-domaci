<?php
require('../db/db.php');
require('../model/Slika.php');

$slike = new Slika($konekcija);

echo json_encode($slike->get());
