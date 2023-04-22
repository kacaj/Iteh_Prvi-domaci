<?php
require('../db/db.php');
require('../model/Slika.php');

$allowedExts = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp); // jpg
if ((($_FILES["file"]["type"] == "image/gif")
        || ($_FILES["file"]["type"] == "image/jpeg")
        || ($_FILES["file"]["type"] == "image/jpg")
        || ($_FILES["file"]["type"] == "image/pjpeg")
        || ($_FILES["file"]["type"] == "image/x-png")
        || ($_FILES["file"]["type"] == "image/png"))
    && ($_FILES["file"]["size"] < 200000)
    && in_array($extension, $allowedExts)
) {
    if ($_FILES["file"]["error"] > 0) {
        echo "Doslo je do greske prilikom upload-a slike.";
    } else {
        $filename = $_POST['naziv'] . "." . $extension;

        if (file_exists("../img/" . $filename)) {
            echo $filename . " vec postoji. ";
        } else {
            move_uploaded_file(
                $_FILES["file"]["tmp_name"],
                "../img/" . $filename
            );
            $slika = new Slika($konekcija);
            $slika->img_path = $filename;
            $slika->id_album = $_POST['id_album'];
            $slika->naziv_slike = $_POST['naziv'];
            $slika->opis_slike = $_POST['opis'];
            if ($slika->dodaj())
                echo "Uspesno dodata nova slika.";
            else echo "Nepoznata greska prilikom dodavanja slike.";
        }
    }
} else {
    echo "Ovaj format slike nije podrzan.";
}
