<?php
// 1. Start the session safely at the absolute top before any text or HTML is output
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="description" content="Tools page of FishGDPS" />
    <meta name="og:type" content="website" />
    <meta name="og:title" content="FishGDPS Tools" />
    <meta name="og:description" content="FishGDPS tools page" />
    <title>FishGDPS</title>
</head>
<body>

<?php
// 2. Include the navbar component safely
include "../incl/web/navbar.php";

// 3. Handle session state notifications
if (isset($_SESSION['state'])) {
    switch ($_SESSION['state']) {
        case 1:
            echo '<div class="w3-card-4">
              <div class="w3-container w3-blue">
                <h3>Succesfully logged in.</h3>
              </div>
            </div>';
            break;
        case 2:
            echo '<div class="w3-card-4">
              <div class="w3-container w3-blue">
                <h3>Succesfully logged out.</h3>
              </div>
            </div>';
            break;
    }
    $_SESSION['state'] = 0;
}
?>

<div class="w3-container">
    <h1>Tools</h1>
    
    <h2>Utilities</h2>
    <ul>
      <li><a href="https://www.randomb.xyz/api/gmdexport.php?server=fish">Level to .gmd (tool by RandomB)</a></li>
      <li><a href="randomizer.php">Level Randomizer</a></li>
      <li><a href="userRandomizer.php">User Randomizer</a></li>
    </ul>
    
    <h2>Stats related tools:</h2>
    <ul>
      <li><a href="stats/modActions.php">Mod Actions</a></li>
      <li><a href="stats/stats.php">Level/Demon/User Stats</a></li>
      <li><a href="../tools/stats/levelCountStats.php">Extra Stats</a></li>
    </ul>
    
    <h3>Top leaderboards:</h3>
    <ul>
      <li><a href="stats/top24h.php">Top 24 Hours</a></li>
      <li><a href="stats/topweek.php">Top Week</a></li>
      <li><a href="stats/top30d.php">Top 30 Days</a></li>
      <li><a href="stats/leaderboard.php"><b>Extended Leaderboard</b></a></li>
    </ul>
    
    <h2>Misc tools:</h2>
    <ul>
      <li><a href="cron/cron.php">Cron</a></li>
      <li><a href="cleanup/applyPatches.php">Apply Patches</a></li>
    </ul>

    <?php
    // 4. Safely check if the user is a moderator or administrator
    if (!empty($_SESSION['admin'])) {
        echo '<h2>Moderator Utilities</h2>
        <ul>
            <li><a href="rateLevel.php">Rate/unrate level</a></li>
            <li><a href="deleteLevel.php">Delete level</a></li>
            <li><a href="uploadBan.php">Upload ban/unban user</a></li>
            <li><a href="leaderboardBan.php">Leaderboard ban/unban user</a></li>
            <li><a href="setWeekly.php">Set weekly level</a></li>
        </ul>';
    }
    ?>
</div>

</body>
</html>
