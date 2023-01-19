<?php

class Porudzbina{
    public $korinsik;
    public $proizvod;

    public static function porudzbineKorisnika($idkorisnika){
        $query = "SELECT por.korisnik_id AS korisnik,(SELECT prod.ime FROM prodavnice AS prod WHERE prod.id=p.prodavnica) AS ime_prodavnice , p.ime AS ime ,p.cena AS cena, p.id AS idproizvoda  FROM `porudzbine` AS por, proizvodi AS p WHERE por.proizvod_id=p.id AND por.korisnik_id=$idkorisnika";
        return $query;
    }

    public function novaPorudzbina($mysqli, $korinsik,$proizvod){

        $query = "INSERT INTO `porudzbine`(`korisnik_id`, `proizvod_id`) VALUES ($korinsik,$proizvod)";
        $mysqli->query($query);

    }

    public static function otkaziPorudzbinu($idkorisnika,$idproizvoda){
        $query = "DELETE FROM `porudzbine` WHERE korisnik_id=$idkorisnika AND proizvod_id=$idproizvoda";
        return $query;
    }
}

?>