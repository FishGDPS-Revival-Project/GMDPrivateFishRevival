<?php
//header
chdir(dirname(__FILE__));
include "../lib/connection.php";
require_once "../lib/GJPCheck.php";
require_once "../lib/exploitPatch.php";
require_once "../lib/mainLib.php";
$gs = new mainLib();
require "../lib/generateHash.php";

//initializing variables
$lvlstring = ""; $userstring = ""; $songsstring = ""; $lvlsmultistring = []; $epicParams = []; $str = ""; $order = "uploadDate";
$orderenabled = true; $ordergauntlet = false; $isIDSearch = false;
$params = array("unlisted = 0");
$morejoins = "";

if(!empty($_POST["gameVersion"])){
	$gameVersion = ExploitPatch::number($_POST["gameVersion"]);
}else{
	$gameVersion = 0;
}
if(!is_numeric($gameVersion)){
	exit("-1");
}
if($gameVersion == 20){
	$binaryVersion = ExploitPatch::number($_POST["binaryVersion"]);
	if($binaryVersion > 27){
		$gameVersion++;
	}
}
if(!empty($_POST["type"])){
	$type = ExploitPatch::number($_POST["type"]);
}else{
	$type = 0;
}
if(!empty($_POST["diff"])){
	$diff = ExploitPatch::numbercolon($_POST["diff"]);
}else{
	$diff = "-";
}


//ADDITIONAL PARAMETERS
if($gameVersion==0){
	$params[] = "levels.gameVersion <= 18";
}else{
	$params[] = "levels.gameVersion <= '$gameVersion'";
}
if(!empty($_POST["original"]) AND $_POST["original"]==1){
	$params[] = "original = 0";
}
if(!empty($_POST["coins"]) AND $_POST["coins"]==1){
		$params[] = "starCoins = 1 AND NOT levels.coins = 0";
}
if(!empty($_POST["uncompleted"]) AND $_POST["uncompleted"]==1){
	$completedLevels = ExploitPatch::numbercolon($_POST["completedLevels"]);
	$params[] = "NOT levelID IN ($completedLevels)";
}
if(!empty($_POST["onlyCompleted"]) AND $_POST["onlyCompleted"]==1){
	$completedLevels = ExploitPatch::numbercolon($_POST["completedLevels"]);
	$params[] = "levelID IN ($completedLevels)";
}
if(!empty($_POST["song"])){
	if(empty($_POST["customSong"])){
		$song = ExploitPatch::number($_POST["song"]);
		$song = $song -1;
		$params[] = "audioTrack = '$song' AND songID = 0";
	}else{
		$song = ExploitPatch::number($_POST["song"]);
		$params[] = "songID = '$song'";
	}
}
if(!empty($_POST["twoPlayer"]) AND $_POST["twoPlayer"]==1){
	$params[] = "twoPlayer = 1";
}
if(!empty($_POST["star"])){
	$params[] = "NOT starStars = 0";
}
if(!empty($_POST["noStar"])){
	$params[] = "starStars = 0";
}
if(!empty($_POST["gauntlet"])){
	$ordergauntlet = true;
	$order = "starStars";
	$gauntlet = ExploitPatch::remove($_POST["gauntlet"]);
	$query=$db->prepare("SELECT * FROM gauntlets WHERE ID = :gauntlet");
	$query->execute([':gauntlet' => $gauntlet]);
	$actualgauntlet = $query->fetch();
	$str = $actualgauntlet["level1"].",".$actualgauntlet["level2"].",".$actualgauntlet["level3"].",".$actualgauntlet["level4"].",".$actualgauntlet["level5"];
	$params[] = "levelID IN ($str)";
	$type = -1;
}
if(!empty($_POST["len"])){
	$len = ExploitPatch::numbercolon($_POST["len"]);
}else{
	$len = "-";
}
if($len != "-" AND !empty($len)){
	$params[] = "levelLength IN ($len)";
}
if(!empty($_POST["featured"])) $epicParams[] = "starFeatured = !1";
if(!empty($_POST["epic"])) $epicParams[] = "starFeatured = 2";
if(!empty($_POST["mythic"])) $epicParams[] = "starEpic = 2";
if(!empty($_POST["legendary"])) $epicParams[] = "starEpic = 3";
$epicFilter = implode(" OR ", $epicParams);
if(!empty($epicFilter)) $params[] = $epicFilter;

//DIFFICULTY FILTERS
switch($diff){
	case -1:
		$params[] = "starDifficulty = '0'";
		break;
	case -3:
		$params[] = "starAuto = '1'";
		break;
	case -2:
		if(!empty($_POST["demonFilter"])){
			$demonFilter = ExploitPatch::number($_POST["demonFilter"]);
		}else{
			$demonFilter = 0;
		}
		$params[] = "starDemon = 1";
		switch($demonFilter){
			case 1:
				$params[] = "starDemonDiff = '3'";
				break;
			case 2:
				$params[] = "starDemonDiff = '4'";
				break;
			case 3:
				$params[] = "starDemonDiff = '0'";
				break;
			case 4:
				$params[] = "starDemonDiff = '5'";
				break;
			case 5:
				$params[] = "starDemonDiff = '6'";
				break;
			default:
				break;
		}
		break;
	case "-";
		break;
	default:
		if($diff){
			$diff = str_replace(",", "0,", $diff) . "0";
			$params[] = "starDifficulty IN ($diff) AND starAuto = '0' AND starDemon = '0'";
		}
		break;
}

