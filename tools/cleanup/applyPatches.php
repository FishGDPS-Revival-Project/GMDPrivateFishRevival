<?php
include "../../incl/web/navbar.php";
?>
<div class="w3-container">
<?php
echo "<h1>Patch Applier</h1>";

include "../../incl/lib/connection.php";
include "../../incl/lib/mainLib.php";
$gs = new mainLib();

// UNDEFINED NAME
$query = $db->prepare("DELETE FROM users WHERE userName = 'Undefined' AND stars < 1");
$query->execute();

$query = $db->prepare("DELETE FROM users WHERE userID < 0");
$query->execute();

echo "Deleting and fixing invalid users...";
echo "Done";
echo "<hr>";

// STARS PLUS DEMONS
$query = $db->prepare("SELECT SUM(starStars) FROM levels");
$query->execute();
$stars = $query->fetchColumn();

$query = $db->prepare("SELECT COUNT(*) FROM levels WHERE starDemon > 0");
$query->execute();
$demons = $query->fetchColumn();

$totalSum = $demons * 10 + $stars;

// INVALID STAR COUNT FOR PLAYERS
$query = $db->prepare("UPDATE users SET isLeaderboardBanned = 1 WHERE stars > $totalSum");
$query->execute();
echo "Reseting invalid star count... (limit: " . $totalSum . ")";
echo " Done";
echo "<hr>";

// INVALID DEMON COUNT
$query = $db->prepare("SELECT COUNT(*) FROM levels WHERE starDemon > 0");
$query->execute();
$thing = $query->fetchColumn();

$query = $db->prepare("UPDATE users SET isLeaderboardBanned = 1 WHERE demons > $thing");
$query->execute();
echo "Reseting invalid demon count...";
echo "Done";
echo "<hr>";

// INVALID CP COUNT
$query = $db->prepare("UPDATE users SET isCreatorBanned = 1 WHERE creatorPoints > 100");
$query->execute();
echo "Reseting invalid creator point count...";
echo "Done";
echo "<hr>";

// INVALID GAME VERSION
$query = $db->prepare("DELETE FROM levels WHERE gameVersion > 20");
$query->execute();

// INVALID LIKE COUNTS
$query = $db->prepare("UPDATE levels SET likes = 0 WHERE likes > 99");
$query->execute();

$query = $db->prepare("UPDATE levels SET likes = 0 WHERE likes < -99");
$query->execute();

// INVALID DOWNLOAD COUNT (MORE THAN 999)
$query = $db->prepare("UPDATE levels SET downloads = 0 WHERE downloads > 999");
$query->execute();

// INVALID DOWNLOAD COUNT (LESS THAN 0)
$query = $db->prepare("UPDATE levels SET downloads = 0 WHERE downloads < 0");
$query->execute();

// INVALID STAR COUNT
$query = $db->prepare("UPDATE levels SET starStars = 0 WHERE starStars > 10");
$query->execute();

// INVALID STARDIFFICULTY (GAME CRASHER)
$query = $db->prepare("UPDATE levels SET starDifficulty = 0 WHERE starDifficulty > 50");
$query->execute();

// INVALID SONG
$query = $db->prepare("UPDATE levels SET audioTrack = 0 WHERE audioTrack > 12");
$query->execute();

// INVALID STAR COUNT
$query = $db->prepare("UPDATE levels SET starStars = 0 WHERE starStars < 0");
$query->execute();

// DELETE LEVELS WITH NO LVL DATA
$query = $db->prepare("SELECT levelID FROM levels");
$query->execute();
$result = $query->fetchAll();

foreach($result as &$row) {
if (isset($row[$levelID])) {

$directory = '../data/levels/' .$row[$levelID] . '';

if (file_exists($directory)) {
return true;
} else {
$id = $row[$levelID];
$query = $db->prepare("DELETE FROM levels WHERE levelID = $id");
$query->execute();
}
}
}

// DELETE INVALID IDS
$query = $db->prepare("DELETE FROM levels WHERE levelID < 30");
$query->execute();

// INVALID LEVEL VERSION
$query = $db->prepare("UPDATE levels SET levelVersion = 0 WHERE levelVersion < 0 OR levelVersion > 32");
$query->execute();

$query = $db->prepare("UPDATE levels SET userID = 296 WHERE userID = 201");
$query->execute();



echo "Deleting and fixing invalid levels...";
echo "Done";
echo "<hr>";

// SET ISSPASM TO COMMENTS
$query = $db->prepare("UPDATE comments SET isSpam = 1 WHERE likes < -3");
$query->execute();

// SET COLOUR TO MODS

    

echo "Patching comments...";
echo "Done";
echo "<hr>";

echo "Done applying patches"
?>
</div>