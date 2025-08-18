<?php
error_reporting(0);
chdir(dirname(__FILE__));
echo "Please wait...<br>";
ob_flush();
flush();
/*
if(file_exists("../logs/fixcpslog.txt")){
	$cptime = file_get_contents("../logs/fixcpslog.txt");
	$newtime = time() - 30;
	if($cptime > $newtime){
		$remaintime = time() - $cptime;
		$remaintime = 30 - $remaintime;
		$remainmins = floor($remaintime / 60);
		$remainsecs = $remainmins * 60;
		$remainsecs = $remaintime - $remainsecs;
		exit("Please wait $remainmins minutes and $remainsecs seconds before running ". basename($_SERVER['SCRIPT_NAME'])." again");
	}
}
*/
file_put_contents("../logs/fixcpslog.txt",time());
if(function_exists("set_time_limit")) set_time_limit(0);
$cplog = "";
$people = array();
include "../../incl/lib/connection.php";
//getting users
$query = $db->prepare("UPDATE users
	LEFT JOIN
	(
	    SELECT usersTable.userID, (IFNULL(starredTable.starred, 0) + IFNULL(featuredTable.featured, 0) + (IFNULL(epicTable.epic,0))) as CP FROM (
            SELECT userID FROM users
        ) AS usersTable
        LEFT JOIN
        (
	        SELECT count(*) as starred, userID FROM levels WHERE starStars != 0 GROUP BY(userID) 
	    ) AS starredTable ON usersTable.userID = starredTable.userID
	    LEFT JOIN
	    (
	        SELECT count(*) as featured, userID FROM levels WHERE starFeatured != 0 GROUP BY(userID) 
	    ) AS featuredTable ON usersTable.userID = featuredTable.userID
	    LEFT JOIN
	    (
	        SELECT count(*) as epic, userID FROM levels WHERE starFeatured = 2 GROUP BY(userID) 
	    ) AS epicTable ON usersTable.userID = epicTable.userID
	) calculated
	ON users.userID = calculated.userID
	SET users.creatorPoints = IFNULL(calculated.CP, 0) + users.extraCreatorPoints");
$query->execute();
echo "Calculated base & extra creator points<br>";

/*
	DONE
*/
foreach($people as $user => $cp) {
	$query = $db->prepare("UPDATE users SET creatorPoints = (creatorpoints + $cp) WHERE userID=$user");
	$query->execute();
    echo "$user now has $cp creator points...<br>";
}
echo "<hr>Done fixing creator points";
file_put_contents("../logs/cplog.txt",$cplog);
?>
