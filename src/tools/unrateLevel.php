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
echo "<h2>Unrate a level</h2>";

include "../incl/lib/connection.php";
require_once "../incl/lib/mainLib.php";
include "../incl/misc/DiscordWebhook.php";
include "../config/discord.php";
$gs = new mainLib();

if (!empty($_POST["levelID"])) {
  require "../incl/misc/rateToolPassword.php";
  $levelID = ($_POST["levelID"]);
  $reason = ($_POST["reason"]);
  if ($reason == "") {
    $reason = "(No reason provided)";
  }

    // userid from username for webhook
    $nrUserID = ($_POST["nrUserID"]);
    $query = $db->prepare("SELECT userName FROM users WHERE userID=$nrUserID");
    $query->execute();
    $nrUsername = $query->fetchColumn();
    if ($nrUsername == "") {
        $nrUsername = "Unknown User";
    }
    
    // icons
    //https://gdicon.oat.zone/icon.png?type=cube&value=181&color1=8&color2=70
    $query = $db->prepare("SELECT icon FROM users WHERE userID=$nrUserID");
    $query->execute();
    $nrIcon = $query->fetchColumn();
    
    $query = $db->prepare("SELECT color1 FROM users WHERE userID=$nrUserID");
    $query->execute();
    $nrColor1 = $query->fetchColumn();
    
    $query = $db->prepare("SELECT color2 FROM users WHERE userID=$nrUserID");
    $query->execute();
    $nrColor2 = $query->fetchColumn();

    // levelDesc
    $query = $db->prepare("SELECT levelDesc FROM levels WHERE levelID=$levelID");
    $query->execute();
    $encodedLevelDesc = $query->fetchColumn();
    $levelDesc = base64_decode($encodedLevelDesc);
    if ($levelDesc == "") {
        $levelDesc = "(No description provided)";
    }

    // levelName
    $query = $db->prepare("SELECT levelName FROM levels WHERE levelID=$levelID");
    $query->execute();
    $levelName = $query->fetchColumn();
    
    // userName (levelCreator)
    $query = $db->prepare("SELECT userName FROM levels WHERE levelID=$levelID");
    $query->execute();
    $levelCreator = $query->fetchColumn();

  $querytext = "UPDATE levels SET starDemon = 0, starAuto = 0, starFeatured = 0, starStars = 0, starDifficulty = 0 WHERE levels.levelID = $levelID";
  $query = $db->prepare($querytext);
  $query->execute();
  echo "<h3>Level unrated!</h3>";
  echo "<b>Level ID</b>: $levelID";
  echo "<br>";
  echo "<b>Level Description</b>: $levelDesc";
  // view sql code
  echo '<div class="w3-panel w3-card w3-light-grey"><h3>SQL code</h3>';
  echo '<div class="w3-code notranslate">';
  echo "$querytext";
  echo '</div></div>';

  // run cron
  echo '<div style="display: none">';
  include "cron/fixcps.php";
  echo '</div>';

    $difficultiesURL = 'https://gcs.icu/WTFIcons/difficulties/';
    $gldi = $difficultiesURL.'stars'.'/'.'na'.'.png';

    $dw = new discordWebhook($rateWebhook);
    $rateWebhook = $dw
            ->newMessage()
            ->setContent("<@&1371201055609589790>")
            ->setAuthor("$nrUsername", "", "https://gdicon.oat.zone/icon.png?type=cube&value=$nrIcon&color1=$nrColor1&color2=$nrColor2")
            ->setDescription("Level unrated!")
            ->setThumbnail($gldi)
            ->addField("Level", "**$levelName** by **$levelCreator**, Level ID **$levelID**")
            ->addField("Description", "$levelDesc")
            ->addField("Unrate Reason", "$reason")
            ->setTimestamp()
            ->setColor("#00ffff")
            ->send();
} else {
    
  echo '
          <p>Unrate an existing rated level using this tool.</p>
  <button class="w3-button w3-blue"><a href="rateLevel.php">Want to rate a level?</a></button><br><br>
  <div class="w3-card-4">
  <div class="w3-container w3-blue">
    <h3>Unrate Level</h3>
  </div>

  <form action="unrateLevel.php" method="post" class="w3-container">
  <br>
  <label for="nrUserID">User ID (<a href="modUserIDList.php">Moderator UserID List</a>):</label>
  <input class="w3-input w3-border" type="number" id="nrUserID" name="nrUserID" placeholder="User ID" min="1" max="10000"><br>
  <label for="levelID">Level ID:</label>
		<input class="w3-input w3-border" type="number" id="levelID" name="levelID" placeholder="Level ID" min="1" max="10000" required><br>
          <label for="levelID">Unrate Reason:</label>
		<input class="w3-input w3-border" type="text" id="reason" name="reason" placeholder="Reason"><br>	
		<input class="w3-btn w3-blue" type="submit" value="Unrate" />
        <br><br>
        </form>
        </div>
		';
}
?>
</div>