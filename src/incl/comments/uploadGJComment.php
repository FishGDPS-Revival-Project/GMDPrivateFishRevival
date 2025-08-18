<?php
chdir(dirname(__FILE__));
include "../lib/connection.php";
require_once "../lib/mainLib.php";
$mainLib = new mainLib();
require_once "../lib/GJPCheck.php";
require_once "../lib/exploitPatch.php";
require_once "../lib/commands.php";
include "../incl/getGJComments.php";

$userName = !empty($_POST['userName']) ? ExploitPatch::remove($_POST['userName']) : "";
$gameVersion = !empty($_POST['gameVersion']) ? ExploitPatch::number($_POST['gameVersion']) : 0;
$comment = ExploitPatch::remove($_POST['comment']);
$comment = ($gameVersion < 20) ? base64_encode($comment) : $comment;
$levelID = ($_POST['levelID'] < 0 ? '-' : '').ExploitPatch::number($_POST["levelID"]);
$percent = !empty($_POST["percent"]) ? ExploitPatch::remove($_POST["percent"]) : 0;

$id = $mainLib->getIDFromPost();
$register = is_numeric($id);
$userID = $mainLib->getUserID($id, $userName);
$uploadDate = time();
$decodecomment = base64_decode($comment);
if (Commands::doCommands($id, $decodecomment, $levelID)) {
  exit($gameVersion > 20 ? "temp_0_Command executed successfully!" : "-1");
}

/**
 * block comments on specific level ids
 */

/**
 * *** block specific words	(automod) ***
 */
 // TODO: optimize code
 session_start();
  $_SESSION['info'] = 0;
 if ($_SESSION['b'] = 1) {
 $_SESSION['b'] = 0;
 }
if ($decodecomment = '!info') {
    $_SESSION['info'] = 1;
}

