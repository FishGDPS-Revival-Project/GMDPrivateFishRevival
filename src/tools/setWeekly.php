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
  echo "<h2>Set Weekly Demon</h2>";

  include "../incl/lib/connection.php";
  require_once "../incl/lib/mainLib.php";
  $gs = new mainLib();

  if (!empty($_POST["levelID"])) {
    $levelID = ($_POST["levelID"]);

    # level description
    $query = $db->prepare("SELECT levelDesc FROM levels WHERE levelID=$levelID");
    $query->execute();
    $encodedLevelDesc = $query->fetchColumn();
    $levelDesc = base64_decode($encodedLevelDesc);
    if ($levelDesc == "") {
      $levelDesc = "(No description provided)";
    }

    # level name
    $query = $db->prepare("SELECT levelName FROM levels WHERE levelID=$levelID");
    $query->execute();
    $levelName = $query->fetchColumn();

    # username of the creator of the level ($levelCreator)
    $query = $db->prepare("SELECT userName FROM levels WHERE levelID=$levelID");
    $query->execute();
    $levelCreator = $query->fetchColumn();

    echo "Made level a weekly demon!";
    echo '<br>';
    echo "<b>Level ID</b>: $levelID";
    echo "<br>";
    echo "<b>Level Name</b>: $levelName";
    echo "<br>";
    echo "<b>Level Description</b>: $levelDesc";

    include "../incl/misc/DiscordWebhook.php";
    include "../config/discord.php";

    # fill `isWeekly` column to 0, then set it
    # to 1 for the specific levelid
    $query = $db->prepare("UPDATE levels SET isWeekly = 0");
    $query->execute();

    $query = $db->prepare("UPDATE levels SET isWeekly = 1 WHERE levels.levelID = $levelID");
    $query->execute();

    $dw = new discordWebhook($weeklyWebhook);
    $weeklyWebhook = $dw
    ->newMessage()
    ->setContent("<@&1371201055609589790>") # New Rates ping
    #->setAuthor("$nrUsername", "", "https://gdicon.oat.zone/icon.png?type=cube&value=$nrIcon&color1=$nrColor1&color2=$nrColor2")
    ->setTitle("New Weekly Demon")
    ->setDescription("Our mod team has made a level a **Weekly Demon**!")
    ->setColor('#a9a9a9')
    #->setThumbnail($gldi)
    ->addField("Level", "**$levelName** by **$levelCreator**, ID **$levelID**")
    ->addField("Description", "$levelDesc")
    ->setTimestamp()
    ->send();
  } else {
    echo '<p>Make a level a weekly demon using this tool.</p>
  <div class="w3-card-4">
  <div class="w3-container w3-blue">
    <h3>Set Weekly Level</h3>
  </div>
  <form action="setWeekly.php" method="post" class="w3-container">
  <br>
        <label for="levelID">Level ID:</label> <input class="w3-input w3-border" type="number" id="levelID" name="levelID" placeholder="Level ID"><br>
		<input class="w3-btn w3-blue" type="submit" value="Submit" /><br><br></form></div>
		';
  }
  ?>