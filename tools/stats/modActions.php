<meta name="viewport" content="width=device-width, initial-scale=1.0">

<?php
include "../../incl/lib/connection.php";
require "../../incl/lib/mainLib.php";
$gs = new mainLib();
?>

<h1>Actions Log</h1>
<table border="1"><tr><th>Username</th><th>Action</th><th>Value</th><th>Value2</th><th>Time</th></tr>
<?php
$query = $db->prepare("SELECT modactions.*, users.userName FROM modactions INNER JOIN users ON modactions.user = users.userID ORDER BY ID DESC");
$query->execute();
$result = $query->fetchAll();
foreach($result as &$action){
	//detecting action
	$value = $action["value"];
	$value2 = $action["value2"];
	$user = $action["userName"];
	switch($action["type"]){
		case 1:
			$actionname = "Rated a level";
			break;
        case 2:
			$actionname = "Unrated a level";
			break;
        case 3:
			$actionname = "Upload banned a user";
			break;
		case 4:
			$actionname = "Upload unbanned a user";
			break;
		case 5:
			$actionname = "Deleted a level";
			break;
		case 6:
			$actionname = "Set weekly level";
			break;
		default:
			$actionname = 'Invalid type ('.$action["type"].')';
			break;
		}
	if($action["type"] == 2 OR $action["type"] == 3 OR $action["type"] == 4 OR $action["type"] == 15){
		if($action["value"] == 1){
			$value = "True";
		}else{
			$value = "False";
		}
	}
	if($action["type"] == 5 OR $action["type"] == 6){
		$value = "";
	}
	$time = date("d/m/Y G:i:s", $action["timestamp"]);
	if($action["type"] == 5 AND $action["value2"] > time()){
		echo "<tr><td>".$user."</td><td>".$actionname."</td><td>".$value."</td><td>".$value2."</td><td>".$time."</td></tr>";
	}else{
		echo "<tr><td>".$user."</td><td>".$actionname."</td><td>".$value."</td><td>".$value2."</td><td>".$time."</td></tr>";
	}
	
}
?>
</table>