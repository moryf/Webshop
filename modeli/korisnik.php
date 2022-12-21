<?php

class Korisnik
{
public $id;
public $email;
public $password;

public function __construct($id=null, $email=null, $password=null)
{
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
}

public static function logovanjeKorisnika($korisnik, mysqli $conn)
    {
        $email = $korisnik->email;
        $password = $korisnik->password;
        $query = "SELECT * FROM korisnici WHERE email='$korisnik->email' and password='$korisnik->password'";
        return $query;
    }


}

?>