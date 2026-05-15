<?php
include "../../incl/web/navbar.php";
?>
<div class="w3-container">
<h1>Most commented levels</h1>
<div class="w3-responsive">
<table class="w3-table w3-striped w3-bordered"><tr class="w3-blue"><th>#</th><th>Level Name</th><th>Comments</th></tr>
<?php
include "../../incl/lib/connection.php";
$query = $db->prepare("SELECT levelID, COUNT(*) AS COUNT FROM comments GROUP BY levelID ORDER BY COUNT(*) DESC LIMIT 100");
$query->execute();
$result = $query->fetchAll();


$levelID = 'levelID';

foreach($result as &$row) {
if (isset($row[$levelID])) {
$id = $row[$levelID];
$query = $db->prepare("SELECT levelName FROM levels WHERE levelID = $id");
$query->execute();
$row[$levelID] = $query->fetchColumn();
}
}

$x = 0;
foreach($result as &$row){
	$x++;
	echo "<tr><td>$x</td><td>$row[levelID]</td><td>$row[COUNT]</td></tr>";
}
?>
</table>
<a href="https://system32.141412.xyz/db/tools/stats/levelCountStats.php" class="w3-button w3-blue"><< Back</a>

<a href="https://system32.141412.xyz/db/tools/stats/commentedUsers.php" class="w3-button w3-red">Users</a>
</div>