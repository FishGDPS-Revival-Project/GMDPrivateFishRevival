<?php
include "../incl/web/navbar.php";
?>
<div class="w3-container">
<?php
echo "<h2>Log in</h2>";
$mod = false;
include "../incl/lib/connection.php";
require_once "../incl/lib/mainLib.php";
$gs = new mainLib();
session_start();
if($_SESSION['admin']) {
    exit("Already logged in.");
}
if (!empty($_POST["password"])) {
  require "../incl/misc/rateToolPassword.php";
  if (!password_verify($_POST["password"] ,$rateToolPassword)) {
    exit("Invalid password");
  }
echo 'Logged In';
  $_SESSION['admin'] = true;
  $_SESSION['state'] = 1;
  header("Location: ../tools");
    exit();
  // run cron
  echo '<div style="display: none">';
  echo '</div>';
} else {
  echo '<p>Login using a rate tool password.</p>
  <div class="w3-card-4">
  <div class="w3-container w3-blue">
    <h3>Login</h3>
  </div>
  <form action="modlogin.php" method="post" class="w3-container">
  <br>
        <label for="password">Password:</label>
		<input class="w3-input w3-border" type="password" id="password" name="password" placeholder="Rate tool password" required><br>
		<input class="w3-btn w3-blue" type="submit" value="Log In" /><br><br></form></div>
		';
}
if ($_SERVER['REQUEST_METHOD'] === 'DELETE' OR $_SERVER['REQUEST_METHOD'] === 'POST' OR $_SERVER['REQUEST_METHOD'] === 'PUT' OR $_SERVER['REQUEST_METHOD'] === 'PATCH') {
	if (!$mod) {
        header("HTTP/1.1 405 Method Not Allowed");
        exit("Unauthorized");
	}
    }

?>
</div>