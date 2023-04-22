<?php
require('../db/db.php');
require('../model/Album.php');

$albumi = new Album($konekcija);

echo json_encode($albumi->get());
