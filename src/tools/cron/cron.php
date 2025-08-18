<?php
include "../../incl/web/navbar.php";
?>
<div class="w3-container">
<h1>Cron</h1>
<p>Want to apply patches? <a href="../cleanup/applyPatches.php">Apply patches here!</a></p>
<br>
<?php
chdir(dirname(__FILE__));
include "fixcps.php";
ob_flush();
flush();
include "autoban.php";
ob_flush();
flush();
include "removeBlankLevels.php";
ob_flush();
flush();
include "fixnames.php";
ob_flush();
flush();
echo "Cron done";
file_put_contents("../logs/cronlastrun.txt",time());
?>
</div>