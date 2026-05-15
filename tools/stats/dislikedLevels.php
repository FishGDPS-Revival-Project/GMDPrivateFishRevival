
<?php
include "../../incl/web/navbar.php";
?>
<div class="w3-container">
<h1>Most disliked levels</h1>
<div class="w3-responsive">
<table class="w3-table w3-striped w3-bordered"><tr class="w3-blue"><th>#</th><th>Name</th><th>Likes</th></tr>
<?php
//error_reporting(0);
include "../../incl/lib/connection.php";
$x = 0;
$query = $db->prepare("SELECT * FROM levels ORDER BY likes ASC LIMIT 100");
$query->execute();
$result = $query->fetchAll();
foreach($result as &$gain){
	$x++;
	echo "<tr><td>$x</td><td>${gain['levelName']}</td><td>${gain['likes']}</td></tr>";
}
?>
</table>
<a href="https://system32.141412.xyz/db/tools/stats/levelCountStats.php" class="w3-button w3-blue"><< Back</a>
</div>