if (str_contains($decodecomment, 'nigga')) {
  // array of random sentences to send
  $sentences = [
    "I did not say anything bad, my mom would ground me for that." => "I did not say anything bad, my mom would ground me for that.",
    "easy 2 atts" => "easy 2 atts",
    "FishGDPS is a very good GDPS!" => "FishGDPS is a very good GDPS!",
    "i would say my iq if i was smarter" => "i would say my iq if i was smarter",
    "the sun is yellow" => "the sun is yellow",
    "please, dislike me" => "please, dislike me",
    "the earth is a heptagon" => "the earth is a heptagon",
    "i did not try to say any slur, trust trust" => "i did not try to say any slur, trust trust",
    "0 degrees is the perfect temperature, not hot, not cold" => "0 degrees is the perfect temperature, not hot, not cold",
    "i eat the cone first in ice creams" => "i eat the cone first in ice creams",
    "i look at my shadow and think that's the demons in my head" => "i look at my shadow and think that's the demons in my head",
    "i think poop and pee jokes are funny" => "i think poop and pee jokes are funny",
    "my favourite colour is the smell of the number b" => "my favourite colour is the smell of the number b",
    "watermelons are a vegetable" => "watermelons are a vegetable"
  ];

  $comment = (array_rand($sentences, 1));
  $comment = ($gameVersion < 20) ? base64_encode($comment) : $comment;
} elseif (str_contains($decodecomment, 'nigger')) {
  // array of random sentences to send
  $sentences = [
    "I did not say anything bad, my mom would ground me for that." => "I did not say anything bad, my mom would ground me for that.",
    "easy 2 atts" => "easy 2 atts",
    "FishGDPS is a very good GDPS!" => "FishGDPS is a very good GDPS!",
    "i would say my iq if i was smarter" => "i would say my iq if i was smarter",
    "the sun is yellow" => "the sun is yellow",
    "please, dislike me" => "please, dislike me",
    "the earth is a heptagon" => "the earth is a heptagon",
    "i did not try to say any slur, trust trust" => "i did not try to say any slur, trust trust",
    "0 degrees is the perfect temperature, not hot, not cold" => "0 degrees is the perfect temperature, not hot, not cold",
    "i eat the cone first in ice creams" => "i eat the cone first in ice creams",
    "i look at my shadow and think that's the demons in my head" => "i look at my shadow and think that's the demons in my head",
    "i think poop and pee jokes are funny" => "i think poop and pee jokes are funny",
    "my favourite colour is the smell of the number b" => "my favourite colour is the smell of the number b",
    "watermelons are a vegetable" => "watermelons are a vegetable"
  ];

  $comment = (array_rand($sentences, 1));
  $comment = ($gameVersion < 20) ? base64_encode($comment) : $comment;
} elseif (str_contains($decodecomment, 'faggot')) {
  // array of random sentences to send
  $sentences = [
    "I did not say anything bad, my mom would ground me for that." => "I did not say anything bad, my mom would ground me for that.",
    "easy 2 atts" => "easy 2 atts",
    "FishGDPS is a very good GDPS!" => "FishGDPS is a very good GDPS!",
    "i would say my iq if i was smarter" => "i would say my iq if i was smarter",
    "the sun is yellow" => "the sun is yellow",
    "please, dislike me" => "please, dislike me",
    "the earth is a heptagon" => "the earth is a heptagon",
    "i did not try to say any slur, trust trust" => "i did not try to say any slur, trust trust",
    "0 degrees is the perfect temperature, not hot, not cold" => "0 degrees is the perfect temperature, not hot, not cold",
    "i eat the cone first in ice creams" => "i eat the cone first in ice creams",
    "i look at my shadow and think that's the demons in my head" => "i look at my shadow and think that's the demons in my head",
    "i think poop and pee jokes are funny" => "i think poop and pee jokes are funny",
    "my favourite colour is the smell of the number b" => "my favourite colour is the smell of the number b",
    "watermelons are a vegetable" => "watermelons are a vegetable"
  ];

  $comment = (array_rand($sentences, 1));
  $comment = ($gameVersion < 20) ? base64_encode($comment) : $comment;
} elseif (str_contains($decodecomment, 'retard')) {
  // array of random sentences to send
  $sentences = [
    "I did not say anything bad, my mom would ground me for that." => "I did not say anything bad, my mom would ground me for that.",
    "easy 2 atts" => "easy 2 atts",
    "FishGDPS is a very good GDPS!" => "FishGDPS is a very good GDPS!",
    "i would say my iq if i was smarter" => "i would say my iq if i was smarter",
    "the sun is yellow" => "the sun is yellow",
    "please, dislike me" => "please, dislike me",
    "the earth is a heptagon" => "the earth is a heptagon",
    "i did not try to say any slur, trust trust" => "i did not try to say any slur, trust trust",
    "0 degrees is the perfect temperature, not hot, not cold" => "0 degrees is the perfect temperature, not hot, not cold",
    "i eat the cone first in ice creams" => "i eat the cone first in ice creams",
    "i look at my shadow and think that's the demons in my head" => "i look at my shadow and think that's the demons in my head",
    "i think poop and pee jokes are funny" => "i think poop and pee jokes are funny",
    "my favourite colour is the smell of the number b" => "my favourite colour is the smell of the number b",
    "watermelons are a vegetable" => "watermelons are a vegetable"
  ];

  $comment = (array_rand($sentences, 1));
  $comment = ($gameVersion < 20) ? base64_encode($comment) : $comment;
}


if ($id != "" AND $comment != "" AND $levelID != "736" AND $levelID != "846") {
  $query = $db->prepare("INSERT INTO comments (userName, comment, levelID, userID, timeStamp, percent) VALUES (:userName, :comment, :levelID, :userID, :uploadDate, :percent)");
  $query->execute([':userName' => $userName, ':comment' => $comment, ':levelID' => $levelID, ':userID' => $userID, ':uploadDate' => $uploadDate, ':percent' => $percent]);
  echo 1;
  if ($register) {
    //TODO: improve this
    if ($percent != 0) {
      $query2 = $db->prepare("SELECT percent FROM levelscores WHERE accountID = :accountID AND levelID = :levelID");
      $query2->execute([':accountID' => $id, ':levelID' => $levelID]);
      $result = $query2->fetchColumn();
      if ($query2->rowCount() == 0) {
        $query = $db->prepare("INSERT INTO levelscores (accountID, levelID, percent, uploadDate)
				VALUES (:accountID, :levelID, :percent, :uploadDate)");
      } else {
        if ($result < $percent) {
          $query = $db->prepare("UPDATE levelscores SET percent=:percent, uploadDate=:uploadDate WHERE accountID=:accountID AND levelID=:levelID");
          $query->execute([':accountID' => $id, ':levelID' => $levelID, ':percent' => $percent, ':uploadDate' => $uploadDate]);
        }
      }
    }
  }
} else {
  echo -1;
}
?>