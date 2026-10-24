<?php
include "../../incl/web/navbar.php";
?>
<div class="w3-container">
<h1>Most disliked levels</h1>
<?php
if (!empty($_GET["userID"])) {
    $userID = $_GET["userID"];
    echo "user id $userID";
    echo '<div class="w3-responsive">
    <table class="w3-table w3-striped w3-bordered"><tr class="w3-blue"><th>Level</th><th>Downloads</th><th>Likes</th></tr>
    ';
    include "../../incl/lib/connection.php";
    $query = $db->prepare("SELECT * FROM levels WHERE userID = $userID ASC");
    $query->execute();
    $result = $query->fetchAll();
    foreach($result as &$gain){
        echo "<tr><td><b>${gain['levelName']}</b></td><td>${gain['downloads']}</td><td>${gain['likes']}</td></tr>";
    }
} else {
    echo "";
}
?>
</table>
</div>