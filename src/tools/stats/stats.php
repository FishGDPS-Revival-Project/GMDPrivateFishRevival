<?php
include "../../incl/web/navbar.php";
?>
<div class="w3-container">
<h1>Statistics</h1>
<h2>Levels</h2>
<div class="w3-responsive">
<table class="w3-table w3-striped w3-bordered">
<tr class="w3-blue"><th>Difficulty</th><th>Total</th><th>Unrated</th><th>Rated</th><th>Featured</th><th>Epic</th></tr>
<?php
include "../../incl/lib/connection.php";
include "../../incl/lib/mainLib.php";
$gs = new mainLib();

$start_time = microtime(true);

function genLvlRow($params, $params2, $params3, $params4){
	include "../../incl/lib/connection.php";
	$query = $db->prepare("SELECT count(*) FROM levels ".$params4." ".$params2);
	$query->execute();
	$row = "<tr><td>$params3</td><td>".$query->fetchColumn()."</td>";
	$query = $db->prepare("SELECT count(*) FROM levels WHERE starStars = 0 ".$params." ".$params2);
	$query->execute();
	$row .= "<td>".$query->fetchColumn()."</td>";
	$query = $db->prepare("SELECT count(*) FROM levels WHERE starStars <> 0 ".$params." ".$params2);
	$query->execute();
	$row .= "<td>".$query->fetchColumn()."</td>";
	$query = $db->prepare("SELECT count(*) FROM levels WHERE starFeatured <> 0 ".$params." ".$params2);
	$query->execute();
	$row .= "<td>".$query->fetchColumn()."</td>";
	$query = $db->prepare("SELECT count(*) FROM levels WHERE starEpic <> 0 ".$params." ".$params2);
	$query->execute();
	$row .= "<td>".$query->fetchColumn()."</td></tr>";
	return $row;
}

function generateQuery($groupBy, $requirements){
	$queryString = "
		SELECT total.${groupBy}, total.amount AS total, unrated.amount AS unrated, rated.amount AS rated, featured.amount AS featured, epic.amount AS epic
		FROM(
			(SELECT ${groupBy}, count(*) AS amount FROM levels WHERE ${requirements} GROUP BY(${groupBy})) total
			JOIN
			(SELECT ${groupBy}, count(*) AS amount FROM levels WHERE ${requirements} AND starStars = 0 GROUP BY(${groupBy})) unrated
			ON total.${groupBy} = unrated.${groupBy}
			JOIN
			(SELECT ${groupBy}, count(*) AS amount FROM levels WHERE ${requirements} AND starStars <> 0 GROUP BY(${groupBy})) rated
			ON total.${groupBy} = rated.${groupBy}
			JOIN
			(SELECT ${groupBy}, count(*) AS amount FROM levels WHERE ${requirements} AND starFeatured <> 0 GROUP BY(${groupBy})) featured
			ON total.${groupBy} = featured.${groupBy}
			JOIN
			(SELECT ${groupBy}, count(*) AS amount FROM levels WHERE ${requirements} AND starEpic <> 0 GROUP BY(${groupBy})) epic
			ON total.${groupBy} = epic.${groupBy}
		) GROUP BY(total.${groupBy})
	";
	return $queryString;
}

function fetchQuery($db, $groupBy, $requirements){
	$query = $db->prepare(generateQuery($groupBy, $requirements));
	$query->execute();
	return $query->fetchAll();
}

// TOTAL
echo genLvlRow("","","Total", "");
foreach(fetchQuery($db, 'starAuto', 'starAuto = 1') as &$row){
	$diffName = $gs->getDifficulty(10, 1, 0);
	echo "<tr><td>${diffName}</td><td>${row['total']}</td><td>${row['unrated']}</td><td>${row['rated']}</td><td>${row['featured']}</td><td>${row['epic']}</td></tr>";
}

// NA
echo genLvlRow("AND","starDifficulty = 0", "N/A", "WHERE");
$query = $db->prepare(generateQuery('starDemonDiff', 'starDifficulty = 0'));
$query->execute();
foreach($query->fetchAll() as &$row){
	$diffName = 'Auto';
	echo "<tr><td>${diffName}</td><td>${row['total']}</td><td>${row['unrated']}</td><td>${row['rated']}</td><td>${row['featured']}</td><td>${row['epic']}</td></tr>";
}

