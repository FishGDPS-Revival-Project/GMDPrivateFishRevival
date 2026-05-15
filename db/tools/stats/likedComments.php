<?php
include "../../incl/web/navbar.php";
?>
<div class="w3-container">
<h1>Most disliked and liked comments</h1>
<div class="w3-responsive">
<table class="w3-table w3-striped w3-bordered"><tr class="w3-blue"><th>#</th><th>Commenter</th><th>Comment</th><th>Likes</th><th>Level</th></tr>
<?php
include "../../incl/lib/connection.php";
$query = $db->prepare("SELECT * FROM comments ORDER BY likes ASC LIMIT 100");
$query->execute();
$result = $query->fetchAll();
$comments = 'comment';
$id = 'levelID';

foreach($result as &$row) {
if (isset($row[$id])) {
$levelID = $row[$id];
$query = $db->prepare("SELECT levelName FROM levels WHERE levelID = $levelID");
$query->execute();
$row[$id] = $query->fetchColumn();
}
}

foreach($result as &$row) {
if (isset($row[$comments])) {
$row[$comments] = base64_decode($row[$comments]);
}
}
$x = 0;
foreach($result as &$gain){
	$x++;
	echo "<tr><td>$x</td><td>${gain['userName']}</td><td>${gain['comment']}</td><td>${gain['likes']}</td><td>${gain['levelID']}</td></tr>";
}
?>
</table>
<h2>Liked levels</h2>
<table class="w3-table w3-striped w3-bordered"><tr class="w3-blue"><th>#</th><th>Commenter</th><th>Comment</th><th>Likes</th><th>Level</th></tr>
<?php
include "../../incl/lib/connection.php";
$query = $db->prepare("SELECT * FROM comments ORDER BY likes DESC LIMIT 100");
$query->execute();
$result = $query->fetchAll();
$comments = 'comment';
$id = 'levelID';

foreach($result as &$row) {
if (isset($row[$id])) {
$levelID = $row[$id];
$query = $db->prepare("SELECT levelName FROM levels WHERE levelID = $levelID");
$query->execute();
$row[$id] = $query->fetchColumn();
}
}

foreach($result as &$row) {
if (isset($row[$comments])) {
$row[$comments] = base64_decode($row[$comments]);
}
}
$x = 0;
foreach($result as &$gain){
	$x++;
	echo "<tr><td>$x</td><td>${gain['userName']}</td><td>${gain['comment']}</td><td>${gain['likes']}</td><td>${gain['levelID']}</td></tr>";
}
?>
</table>
<a href="https://system32.141412.xyz/db/tools/stats/levelCountStats.php" class="w3-button w3-blue"><< Back</a>
</div>