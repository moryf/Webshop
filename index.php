<?php
if (isset($_SESSION['user_id'])) {
    header('Location: /Web Shop/pages/homepage.php');
    exit;
} else {
    header('Location: /Web Shop/pages/login.php');
    exit;
}
?>