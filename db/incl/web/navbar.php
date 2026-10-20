<!-- import w3.css -->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/5/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=menu" />

<!-- Primary Meta Tags -->
<title>Fish GDPS</title>
<meta name="title" content="FishGDPS" />
<meta name="description" content="The 1.5 GDPS for the modern age, with lots of features" />

<!-- Open Graph / Facebook -->
<meta property="og:type" content="website" />
<meta property="og:url" content="http://f15.mooo.com:25393/tools/" />
<meta property="og:title" content="FishGDPS" />
<meta property="og:description" content="The 1.5 GDPS for the modern age, with lots of features" />
<meta property="og:image" content="http://f15.mooo.com:25393/assets/fishgdps-logo.png" />

<!-- X (Twitter) -->
<meta property="twitter:card" content="summary_large_image" />
<meta property="twitter:url" content="https://metatags.io/" />
<meta property="twitter:title" content="FishGDPS" />
<meta property="twitter:description" content="The 1.5 GDPS for the modern age, with lots of features" />
<meta property="twitter:image" content="http://f15.mooo.com:25393/assets/fishgdps-logo.png" />

<!-- Navigation bar -->
<div class="w3-top">
    <div class="w3-bar w3-blue">
        <a href="http://system32.141412.xyz/" class="w3-bar-item w3-button">FishGDPS</a>
        <a class="w3-bar-item w3-button w3-hide-small" href="http://f15.mooo.com:25393/downloads.php">Downloads</a>
        <a class="w3-bar-item w3-button w3-hide-small" href="http://f15.mooo.com:25393/db/tools">Tools</a>
<?php
        // Safely initiate session only if none exists
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        // Safeguard against uninitialized session keys
        $mod = (isset($_SESSION['admin']) && $_SESSION['admin'] == true) ? $_SESSION['admin'] : false;
        
        if (!$mod) {
            echo '<a class="w3-bar-item w3-button w3-hide-small" href="http://f15.mooo.com:25393/db/tools/modlogin.php">Mod Login</a>';
        } else {
            echo '<a class="w3-bar-item w3-button w3-hide-small" href="http://f15.mooo.com:25393/db/tools/modlogout.php">Mod Logout</a>';
        }
?>

        <a href="javascript:void(0)" class="w3-bar-item w3-button w3-right w3-hide-large w3-hide-medium" onclick="navbar()"><span class="material-symbols-outlined">menu</span></a>
    </div>
    
    <!-- Mobile/Vertical Menu Dropdown -->
    <div id="vertical_navbar" class="w3-bar-block w3-blue w3-hide w3-hide-large w3-hide-medium">
        <a class="w3-bar-item w3-button" href="http://f15.mooo.com:25393/downloads.php">Downloads</a>
        <a class="w3-bar-item w3-button" href="http://f15.mooo.com:25393/db/tools">Tools</a>
<?php
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        $mod = (isset($_SESSION['admin']) && $_SESSION['admin'] == true) ? $_SESSION['admin'] : false;
        
        if (!$mod) {
            echo '<a class="w3-bar-item w3-button" href="http://f15.mooo.com:25393/db/tools/modlogin.php">Mod Login</a>';
        } else {
            echo '<a class="w3-bar-item w3-button" href="http://f15.mooo.com:25393/db/tools/modlogout.php">Mod Logout</a>';
        }
?>
    </div>
</div>
<br><br>

<script>
function navbar() {
  var x = document.getElementById("vertical_navbar");
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
  } else { 
    x.className = x.className.replace(" w3-show", "");
  }
}
</script>
