<?php 
require("baza_conn.php");
require("../modeli/proizvod.php");

$selected = $_POST['filter_prod'];

$query = "SELECT * FROM proizvodi WHERE prodavnica = '$selected'";
$result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($result)) {
  $product = new Proizvod($row['id'], $row['prodavnica'], $row['ime'], $row['cena'], $row['opis']);
    echo '<div class="product-grid">';
  echo '<div class="product-card">';
  echo '  <img src="../content/basket.png">';
  echo "<h3>".$product->ime."</h3>";
  echo "<p>".$product->opis."</p>";
  echo "<p>Cena: ".$product->cena."</p>";
  echo "<form method='post'>";
  echo "<input type='hidden' name='product_id' value='".$product->id."'/>";
  echo "<input class='btn' type='submit' name='submit' value='Poruci'/>";
  echo "</form>";
  echo "</div>";
  echo "</div>";

}
mysqli_close($conn);
?>
