<?php
class Prodavnica{

public $id;
public $ime;
public $adresa;
public $telefon;



public function __construct($id=null,$ime=null,$adresa=null,$telefon=null){
        $this->id=$id;
        $this->ime = $ime;
        $this->adresa = $adresa;
        $this->telefon = $telefon;
}

public static function ucitajSve()
{
        $query = "SELECT * FROM prodavnice";
                return $query; 
}

}


?>