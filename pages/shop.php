<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
<script>
$(document).ready(function(){
   $("#filterForm").submit(function(event){
      event.preventDefault();
      var formData = $(this).serialize();
      $.ajax({
        type: "POST",
        url: "../util/filter_products.php",
        data: formData,
        success: function(data) {
           $('.product-grid').html(data);
        }
      });
   });
});
</script>

<script>
$(document).ready(function(){
   $("#sortForm").submit(function(event){
      event.preventDefault();
      var formData = $(this).serialize();
      $.ajax({
        type: "POST",
        url: "../util/sort_products.php",
        data: formData,
        success: function(data) {
           $('.product-grid').html(data);
        }
      });
   });
});
</script>

<script>
  $(document).ready(function() {
  $("#searchTerm").on("keyup", function() {
    var searchTerm = $(this).val();
    if (searchTerm.length > 2) {
      $.ajax({
        type: "POST",
        url: "../util/search.php",
        data: { searchTerm: searchTerm },
        success: function(data) {
          $('.product-grid').html(data);
        }
      });
    }
  });
});

</script>

<?php
session_start();

if (isset($_SESSION['user_id'])) {
} else {
    header('Location: login.php');
    exit;
}

require("../util/baza_conn.php");
require("../modeli/proizvod.php");
require("../modeli/prodavnica.php");
$query = "SELECT * FROM proizvodi";
$result = mysqli_query($conn, $query);

$products = array();

$id = $_SESSION['user_id'];

while ($row = mysqli_fetch_assoc($result)) {
  $product = new Proizvod($row['id'], $row['prodavnica'], $row['ime'], $row['cena'], $row['opis']);
  array_push($products, $product);
}

$prodavnice = array();
$result=mysqli_query($conn,Prodavnica::ucitajSve());

while ($row = mysqli_fetch_assoc($result)) {
  $prodavnica = new Prodavnica($row['id'],$row['ime'],$row['adresa'],$row['telefon']);
  array_push($prodavnice, $prodavnica);
}

if (isset($_POST['submit'])) {
  $product_id = $_POST['product_id'];

  $query = "SELECT * FROM proizvodi WHERE id = $product_id";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_assoc($result);

  $product = new Proizvod($row['id'], $row['prodavnica'], $row['ime'], $row['cena'], $row['opis']);

  $_SESSION['order'] = $product->id;

    header('Location: order.php');
    exit;
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
    <a href ="my_orders.php">Moje porudzbine</a>
  </div>


<div class="products">
  <h2>Proizvodi</h2>
  <div>
    <p>Flitriraj po prodavnici</p>
    <?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $selected = $_POST['filter_prod'];
} else {
    echo "<form id='filterForm' method='post'>";
    echo "<select name='filter_prod'>";
    foreach ($prodavnice as $prodavnica) {
        echo "<option value='$prodavnica->id'>$prodavnica->ime</option>";
    }
    echo "</select>";
    echo "<input type='submit' class='btn' value='Filtriraj'/>";
    echo "</form>";
}
?>
<form id="sortForm" method="post">
  <select name="sort_by">
    <option value="asc">Rastuce</option>
    <option value="desc">Opadajuce</option>
  </select>
  <input type="submit" name="submit" value="Sortiraj">
</form>
<form id="searchForm">
  <input type="text" id="searchTerm" placeholder="Search...">
</form>
<div id="searchResults"></div>

  </div>
  <div class="product-grid">
    <?php
    foreach ($products as $product) {
      echo '<div class="product-card">';
      echo '  <img src="../content/basket.png">';
      echo '  <h3>' . $product->ime . '</h3>';
      echo '  <p>' . $product->opis . '</p>';
      echo '  <p>' . $product->cena . '</p>';
      echo '  <form method="post">';
      echo '    <input type="hidden" name="product_id" value="' . $product->id . '">';
      echo '    <input type="submit" class="btn" name="submit" value="Add to Order">';
      echo '  </form>';
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