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
echo "<h2>Leaderboard unban a user</h2>";

include "../incl/lib/connection.php";
require_once "../incl/lib/mainLib.php";
$gs = new mainLib();

if (!empty($_POST["userID"])) {
  $userID = ($_POST["userID"]);

  $query = $db->prepare("SELECT isLeaderboardBanned FROM users WHERE userID=$userID");
  $query->execute();
  $isLeaderboardBanned = $query->fetchColumn();
  
  if ($isLeaderboardBanned == 0) {
      exit("User is already leaderboard unbanned.");
  }
  
  $querytext = "UPDATE users SET isLeaderboardBanned = 0 WHERE users.userID = $userID";
  $query = $db->prepare($querytext);
  $query->execute();
  echo "Leaderboard unbanned user!";
  echo "<br>";
  echo "<b>User ID</b>: $userID";
} else {
  echo '<p>Ban a user from the leaderboards using this tool.</p>
    <button class="w3-button w3-blue"><a href="leaderboardBan.php">Want to leaderboard ban a user?</a></button><br><br>
  <div class="w3-card-4">
  <div class="w3-container w3-blue">
    <h3>Leaderboard Unban User</h3>
  </div>
  <form action="leaderboardUnban.php" method="post" class="w3-container">
  <br>
        <label for="userID">UserID:</label> <input class="w3-input w3-border" type="number" id="userID" name="userID" placeholder="User ID"><br>
		<input class="w3-btn w3-blue" type="submit" value="Unban" /><br><br></form></div>
		';
}
?>