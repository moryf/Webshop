<?php
class Proizvod{

public $id;
public $ime;
public $adresa;
public $telefon;

public static function ucitajSve($mysqli)
{
        $query = "SELECT * FROM prodavnice";
        return $mysqli->query($query);
}

}


?>