<?php
session_start();

if (isset($_SESSION['user_id'])) {
} else {
    header('Location: login.php');
    exit;
}

require("../util/baza_conn.php");
require("../modeli/proizvod.php");
require("../modeli/porudzbina.php");
$id = $_SESSION['user_id'];

$result = mysqli_query($conn, Porudzbina::porudzbineKorisnika($id));

$porudzbine = array();

while ($row = mysqli_fetch_assoc($result)) {
  $product = new Proizvod($row['idproizvoda'],$row['ime_prodavnice'],$row['ime'],$row['cena']);
  array_push($porudzbine, $product);
}

if (isset($_POST['submit'])) {
    $product_id = $_POST['product_id'];

    $result=mysqli_query($conn, Porudzbina::otkaziPorudzbinu($_SESSION['user_id'],$product_id));
    header('Location: my_orders.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../style/shop_style.css">  
    <link rel="stylesheet" type="text/css" href="../style/home_style.css"> 
    <title>Document</title>
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
<div class="products">
  <h2>Porudzbine</h2>
  <div class="product-grid">
    <?php
    foreach ($porudzbine as $porudzbina) {
      echo '<div class="product-card">';
      echo '  <img src="../content/basket.png">';
      echo '  <h3>' . $porudzbina->ime . '</h3>';
      echo '    <h2>'.$porudzbina->prodavnica.'</h2>';
      echo '  <p>' . $porudzbina->cena . '</p>';
      echo '  <form method="post">';
      echo '    <input type="hidden" name="product_id" value="' . $porudzbina->id . '">';
      echo '    <input type="submit" class="btn" name="submit" value="Otkazi porudzbinu">';
      echo '  </form>';
      echo '</div>';
    }
    ?>
  </div>
</div>
    
</body>
