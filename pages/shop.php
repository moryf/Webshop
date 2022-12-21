<?php
session_start();
if (isset($_SESSION['user_id'])) {
} else {
    header('Location: login.php');
    exit;
}

require("../util/baza_conn.php");
require("../modeli/proizvod.php");
$query = "SELECT * FROM proizvodi";
$result = mysqli_query($conn, $query);

$products = array();

$id = $_SESSION['user_id'];

while ($row = mysqli_fetch_assoc($result)) {
  $product = new Proizvod($row['id'], $row['prodavnica'], $row['ime'], $row['cena'], $row['opis']);
  array_push($products, $product);
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../style/shop_style.css">  
    <link rel="stylesheet" type="text/css" href="../style/home_style.css"> 
    <title>Prodavnica</title>
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
  </div>


<div class="products">
  <h2>Proizvodi</h2>
  <div class="product-grid">
    <?php
    foreach ($products as $product) {
      echo '<div class="product-card">';
      echo '  <img src="../content/basket.png">';
      echo '  <h3>' . $product->ime . '</h3>';
      echo '  <p>' . $product->opis . '</p>';
      echo '  <p>' . $product->cena . '</p>';
      echo ' <input name="' . $product->id . '-prod-button" id="' . $product->id . '-prod-button" class="btn" type="button" value="Button"> ';
      echo '</div>';
    }
    ?>
  </div>
</div>

<div class="footer">
    <p>Copyright &copy; 2022 Food Web Shop. All rights reserved.</p>
  </div>
    
</body>
</html>