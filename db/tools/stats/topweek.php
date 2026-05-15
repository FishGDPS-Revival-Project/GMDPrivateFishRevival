<?php
include "../../incl/web/navbar.php";
?>
<div class="w3-container">
<h1>Top Week</h1>
<div class="w3-responsive">
<table class="w3-table w3-striped w3-bordered"><tr class="w3-blue"><th>#</th><th>Username</th><th>Stars</th></tr>
<?php
//error_reporting(0);
include "../../incl/lib/connection.php";
$starsgain = array();
$time = time() - 604800;
$x = 0;
$query = $db->prepare("SELECT users.userID, SUM(actions.value) AS stars, users.userName FROM actions INNER JOIN users ON actions.account = users.userID WHERE type = '9' AND timestamp > :time AND users.isBanned = 0 GROUP BY(users.userID) ORDER BY stars DESC");
$query->execute([':time' => $time]);
$result = $query->fetchAll();
foreach($result as &$gain){
	$x++;
	echo "<tr><td>$x</td><td>${gain['userName']}</td><td>${gain['stars']}</td></tr>";
}
?>
</table>
</div>