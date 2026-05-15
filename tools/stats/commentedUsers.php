<?php
include "../../incl/web/navbar.php";
?>
<div class="w3-container">
<h1>Users with the most comments</h1>
<div class="w3-responsive">
<table class="w3-table w3-striped w3-bordered"><tr class="w3-blue"><th>#</th><th>User Name</th><th>Comments</th></tr>
<?php
include "../../incl/lib/connection.php";
$query = $db->prepare("SELECT userID, COUNT(*) AS COUNT FROM comments GROUP BY userID ORDER BY COUNT(*) DESC LIMIT 100");
$query->execute();
$result = $query->fetchAll();


$userID = 'userID';

foreach($result as &$row) {
if (isset($row[$userID])) {
$id = $row[$userID];
$query = $db->prepare("SELECT userName FROM levels WHERE levelID = $id");
$query->execute();
$userName = $query->fetchColumn();
if ($userName != "") {
$row[$userID] = $userName;
} else {
$row[$userID] = 'Player';
}
}
}

$x = 0;
foreach($result as &$row){
	$x++;
	echo "<tr><td>$x</td><td>$row[$userID]</td><td>$row[COUNT]</td></tr>";
}
?>
</table>
<a href="https://system32.141412.xyz/db/tools/stats/levelCountStats.php" class="w3-button w3-blue"><< Back</a>
</div>