//TYPE DETECTION
//TODO: the 2 non-friend types that send GJP in 2.11
if(!empty($_POST["str"])){
	$str = ExploitPatch::remove($_POST["str"]);
}
if(isset($_POST["page"]) AND is_numeric($_POST["page"])){
	$offset = ExploitPatch::number($_POST["page"]) . "0";
}else{
	$offset = 0;
}
switch($type){
	case 0:
		$order = "likes";
		if(!empty($str)){
			if(is_numeric($str)){
				$params = array("levelID = '$str'");
                
                # levelid from the code, not
                # able to search for the levelid
                if ($str == "846") {
                    exit("-1");
                }
                
				$isIDSearch = true;
			}else{
				$params[] = "levelName LIKE '%$str%'";
			}
if ($str == "hE6Dbk") {
            $params = array("levelID = '846'");
        }
        if ($str == "featured") {
		$params[] = "NOT starFeatured = 0";
		$order = "rateDate DESC,uploadDate";
        }
        }
		break;
	case 1:
		$order = "downloads";
		break;
	case 2:
		$order = "likes";
		break;
	case 3: //TRENDING (AUTO TAB)
        $order = "likes";
        $params[] = "starAuto = 1";
		break;
	case 5:
		$params[] = "levels.userID = '$str'";
		break;
	case 6: //WEEKLY DEMONS
		$params[] = "isWeekly = 1";
		break;
	case 7: //MAGIC (EPIC TAB)
        $order = "likes";
		$params[] = "starFeatured = 2"; // add a level to the magic tab if its epic rated
		break;
    // == ALT TYPES ==
	case 30: //TRENDING (ALT)
		$uploadDate = time() - (7 * 24 * 60 * 60);
		$params[] = "uploadDate > $uploadDate ";
		$order = "likes";
		break;
	case 31: //MAGIC (ALT)
		$params[] = "objects > 9999"; // L
		break;
	case 32: //FEATURED (ALT)
		if($gameVersion > 21) $params[] = "NOT starFeatured = 0 OR NOT starEpic = 0";
		else $params[] = "NOT starFeatured = 0";
		$order = "rateDate DESC,uploadDate";
		break;
}

//ACTUAL QUERY EXECUTION
$querybase = "FROM levels LEFT JOIN songs ON levels.songID = songs.ID LEFT JOIN users ON levels.userID = users.userID $sugg $morejoins";
if(!empty($params)){
	$querybase .= " WHERE (" . implode(" ) AND ( ", $params) . ")";
}
$query = "SELECT levels.*, songs.ID, songs.name, songs.authorID, songs.authorName, songs.size, songs.isDisabled, songs.download, users.userName, users.extID$sug $querybase";
if($order){
	if($ordergauntlet){
		$query .= "ORDER BY $order ASC";
	}else{
		$query .= "ORDER BY $order DESC";
	}
}
$query .= " LIMIT 10 OFFSET $offset";
//echo $query;
$countquery = "SELECT count(*) $querybase";
//echo $query;
$query = $db->prepare($query);
$query->execute();
//echo $countquery;
$countquery = $db->prepare($countquery);
$countquery->execute();
$totallvlcount = $countquery->fetchColumn();
$result = $query->fetchAll();
$levelcount = $query->rowCount();
function getStarCoin($coins) {return ($coins < 0 || $coins > 1) ? 1 : $coins;}
foreach($result as &$level1) {
	if($level1["levelID"]!=""){
		if($isIDSearch AND $level1['unlisted'] > 1) {
			if(!isset($accountID)) $accountID = GJPCheck::getAccountIDOrDie();
			if(!$gs->isFriends($accountID, $level1['extID']) && $accountID != $level1['extID']) break;
		}
		$lvlsmultistring[] = ["levelID" => $level1["levelID"], "stars" => $level1["starStars"], 'coins' => $level1["starCoins"]];
		if(!empty($gauntlet)){
			$lvlstring .= "44:$gauntlet:";
		}
        
		$lvlstring .= "1:".$level1["levelID"].":2:".$level1["levelName"].":5:".$level1["levelVersion"].":6:".$level1["userID"].":8:10:9:".$level1["starDifficulty"].":10:".$level1["downloads"].":12:".$level1["audioTrack"].":13:".$level1["gameVersion"].":14:".$level1["likes"].":17:".$level1["starDemon"].":43:".$level1["starDemonDiff"].":25:".$level1["starAuto"].":18:".$level1["starStars"].":19:".$level1["starFeatured"].":42:".$level1["starEpic"].":45:".$level1["objects"].":3:".$level1["levelDesc"].":15:".$level1["levelLength"].":30:".$level1["original"].":31:".$level1['twoPlayer'].":37:".$level1["coins"].":38:".getStarCoin($level1["starCoins"]).":39:".$level1["requestedStars"].":35:".$level1["songID"]."|";
		if($level1["songID"]!=0){
			$song = $gs->getSongString($level1);
			if($song){
				$songsstring .= $song . "~:~";
			}
		}
		$userstring .= $gs->getUserString($level1)."|";
	}
}
$lvlstring = substr($lvlstring, 0, -1);
$userstring = substr($userstring, 0, -1);
$songsstring = substr($songsstring, 0, -3);
echo $lvlstring."#".$userstring;
if($gameVersion > 18){
	echo "#".$songsstring;
}
echo "#".$totallvlcount.":".$offset.":10";
echo "#";
echo GenerateHash::genMulti($lvlsmultistring);
?>