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
echo "<h2>Upload unban a user</h2>";

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
  
  if ($isCreatorBanned == 0) {
      exit("User is already upload unbanned.");
  }
  
  // userName (levelCreator)
    $query = $db->prepare("SELECT userName FROM levels WHERE userID=$userID");
    $query->execute();
    $userName = $query->fetchColumn();
    
// MOD ACTION
$time = time();

$f = "INSERT INTO modactions (type, timestamp, user)
VALUES (4, $time, $userID)";

$query = $db->prepare($f);
$query->execute();
    
  $querytext = "UPDATE users SET isCreatorBanned = 0 WHERE users.userID = $userID";
  $query = $db->prepare($querytext);
  $query->execute();
  echo "Upload unbanned user!";
  echo "<br>";
  echo "<b>User ID</b>: $userID";
  
    # send webhook
  $dw = new discordWebhook($toolWebhook);
  $toolWebhook = $dw
            ->newMessage()
            ->setTitle("User upload unbanned!")
            ->addField("User", "**$userName**, User ID **$userID**")
            ->addField("Unban Reason", "$reason")
            ->setTimestamp()
            ->setColor("#ffee00")
            ->send();
} else {
  echo '<p>Unban a user from uploading levels using this tool.</p>
    <button class="w3-button w3-blue"><a href="uploadBan.php">Want to upload ban a user?</a></button><br><br>
  <div class="w3-card-4">
  <div class="w3-container w3-blue">
    <h3>Upload Unban User</h3>
  </div>
  <form action="uploadUnban.php" method="post" class="w3-container">
  <br>
        <label for="userID">UserID:</label> <input class="w3-input w3-border" type="number" id="userID" name="userID" placeholder="User ID"><br>
                <label for="reason">Reason:</label> <input class="w3-input w3-border" type="text" id="reason" name="reason" placeholder="Reason"><br>
		<input class="w3-btn w3-blue" type="submit" value="Unban" /><br><br></form></div>
		';
}
?>