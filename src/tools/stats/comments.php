<?php
include "../../incl/web/navbar.php";
?>
<div class="w3-container">
<h1>Most disliked levels</h1>
<div class="w3-responsive">
<table class="w3-table w3-striped w3-bordered"><tr class="w3-blue"><th>#</th><th>Name</th><th>Comments</th></tr>
<?php
//error_reporting(0);
include "../../incl/lib/connection.php";
$x = 0;
$query = $db->prepare("SELECT COUNT(*) FROM comments GROUP BY levelID");
$query->execute();
$comments = $query->fetchColumn();

$query = $db->prepare("SELECT levelID FROM comments GROUP BY levelID");
$query->execute();
$levelID = $query->fetchColumn();

$query = $db->prepare("SELECT levelName FROM levels WHERE levelID = $levelID");
$query->execute();
$levelName = $query->fetchColumn();

foreach($comments as &$gain){
	$x++;
	echo "<tr><td>$x</td><td>$levelName</td><td>$comments</td></tr>";
}
?>
</table>
<a href="https://system32.141412.xyz/db/tools/stats/levelCountStats.php" class="w3-button w3-blue"><< Back</a>
</div>