// AUTO
echo genLvlRow("AND","starAuto = 1", "Auto", "WHERE");
$query = $db->prepare(generateQuery('starDemonDiff', 'starAuto = 1'));
$query->execute();
foreach($query->fetchAll() as &$row){
	$diffName = 'Auto';
	echo "<tr><td>${diffName}</td><td>${row['total']}</td><td>${row['unrated']}</td><td>${row['rated']}</td><td>${row['featured']}</td><td>${row['epic']}</td></tr>";
}

// EASY
$query = $db->prepare(generateQuery('starDemonDiff', 'starDifficulty = 10'));
$query->execute();
foreach($query->fetchAll() as &$row){
	echo "<tr><td>Easy</td><td>${row['total']}</td><td>${row['unrated']}</td><td>${row['rated']}</td><td>${row['featured']}</td><td>${row['epic']}</td></tr>";
}

// NORMAL
echo genLvlRow("AND","starDifficulty = 20", "Normal", "WHERE");
$query = $db->prepare(generateQuery('starDemonDiff', 'starDifficulty = 20'));
$query->execute();
foreach($query->fetchAll() as &$row){
	$diffName = 'Normal';
	echo "<tr><td>${diffName}</td><td>${row['total']}</td><td>${row['unrated']}</td><td>${row['rated']}</td><td>${row['featured']}</td><td>${row['epic']}</td></tr>";
}

// HARD
echo genLvlRow("AND","starDifficulty = 30", "Hard", "WHERE");
$query = $db->prepare(generateQuery('starDemonDiff', 'starDifficulty = 30'));
$query->execute();
foreach($query->fetchAll() as &$row){
	$diffName = 'Hard';
	echo "<tr><td>${diffName}</td><td>${row['total']}</td><td>${row['unrated']}</td><td>${row['rated']}</td><td>${row['featured']}</td><td>${row['epic']}</td></tr>";
}

// HARDER
$query = $db->prepare(generateQuery('starDemonDiff', 'starDifficulty = 40'));
$query->execute();
foreach($query->fetchAll() as &$row){
	$diffName = 'Harder';
	echo "<tr><td>Harder</td><td>${row['total']}</td><td>${row['unrated']}</td><td>${row['rated']}</td><td>${row['featured']}</td><td>${row['epic']}</td></tr>";
}

// INSANE
$query = $db->prepare(generateQuery('starDemonDiff', 'starDifficulty = 50'));
$query->execute();
foreach($query->fetchAll() as &$row){
	$diffName = 'Insane';
	echo "<tr><td>${diffName}</td><td>${row['total']}</td><td>${row['unrated']}</td><td>${row['rated']}</td><td>${row['featured']}</td><td>${row['epic']}</td></tr>";
}

// DEMON
echo genLvlRow("AND","starDemon = 1", "Demon", "WHERE");
$query = $db->prepare(generateQuery('starDemonDiff', 'starDemon = 1'));
$query->execute();
foreach($query->fetchAll() as &$row){
	$diffName = 'Demon';
	echo "<tr><td>${diffName}</td><td>${row['total']}</td><td>${row['unrated']}</td><td>${row['rated']}</td><td>${row['featured']}</td><td>${row['epic']}</td></tr>";
}

?>
</table>
</div>

<h3>Amount of levels with song:</h3>
<div class="w3-responsive">
<table class="w3-table w3-striped w3-bordered">
<tr class="w3-blue"><th>Song</th><th>Count</th></tr>
<?php
$query = $db->prepare("SELECT COUNT(levelID) FROM levels WHERE audioTrack = 0");

$query->execute();

$thing = $query->fetchColumn();

echo "<tr><td>Stereo Madness</td><td>$thing</td></tr>";

$query = $db->prepare("SELECT COUNT(levelID) FROM levels WHERE audioTrack = 1");
$query->execute();

$thing = $query->fetchColumn();
echo "<tr><td>Back on Track</td><td>$thing</td></tr>";

$query = $db->prepare("SELECT COUNT(levelID) FROM levels WHERE audioTrack = 2");
$query->execute();

$thing = $query->fetchColumn();
echo "<tr><td>Polargeist</td><td>$thing</td></tr>";

$query = $db->prepare("SELECT COUNT(levelID) FROM levels WHERE audioTrack = 3");
$query->execute();

$thing = $query->fetchColumn();
echo "<tr><td>Dry Out</td><td>$thing</td></tr>";

$query = $db->prepare("SELECT COUNT(levelID) FROM levels WHERE audioTrack = 4");
$query->execute();

$thing = $query->fetchColumn();
echo "<tr><td>Base After Base</td><td>$thing</td></tr>";

$query = $db->prepare("SELECT COUNT(levelID) FROM levels WHERE audioTrack = 5");
$query->execute();

