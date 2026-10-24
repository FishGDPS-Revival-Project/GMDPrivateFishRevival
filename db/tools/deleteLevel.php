<?php
include "../incl/web/navbar.php";
?>
<div class="w3-container">
<?php
session_start();
$admin = $_SESSION['admin'];
if (!$admin) {
    exit('Not logged in');
}
echo "<h2>Delete a level</h2>";

include "../incl/lib/connection.php";
require_once "../incl/lib/mainLib.php";
$gs = new mainLib();

if (!empty($_POST["levelID"])) {
  require "../incl/misc/rateToolPassword.php";
  $levelID = ($_POST["levelID"]);

  $query = $db->prepare("DELETE FROM levels WHERE levelID='$levelID'");
  $query->execute();
  echo "Level deleted!";
  echo "<br>";
  echo "<b>levelID</b>: $levelID";
  
  // run cron
  echo '<div style="display: none">';
  include "cron/fixcps.php";
  echo '</div>';
} else {
  echo '<p>Delete an existing level using this tool.</p>
  <div class="w3-card-4">
  <div class="w3-container w3-blue">
    <h3>Delete Level</h3>
  </div>
  <form action="deleteLevel.php" method="post" class="w3-container">
  <br>
  <label for="levelID">Level ID:</label>
		<input class="w3-input w3-border" type="number" id="levelID" name="levelID" placeholder="Level ID" min="1" max="10000" required><br>
        <input class="w3-check" type="checkbox" id="deleteConfirm" name="deleteConfirm" value="confirmed" required>
        <label for="deleteConfirm">Confirm that you want the level to be deleted</label><br>
		<input class="w3-btn w3-blue" type="submit" value="Delete" /><br><br></form></div>
		';
}
?>
</div>