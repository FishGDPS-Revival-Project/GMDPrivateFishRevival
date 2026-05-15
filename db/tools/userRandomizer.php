<?php include "../incl/web/navbar.php"; ?>
<div class="w3-container">
<!--
<div class="w3-container w3-yellow">
<h1>RARITIES ARE OUT!!!</h1>
</div>-->
<?php

include "../incl/lib/connection.php";
require_once "../incl/lib/mainLib.php";
$gs = new mainLib();
/*
$query = $db->prepare("SELECT levelID FROM levels ORDER BY levelID DESC LIMIT 1");
$query->execute();
$maxLevelID = $query->fetchColumn();

$levelID = rand(30, $maxLevelID);
if ($levelName == "") {
    $levelID = rand(30, $maxLevelID);
    if ($levelName == "") {
        $levelID = rand(30, $maxLevelID);
        if ($levelName == "") {
            $levelID = rand(30, $maxLevelID);
            if ($levelName == "") {
                $levelID = rand(30, $maxLevelID);
            }
        }
    }
}

# Level name
$query = $db->prepare("SELECT levelName from levels WHERE levelID=$levelID");
$query->execute();
$levelName = $query->fetchColumn();

# Level creator
$query = $db->prepare("SELECT userName from levels WHERE levelID=$levelID");
$query->execute();
$creator = $query->fetchColumn();

echo '<h1>Level randomizer</h1>';
echo 'Refresh this page to randomize a level.<br><br>';

echo '<div class="w3-card-4">';

echo '<div class="w3-container w3-blue"><h3>Level</h3></div><br>';

echo '<div class="w3-container">';
echo "<b>$levelName</b> by $creator";
echo "<br>Level ID: $levelID";

echo '<br><br></div></div>';*/
$query = $db->prepare("SELECT userID FROM users ORDER BY userID DESC LIMIT 1");
$query->execute();
$maxUserID = $query->fetchColumn();

$userID = rand(1, $maxUserID);
# Level name
$query = $db->prepare("SELECT userName FROM users WHERE userID=$userID");
$query->execute();
$userName = $query->fetchColumn();
if ($userName == "") {
    $userID = rand(30, $maxUserID);
    if ($userName == "") {
        $userID = rand(30, $maxUserID);
        if ($userName == "") {
            $userID = rand(30, $maxUserID);
            if ($userName == "") {
                $userID = rand(30, $maxUserID);
            }
        }
    }
}

$query = $db->prepare("SELECT userName FROM users WHERE userID = $userID");
$query->execute();
$userName = $query->fetchColumn();

$rarity = "";
switch ($userName) {
    case "System32":
        $rarity = "Fishtastic!";
        break;
    case "seabeg":
    case "CreatorSeabeg":
        $rarity = "uwu";
        break;
    case "nanoalt":
    case "Kaeser":
    case "xRiver007":
    case "Terminal Soul":
    case "NT CircularCylone":
    case "CirnoTheUwU":
    case "FL SoftFishyPaws":
        $rarity = "Legendary!";
        break;
    case "Tabbi":
    case "Kaza":
        $rarity = "Mythic!";
        break;
    case "hell bean guy":
    case "kencarson":
    case "TheShadowRealm":
    case "Reupload":
    case "MN87":
    case "TheCubeAlex":
    case "qoz":
        $rarity = "Epic!";
        break;
    case "xLumy007":
    case "Level Reporting System":
    case "Diealliwantedwasfun":
    case "tech":
    case "Gw Mystic Flame":
    case "Random":
    case "guing":
    case "ibeatimsostronb":
    case "Sightnado":
    case "aqsa new":
        $rarity = "Rare";
        break;
    case "Adolf Jitler":
        $rarity = "Guten Morgen, mein Kamerad, wenn du das übersetzt, Pech für den Rest deines Lebens.";
        break;
    case "Dyno":
    case "Polygon":
    case "Loxudo":
    case "Slinky":
        $rarity = "Common";
        break;
    case "Human":
        $rarity = "i am a cat";
        break;
    case "femboy":
        $rarity = ":)";
        break;
    default:
        $rarity = "None";
}

echo '<h1>User randomizer</h1>';
echo 'Refresh this page to randomize a user.<br><br>';

echo '<div class="w3-card-4">';

echo '<div class="w3-container w3-blue"><h3>Level</h3></div><br>';

echo '<div class="w3-container">';
echo "<b>$userName</b><br>";
echo "<b>Rarity</b>: $rarity";
echo "<br>User ID: $userID";

echo '<br><br></div></div>';
?>
<!--
<h1>Take a break...</h1>
<p>Hi, watch this video instead, It is not a rickroll:</p>
<iframe width="360" height="640"
src="https://www.youtube.com/embed/ydOY7v5vZFI">
</iframe>-->
</div>