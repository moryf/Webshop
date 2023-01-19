<?php
session_start();
require("../util/baza_conn.php");
require("../modeli/proizvod.php");

$id = $_SESSION['user_id'];
$product_id = $_SESSION['order'];

$query = "SELECT * FROM proizvodi WHERE id=$product_id";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

$product = new Proizvod($row['id'], $row['prodavnica'], $row['ime'], $row['cena'], $row['opis']);

if (isset($_POST['submit'])) {
    $product_id = $_POST['product_id'];
  
    $query = "INSERT INTO porudzbine VALUES ($id,$product_id)";
    $result = mysqli_query($conn,$query);
  
      header('Location: shop.php');
      exit;
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
    <h1>Potvrdite Porudžbinu</h1>
    <div class="product-grid">
    <?php
    echo '<div class="product-card">';
    echo '  <img src="../content/basket.png">';
    echo '  <h3>' . $product->ime . '</h3>';
    echo '  <p>' . $product->opis . '</p>';
    echo '  <p>' . $product->cena . '</p>';
    echo '  <form method="post">';
    echo '    <input type="hidden" name="product_id" value="' . $product->id . '">';
    echo '    <input type="submit" class="btn" name="submit" value="Confirm order">';
    echo '  </form>';
    echo '</div>';
    
    ?>
    </div>
    
</body>
</html>