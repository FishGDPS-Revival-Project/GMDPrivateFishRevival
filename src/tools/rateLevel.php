<?php include "../incl/web/navbar.php"; ?>
<div class="w3-container">
  <?php
  session_start();
$admin = $_SESSION['admin'];
if (!$admin) {
    exit('Not logged in');
}
  echo "<h2>Rate a level</h2>";

  include "../incl/lib/connection.php";
  include "../incl/lib/mainLib.php";
  include "../incl/misc/DiscordWebhook.php";
  include "../config/discord.php";

  $gs = new mainLib();

  if (!empty($_POST["levelID"])) {
    require "../incl/misc/rateToolPassword.php";
    $levelID = ($_POST["levelID"]);
    $stars = ($_POST["stars"]);
    $difficulty = 0;
    $rfe = ($_POST["rfe"]); # Rate type
    $sa = 0; # if the level is auto
    $sd = 0; # if the level is demon
    $demonDiff = ($_POST["demonDiff"]); # Demon difficulty
    
    $mComment = ($_POST["mComment"]); # moderator's comment
    if (empty($mComment)) {
        $mComment = '(No comment provided)';
    }

    $cr = ($_POST["cr"]); # is a rerate?

    # set difficulty, $sa, and $sd based on star amount
    switch ($stars) {
      case 1: # auto
        $sa = 1;
      case 2: # easy
        $difficulty = 10;
        break;
      case 3: # normal
        $difficulty = 20;
        break;
      case 4: # hard
      case 5:
        $difficulty = 30;
        break;
      case 6: # harder
      case 7:
        $difficulty = 40;
        break;
      case 8: # insane
      case 9:
        $difficulty = 50;
        break;
      case 10: # demon
        $difficulty = 50;
        $sd = 1;
      default: # n/a
        $difficulty = 0;
    }

    # userid from username for the rate webhook
    $nrUserID = ($_POST["nrUserID"]);
    $query = $db->prepare("SELECT userName FROM users WHERE userID=$nrUserID");
    $query->execute();
    $nrUsername = $query->fetchColumn();
    if ($nrUsername == "") {
      $nrUsername = "Unknown User";
    }

    # author icons (from userid) (for rate webhook)
    # credit to https://gdicon.oat.zone for rendering the icons

    // icon
    $query = $db->prepare("SELECT icon FROM users WHERE userID=$nrUserID");
    $query->execute();
    $nrIcon = $query->fetchColumn();

    // color 1
    $query = $db->prepare("SELECT color1 FROM users WHERE userID=$nrUserID");
    $query->execute();
    $nrColor1 = $query->fetchColumn();

    // color 2
    $query = $db->prepare("SELECT color2 FROM users WHERE userID=$nrUserID");
    $query->execute();
    $nrColor2 = $query->fetchColumn();


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

    # human-readable versions of $difficulty, and $rfe (rate type)
    $rrfe = "";
    $rdiff = "";

    # difficulty
    switch ($difficulty) {
    case 10:
      $rdiff = "Easy";
      break;
    case 20:
      $rdiff = "Normal";
      break;
    case 30:
      $rdiff = "Hard";
      break;
    case 40:
      $rdiff = "Harder";
      break;
    case 50:
      $rdiff = "Insane";
      break;
    }
    if ($sa == 1) {
      $rdiff = "Auto";
    } else {
      $rdiff = $rdiff;
    }
    
    switch ($demonDiff) {
        case 3:
            $rDemonDiff = "Easy";
            break;
        case 4:
            $rDemonDiff = "Medium";
            break;
        case 5:
            $rDemonDiff = "Insane";
            break;
        case 6:
            $rDemonDiff = "Extreme";
            break;
        default:
            $rDemonDiff = "Hard";
    }
    
    if ($sd == 1) {
      $rdiff = "$rDemonDiff"." Demon";
    } else {
      $rdiff = $rdiff;
    }

    # readable rate type
    switch ($rfe) {
    case 0:
      $rrfe = "Star rate";
      break;
    case 1:
      $rrfe = "Featured";
      break;
    case 2:
      $rrfe = "Epic";
      break;
    }

    # difficultiy thumbnails
    # credit to https://gcs.icu/WTFIcons/difficulties

    # for the link
    switch ($rfe) {
    case 0:
      $starsIcon = "stars";
      break;
    case 1:
      $starsIcon = "featured";
      break;
    case 2:
      $starsIcon = "epic";
      break;
    }

    switch ($difficulty) {
    case 10:
      $diffIcon = "easy";
      break;
    case 20:
      $diffIcon = "normal";
      break;
    case 30:
      $diffIcon = "hard";
      break;
    case 40:
      $diffIcon = "harder";
      break;
    case 50:
      $diffIcon = "insane";
      break;
    default:
      $diffIcon = "na";
    }
    
    switch ($demonDiff) {
        case 3:
            $iDemonDiff = "easy";
            break;
        case 4:
            $iDemonDiff = "medium";
            break;
        case 5:
            $iDemonDiff = "insane";
            break;
        case 6:
            $iDemonDiff = "extreme";
            break;
        default:
            $iDemonDiff = "hard";
    }
    
    if ($sa == 1) {
      $diffIcon = "auto";
    } elseif ($sd == 1) {
      $diffIcon = "demon-$iDemonDiff";
    }

    # link format
    $difficultiesURL = 'https://gcs.icu/WTFIcons/difficulties/';
    $gldi = $difficultiesURL.$starsIcon.'/'.$diffIcon.'.png';

    # rate the level
    $querytext = "UPDATE levels SET starDemon = $sd, starAuto = $sa, starFeatured = $rfe, starStars = $stars, starDifficulty = $difficulty, starDemonDiff = $demonDiff WHERE levels.levelID = $levelID";
    $query = $db->prepare($querytext);
    $query->execute();

    # then output the information to the user
    echo "<h3>Level rated!</h3>";
    echo "<b>Level Name</b>: $levelName";
    echo "<br>";
    echo "<b>Level ID</b>: $levelID";
    echo "<br>";
    echo "<b>Level Description</b>: $levelDesc";
    echo "<br>";
    echo "<b>Stars</b>: $stars*";
    echo "<br>";
    echo "<b>Difficulty</b>: $rdiff";
    echo "<br>";
    echo "<b>Demon Difficulty</b>: $rDemonDiff";
    echo "<br>";
    echo "<b>Rate Type</b>: $rrfe";

    # add a panel that includes the sql code that rated the level
    echo '<div class="w3-panel w3-card w3-light-grey"><h3>SQL code</h3>';
    echo '<div class="w3-code notranslate">';
    echo "$querytext";
    echo '</div></div>';

    # fix creator points (running cron)
    echo '<div style="display: none">';
    include "cron/fixcps.php";
    echo '</div>';

    # level re-rating: change discord webhook color/description
    # when the re-rate checkbox is selected, otherwise default
    if ($cr == "1") {
      $dwcolor = "#ffa500";
      $dwdescription = "Level re-rated!";
    } else {
      $dwcolor = "#00ff00";
      $dwdescription = "Level rated!";
    }

    # send the discord webhook to the specified webhook link
    # (configure at config/discord.php)
    $dw = new discordWebhook($rateWebhook);
    $rateWebhook = $dw
    ->newMessage()
    ->setContent("<@&1371201055609589790>") # @New Rates role in FishGDPS, replace this with your role
    ->setAuthor("$nrUsername", "", "https://gdicon.oat.zone/icon.png?type=cube&value=$nrIcon&color1=$nrColor1&color2=$nrColor2")
    ->setDescription($dwdescription)
    ->setColor($dwcolor)
    ->setThumbnail($gldi)
    ->addField("Level", "**$levelName** by **$levelCreator**, ID **$levelID**")
    ->addField("Difficulty", "**$rdiff**, **$stars** stars, $rrfe")
    ->addField("Description", "$levelDesc")
    ->addField("Moderator's Comments", "$mComment")
    ->setTimestamp()
    ->send();
  } else {
    # website form
    echo '
  <p>Rate an existing level using this tool.</p>
  <button class="w3-button w3-blue"><a href="unrateLevel.php">Want to unrate a level?</a></button><br><br>
  <div class="w3-card-4">
  <div class="w3-container w3-blue">
    <h3>Rate Level</h3>
  </div>

  <form action="rateLevel.php" method="post" class="w3-container">
  <br>
  <label for="nrUserID">User ID (<a href="modUserIDList.php">Moderator UserID List</a>):</label>
  <input class="w3-input w3-border" type="number" id="nrUserID" name="nrUserID" placeholder="User ID" min="1" max="10000"><br>
  <label for="levelID">Level ID*:</label>
		<input class="w3-input w3-border" type="number" id="levelID" name="levelID" placeholder="Level ID" min="1" max="10000" required><br>
		<label for="stars">Stars (Difficulty is assigned automatically)*:</label>
<input class="w3-input w3-border" type="number" id="stars" name="stars" placeholder="Star Amount" min="1" max="10"><br>
	<label for="demonDiff">Demon difficulty:</label>
<select class="w3-select w3-border" name="demonDiff" id="demonDiff">
 <option value="3">Easy Demon</option>
 <option value="4">Medium Demon</option>
 <option value="1">Hard Demon</option>	
 <option value="5">Insane Demon</option>
 <option value="6">Extreme Demon</option>
</select><br><br>
	<label for="rfe">Rate type*:</label>
<select class="w3-select w3-border" name="rfe" id="rfe">
 <option value="0">Star rate</option>
 <option value="1">Feature</option>
 <option value="2">Epic</option>
</select>
<br><br>
<label for="mComment">Comments (about the level, etc):</label>
		<input class="w3-input w3-border" type="text" id="mComment" name="mComment" placeholder="Comment"><br>
        <input class="w3-check" type="checkbox" id="cr" name="cr" value="1">
        <label for="cr">Is the level a re-rate?</label><br><br>
		<input class="w3-btn w3-blue" type="submit" value="Rate" />
        <br><br>
        </form>
        </div>
		';


  }
  ?>
</div>