$thing = $query->fetchColumn();
echo "<tr><td>Cant Let Go</td><td>$thing</td></tr>";

$query = $db->prepare("SELECT COUNT(levelID) FROM levels WHERE audioTrack = 6");
$query->execute();

$thing = $query->fetchColumn();
echo "<tr><td>Jumper</td><td>$thing</td></tr>";

$query = $db->prepare("SELECT COUNT(levelID) FROM levels WHERE audioTrack = 7");
$query->execute();

$thing = $query->fetchColumn();
echo "<tr><td>Time Machine</td><td>$thing</td></tr>";

$query = $db->prepare("SELECT COUNT(levelID) FROM levels WHERE audioTrack = 8");
$query->execute();

$thing = $query->fetchColumn();
echo "<tr><td>Cycles</td><td>$thing</td></tr>";

$query = $db->prepare("SELECT COUNT(levelID) FROM levels WHERE audioTrack = 9");
$query->execute();

$thing = $query->fetchColumn();
echo "<tr><td>xStep</td><td>$thing</td></tr>";

$query = $db->prepare("SELECT COUNT(levelID) FROM levels WHERE audioTrack = 10");
$query->execute();

$thing = $query->fetchColumn();
echo "<tr><td>Clutterfunk</td><td>$thing</td></tr>";

$query = $db->prepare("SELECT COUNT(levelID) FROM levels WHERE audioTrack = 11");
$query->execute();

$thing = $query->fetchColumn();
echo "<tr><td>Theory of Everything</td><td>$thing</td></tr>";
$query = $db->prepare("SELECT COUNT(levelID) FROM levels WHERE audioTrack = 12");
$query->execute();

$thing = $query->fetchColumn();
echo "<tr><td>Active</td><td>$thing</td></tr></table>";
?>
</div>

<h2>Users</h2>
<div class="w3-responsive">
<table class="w3-table w3-striped w3-bordered">
<tr class="w3-blue"><th>Type</th><th>Count</th></tr>
<?php
$query = $db->prepare("SELECT count(*) FROM users");
$query->execute();
$thing = $query->fetchColumn();
echo "<tr><td>Total</td><td>$thing</td></tr>";

$sevendaysago = time() - 604800;
$query = $db->prepare("SELECT count(*) FROM users WHERE lastPlayed > :lastPlayed");
$query->execute([':lastPlayed' => $sevendaysago]);
$thing = $query->fetchColumn();
echo "<tr><td>Active</td><td>$thing</td></tr>";
?>
</table>
<h2>Combined Stats</h2>
<p>Amount of stars/demons/etc collected by every player.</p>
<table class="w3-table w3-striped w3-bordered">
<tr class="w3-blue"><th>Stat</th><th>Count</th>
<?php
// STARS
$query = $db->prepare("SELECT SUM(stars) FROM users");
$query->execute();
$thing = $query->fetchColumn();
echo "<tr><td>Stars</td><td>$thing</td></tr>";

// DEMONS
$query = $db->prepare("SELECT SUM(demons) FROM users");
$query->execute();
$thing = $query->fetchColumn();
echo "<tr><td>Demons</td><td>$thing</td></tr>";

// CREATOR POINTS
$query = $db->prepare("SELECT SUM(creatorPoints) FROM users");
$query->execute();
$thing = $query->fetchColumn();
echo "<tr><td>Creator Points</td><td>$thing</td></tr>";
?>

</table>
<h2>Combined actions</h2>
<p>Amount of likes, downloads and comments made by every player.</p>
<table class="w3-table w3-striped w3-bordered">
<tr class="w3-blue"><th>Stat</th><th>Count</th>
<?php
// LIKES
$query = $db->prepare("SELECT SUM(likes) FROM levels");
$query->execute();
$thing = $query->fetchColumn();
echo "<tr><td>Likes</td><td>$thing</td></tr>";

// DOWNLOADS
$query = $db->prepare("SELECT SUM(downloads) FROM levels");
$query->execute();
$thing = $query->fetchColumn();
echo "<tr><td>Downloads</td><td>$thing</td></tr>";

// COMMENTS
$query = $db->prepare("SELECT COUNT(*) FROM comments");
$query->execute();
$thing = $query->fetchColumn();
echo "<tr><td>Comments</td><td>$thing</td></tr>";
?>
</table>
</div>
<a href="http://system32.141412.xyz/db/tools/stats/levelCountStats.php" class="w3-button w3-blue" style="margin-top:7px">Extra Info</a>
</div> 