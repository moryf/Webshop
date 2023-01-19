<?php
session_start();

require("../util/baza_conn.php");
require("../modeli/korisnik.php");

// Check if the login form has been submitted
if (isset($_POST['email']) && isset($_POST['password'])) {
    // Get the email and password from the form
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $korisnik = new Korisnik(null, $email, $password);
    // Perform a SQL query to retrieve the user's information from the database
    $query = Korisnik::logovanjeKorisnika($korisnik,$conn);
    $result = mysqli_query($conn, $query);
  
    // Check if the query returned a result
    if (mysqli_num_rows($result) == 1) {
      // If a match is found, create a new User object and log the user in
      $row = mysqli_fetch_assoc($result);
      $korisnik->id=$row['id'];
      $_SESSION['user_id'] = $korisnik->id;
      header('Location: ../pages/homepage.php');
      exit;
    }
  
    // If no match is found, display an error message
    $error_message = 'Invalid email or password';
  }
  
  // Close the database connection
  mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../style/home_style.css">
    <title>Log in</title>
</head>
<body>
<form method="post" action="login.php">
  <label for="email">Email:</label><br>
  <input type="email" name="email" id="email"><br>
  <label for="password">Password:</label><br>
  <input type="password" name="password" id="password"><br>
  <input type="submit" value="Log In">
</form>
</body>
</html>