<?php

class Proizvod{
    public $id;
    public $prodavnica;
    public $ime;
    public $cena;
    public $opis;

    public function __construct($id=null, $prodavnica=null, $ime=null, $cena=null, $opis=null)
    {
        $this->id=$id;
        $this->prodavnica=$prodavnica;
        $this->ime=$ime;
        $this->cena=$cena;
        $this->opis=$opis;
    }

    public static function ucitajSve($mysqli)
    {
            $query = "SELECT * FROM proizvodi";
            return $mysqli->query($query);
    }

    public static function pretragaPoProdavnici($mysqli,$idprod){
        $query="SELECT * FROM proizvodi WHERE prodavnica=$idprod";
        return $mysqli->http_build_query($query);
    }
}

?>