<?php
include "../../incl/web/navbar.php";
?>
<div class="w3-container">
<h1>Top Leaderboards</h1>
<div class="w3-responsive">
<table class="w3-table w3-striped w3-bordered"><tr class="w3-blue"><th>#</th><th>Username</th><th>Stars</th><th>Demons</th><th>Creator Points</th><th>UserID</th></tr>
<?php
include "../../incl/lib/connection.php";
$starsgain = array();
$x = 0;
$order = 'stars';
$query = $db->prepare("SELECT users.userID, SUM(actions.value) AS stars, demons, creatorPoints, lastPlayed, users.userName FROM actions INNER JOIN users ON actions.account = users.userID WHERE type = '9' AND users.isLeaderboardBanned = 0 GROUP BY(users.userID) ORDER BY $order DESC");
$query->execute();
$result = $query->fetchAll();

# convert lastPlayed to readable date

foreach($result as &$gain){
    # icon
    $query = $db->prepare("SELECT icon FROM users WHERE userID=${gain['userID']}");
    $query->execute();
    $icon = $query->fetchColumn();

    # color 1
    $query = $db->prepare("SELECT color1 FROM users WHERE userID=${gain['userID']}");
    $query->execute();
    $color1 = $query->fetchColumn();

    # color 2
    $query = $db->prepare("SELECT color2 FROM users WHERE userID=${gain['userID']}");
    $query->execute();
    $color2 = $query->fetchColumn();
    
	$x++;
	echo "<tr><td>$x</td><td><img height=\"16\" src=\"https://gdicon.oat.zone/icon.png?type=cube&value=$icon&color1=$color1&color2=$color2\"> <a href=\"http://system32.141412.xyz/db/tools/stats/userstat.php?userID=${gain['userID']}\">${gain['userName']}</a></td><td>${gain['stars']}</td><td>${gain['demons']}</td><td>${gain['creatorPoints']}</td><td><code>${gain['userID']}</code></td></tr>";
}
?>
</table>
</div>