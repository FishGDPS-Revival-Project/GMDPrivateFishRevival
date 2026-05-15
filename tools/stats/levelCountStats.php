<?php
include "../../incl/web/navbar.php";
?>
<div class="w3-container">
<h1>Additional useless stats!</h1>
<h2>Most liked and disliked level</h2>
<div class="w3-responsive">
<table class="w3-table w3-striped w3-bordered"><tr class="w3-blue"><th>Name</th><th>Likes</th><th>ID</th></tr>
<?php
//error_reporting(0);
include "../../incl/lib/connection.php";
$query = $db->prepare("SELECT likes FROM levels ORDER BY likes DESC LIMIT 1");
$query->execute();
$likes = $query->fetchColumn();
$query = $db->prepare("SELECT levelName FROM levels ORDER by likes DESC LIMIT 1");
$query->execute();
$name = $query->fetchColumn();
$query = $db->prepare("SELECT levelID FROM levels ORDER by likes DESC LIMIT 1");
$query->execute();
$id = $query->fetchColumn();
echo "<tr><td>$name</td><td>$likes</td><td>$id</id></tr>";

$query = $db->prepare("SELECT likes FROM levels ORDER BY likes ASC LIMIT 1");
$query->execute();
$likes = $query->fetchColumn();
$query = $db->prepare("SELECT levelName FROM levels ORDER by likes ASC LIMIT 1");
$query->execute();
$name = $query->fetchColumn();
$query = $db->prepare("SELECT levelID FROM levels ORDER by likes ASC LIMIT 1");
$query->execute();
$id = $query->fetchColumn();
echo "<tr><td>$name</td><td>$likes</td><td>$id</td></tr>";
?>
</table>
<a href="https://system32.141412.xyz/db/tools/stats/dislikedLevels.php" class="w3-button w3-blue" style="margin-top:7px">More Info</a>

<h2>Most commented level</h2>
<table class="w3-table w3-striped w3-bordered"><tr class="w3-blue"><th>Name</th><th>Comments</th><th>ID</th></tr>
<?php
$query = $db->prepare("SELECT COUNT(*) FROM comments GROUP BY levelID HAVING COUNT(*) > 29");
$query->execute();
$comments = $query->fetchColumn();

$query = $db->prepare("SELECT levelID FROM comments GROUP BY levelID HAVING COUNT(*) > 29");
$query->execute();
$levelID = $query->fetchColumn();

$query = $db->prepare("SELECT levelName FROM levels WHERE levelID = $levelID");
$query->execute();
$result = $query->fetchColumn();

echo "<tr><td>$result</td><td>$comments</td><td>$levelID</td></tr>";
?>
</table>
<a href="https://system32.141412.xyz/db/tools/stats/commentedLevels.php" class="w3-button w3-blue" style="margin-top:7px">More Info</a>

<h2>Least downloaded level</h2>
<table class="w3-table w3-striped w3-bordered"><tr class="w3-blue"><th>Type</th><th>Name</th><th>Downloads</th><th>ID</th></tr>
<?php
$query = $db->prepare("SELECT levelID FROM levels ORDER BY downloads ASC LIMIT 1");
$query->execute();
$levelID = $query->fetchColumn();

$query = $db->prepare("SELECT downloads FROM levels WHERE levelID = $levelID");
$query->execute();
$downloads = $query->fetchColumn();

$query = $db->prepare("SELECT levelName FROM levels WHERE levelID = $levelID");
$query->execute();
$name = $query->fetchColumn();

echo "<tr><td>1. In General</td><td>$name</td><td>$downloads</td><td>$levelID</td></tr>";

$query = $db->prepare("SELECT levelID FROM levels WHERE starStars > 0 AND unlisted = 0 ORDER BY downloads ASC LIMIT 1");
$query->execute();
$levelID = $query->fetchColumn();

$query = $db->prepare("SELECT downloads FROM levels WHERE levelID = $levelID");
$query->execute();
$downloads = $query->fetchColumn();

$query = $db->prepare("SELECT levelName FROM levels WHERE levelID = $levelID");
$query->execute();
$name = $query->fetchColumn();

echo "<tr><td>2. Rated</td><td>$name</td><td>$downloads</td><td>$levelID</td></tr>";

?>
</table>
<a href="https://system32.141412.xyz/db/tools/stats/downloadedLevels.php" class="w3-button w3-blue" style="margin-top:7px">More Info</a>

<h2>Most liked and disliked comments</h2>
<table class="w3-table w3-striped w3-bordered"><tr class="w3-blue"><th>Comment</th><th>Name</th><th>Likes</th><th>ID</th></tr>
<?php
$query = $db->prepare("SELECT commentID FROM comments ORDER BY likes ASC LIMIT 1");
$query->execute();
$commentID = $query->fetchColumn();

$query = $db->prepare("SELECT userName FROM comments WHERE commentID = $commentID");
$query->execute();
$userName = $query->fetchColumn();

$query = $db->prepare("SELECT comment FROM comments WHERE commentID = $commentID");
$query->execute();
$ec = $query->fetchColumn();
$comment = base64_decode($ec);

$query = $db->prepare("SELECT likes FROM comments WHERE commentID = $commentID");
$query->execute();
$likes = $query->fetchColumn();

echo "<tr><td>$comment</td><td>$userName</td><td>$likes</td><td>$commentID</td></tr>";

$query = $db->prepare("SELECT commentID FROM comments ORDER BY likes DESC LIMIT 1");
$query->execute();
$commentID = $query->fetchColumn();

$query = $db->prepare("SELECT userName FROM comments WHERE commentID = $commentID");
$query->execute();
$userName = $query->fetchColumn();

$query = $db->prepare("SELECT comment FROM comments WHERE commentID = $commentID");
$query->execute();
$ec = $query->fetchColumn();
$comment = base64_decode($ec);

$query = $db->prepare("SELECT likes FROM comments WHERE commentID = $commentID");
$query->execute();
$likes = $query->fetchColumn();

echo "<tr><td>$comment</td><td>$userName</td><td>$likes</td><td>$commentID</td></tr>";

$h = 'b';
echo "i am a $h";


?>
</table>
<a href="https://system32.141412.xyz/db/tools/stats/likedComments.php" class="w3-button w3-blue" style="margin-top:7px">More Info</a>




</div>