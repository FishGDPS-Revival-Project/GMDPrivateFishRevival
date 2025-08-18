<?php
include '../incl/web/navbar.php';
if ($_SERVER['REQUEST_METHOD'] === 'DELETE' OR $_SERVER['REQUEST_METHOD'] === 'POST' OR $_SERVER['REQUEST_METHOD'] === 'PUT' OR $_SERVER['REQUEST_METHOD'] === 'PATCH') {
        header("HTTP/1.1 405 Method Not Allowed");
        exit("Unauthorized");
    }

session_start();
if (!$_SESSION['admin']) {
    exit('Not logged in');
} else {
$_SESSION['admin'] = false;
echo '<h1><b>Logged out</b></h1>';
echo 'Succesfully logged out';
  $_SESSION['state'] = 2;
  header("Location: ../tools");
    exit();
}
?>