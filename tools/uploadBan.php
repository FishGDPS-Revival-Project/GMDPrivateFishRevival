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
echo "<h2>Upload ban a user</h2>";

include "../incl/lib/connection.php";
require_once "../incl/lib/mainLib.php";
$gs = new mainLib();
include "../incl/misc/DiscordWebhook.php";
include "../config/discord.php";

if (!empty($_POST["userID"])) {
  $userID = ($_POST["userID"]);
  $reason = ($_POST["reason"]);

  $query = $db->prepare("SELECT isCreatorBanned FROM users WHERE userID=$userID");
  $query->execute();
  $isCreatorBanned = $query->fetchColumn();

  if ($isCreatorBanned == 1) {
      exit("User is already upload banned.");
  }

  // userName (levelCreator)
    $query = $db->prepare("SELECT userName FROM levels WHERE userID=$userID");
    $query->execute();
    $userName = $query->fetchColumn();
    
    // MOD ACTION
$time = time();

$f = "INSERT INTO modactions (type, timestamp, user)
VALUES (3, $time, $userID)";

$query = $db->prepare($f);
$query->execute();


  $querytext = "UPDATE users SET isCreatorBanned = 1 WHERE users.userID = $userID";
  $query = $db->prepare($querytext);
  $query->execute();
  echo "Upload banned user!";
  echo "<br>";
  echo "<b>User ID</b>: $userID";
  
  # send webhook
  $dw = new discordWebhook($toolWebhook);
  $toolWebhook = $dw
            ->newMessage()
            ->setTitle("User upload banned!")
            ->addField("User", "**$userName**, User ID **$userID**")
            ->addField("Ban Reason", "$reason")
            ->setTimestamp()
            ->setColor("#ff0000")
            ->send();
} else {
  echo '<p>Ban a user from uploading levels using this tool.</p>
    <button class="w3-button w3-blue"><a href="uploadUnban.php">Want to upload unban a user?</a></button><br><br>
  <div class="w3-card-4">
  <div class="w3-container w3-blue">
    <h3>Upload Ban User</h3>
  </div>
  <form action="uploadBan.php" method="post" class="w3-container">
  <br>
        <label for="userID">UserID:</label> <input class="w3-input w3-border" type="number" id="userID" name="userID" placeholder="User ID"><br>
        <label for="reason">Reason:</label> <input class="w3-input w3-border" type="text" id="reason" name="reason" placeholder="Reason"><br>
		<input class="w3-btn w3-blue" type="submit" value="Ban" /><br><br></form></div>
		';
}
?>