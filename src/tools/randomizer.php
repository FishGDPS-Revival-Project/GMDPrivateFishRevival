<?php 
include "../incl/web/navbar.php"; 
include "../incl/lib/connection.php";
require_once "../incl/lib/mainLib.php";
$gs = new mainLib();
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

# starStars
$query = $db->prepare("SELECT starStars from levels WHERE levelID=$levelID");
$query->execute();
$stars = $query->fetchColumn();

echo '<h1>Level randomizer</h1>';
echo 'Refresh this page to randomize a level.<br><br>';

echo '<div class="w3-card-4">';

echo '<div class="w3-container w3-blue"><h3>Level</h3></div><br>';

$rarity = 'none';

if($stars > 0) {
$rarity = 'common';
}

if($levelID < 101) {
$rarity = 'historical';
}

switch ($levelName) {
case "xRiver007":
case "Riftbound":
case "oh i know that lvl":
case "Purple Faith":
case "Skillset Factory I":
case "LevelWithNoComments":
case "Fish Ball":
case "Theory of Amethyst":
case "Flappy the Flapper":
case "Maze of Kaeser":
case "Pink NuTella":
case "Make me jump":
case "Spiked":
case "Diablo II":
case "Brie":
case "Active":
case "Axonis":
case "auto play area":
case "cancer level":
case "OBJ LIMIT":
case "FMD":
case "Kaza":
case "forest":
case "the breathing forest":
case "Fishing":
case "Rotund":
case "Mi Wu Sen Lin":
case "QUOWONO":
case "Demon Out":
case "The Spike Castle":
	$rarity = 'rare';
	break;
case "LvlDesignedToHateU":
case "i know that lvl 2":
case "Green Schizophrenia":
case "Cluttersmalls":
case "Blueberry Kittens":
case "Wilted World":
case "ballaphobia":
case "SteelThrone Fantasy":
case "The Nightmare":
case "Activus":
case "sarukenu":
case "Fishy":
case "tuff mangos":
case "Fishypolis":
case "Kaeser World":
case "Tunnel of Despair":
	$rarity = 'epic';
	break;
case "SOG Carbon Chaos":
case "Claustrophobia":
case "CLOUDTheory":
case "Paranoid":
case "Element 2 He":
case "Element 1 H":
case "Ship Hell":
case "Joe Bart":
	$rarity = 'legendary';
	break;
}

if ($rarity == 'none') {
echo '<div class="w3-container">';
echo "<b>$levelName</b> by $creator";
echo "<br>Level ID: $levelID";
}


if ($rarity == 'common') {
echo '<div class="w3-container">';
echo "<b>$levelName</b> by $creator";
echo "<br>Level ID: $levelID";
echo '<br><b style="color:Grey;">Common</b>';
}

if ($rarity == 'rare') {
echo '<div class="w3-container">';
echo "<b>$levelName</b> by $creator";
echo "<br>Level ID: $levelID";
echo '<br><b style="color:Cyan;">Rare</b>';
}

if ($rarity == 'historical') {
echo '<div class="w3-container">';
echo "<b>$levelName</b> by $creator";
echo "<br>Level ID: $levelID";
echo '<br><b style="color:Gold;">Historical</b>';
}


if ($rarity == 'epic') {
echo '<div class="w3-container">';
echo "<b>$levelName</b> by $creator";
echo "<br>Level ID: $levelID";
echo '<br><b style="color:Purple;">Epic</b>';
}


if ($rarity == 'legendary') {
echo '<div class="w3-container">';
echo "<b>$levelName</b> by $creator";
echo "<br>Level ID: $levelID";
echo '<br><b style="color:Darkgoldenrod;">Legendary</b>';
}


?>


<!--
<h1>Take a break...</h1>
<p>Hi, watch this video instead, It is not a rickroll:</p>
<iframe width="360" height="640"
src="https://www.youtube.com/embed/ydOY7v5vZFI">
</iframe>-->
</div>