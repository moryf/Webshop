<?php
session_start();
if (isset($_SESSION['user_id'])) {
} else {
    header('Location: login.php');
    exit;
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../style/home_style.css">
    <title>Shop</title>
</head>
<body>
<div class="menu">
  <div class="logo">
    <img src="../content/logo.png" alt="Food Web Shop logo">
  </div>
    <a href="homepage.php">Home</a> |
    <a href="shop.php">Prodavnica</a> |
    <a href="#">O nama</a> |
    <a href="#">Kontakt</a>
    <a href ="my_orders.php">Moje porudzbine</a>
  </div>

  <div class="main">
    <h1>Dobrodošli na Good Spirit</h1>
    <div class="telo">
        <div class="tekst1">
            <h1>
                Good Spirit
            </h1>
            <h2>
                saznajte vise o nasoj viziji
            </h2>
           <a href="/Projekat/html/o-nama.html">
               <div  class="dugme">
               o nama
                </div> 
            </a>
        </div>
        <div class="tekst2">
            <h1>
                Čuvamo planetu.
            </h1>
            <h1>
                pomažemo ljudima u nevolji.
            </h1>
            <h2>
                budimo ekonomični.
            </h2>
            <ul>
                <li>Više od 900 miliona tona hrane se baci u svetu svake godine.</li>
                <li>čak 17 odsto hrane koja pronalazi put do potrošača putem prodavnica i restorana završi u kanti za smeće.</li>
                <li>Oko 60 odsto hrane baci se kod kuće.</li>
            </ul>
        </div>
        <div class="slike">

        </div>
    </div>
  </div>

  <div class="footer">
    <p>Copyright &copy; 2022 Food Web Shop. All rights reserved.</p>
  </div>
</body>
</html>
