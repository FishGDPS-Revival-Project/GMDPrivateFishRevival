This project has been **archived**. There won't be any more updates to this repository due to FishGDPS shutting down.

R.I.P FishGDPS, i guess (2025-2025) and hello FishGDPS Revival Project (2026)
------
# FishGDPS' GMDPrivateServer (Revival Project)

////////////////////////////////////////

Endemanset's note to u all
Yes i'm reviving this and no it's not going to not take long


**Fork of GMDPrivateServer for FishGDPS**

Supported version of Geometry Dash: 1.0 - 1.5, 1.5 is recommended

Required version of PHP: 8.0+

### Setup
1. Upload the files from `src/` on a webserver
2. Import `/database.sql` into a MySQL/MariaDB database
3. Edit the links in the lib files in your Geometry Dash 1.5 APK
4. Modify the password used in logging in at `/incl/misc/rateToolPassword.php`. Default password is `123456`

### Credits

GMDPrivateServer by Cvolton - https://github.com/Cvolton/GNDPrivateServer

Base for account settings and the private messaging system by someguy28

Using this for XOR encryption - https://github.com/sathoro/php-xor-cipher - (incl/lib/XORCipher.php)

Using this for cloud save encryption - https://github.com/defuse/php-encryption - (incl/lib/defuse-crypto.phar)

Most of the stuff in generateHash.php has been figured out by pavlukivan and Italian APK Downloader, so credits to them

Demon, auto, and star/feature/epic rating support in the rate tool by CirnoTheUwU

Using this for the website - https://www.w3schools.com/w3css/default.asp (w3.css)

Nano56 for basically everything

Test devices :


-- Nox Emulator 7.0.6.2 -- x86


-- Bluestacks 5 -- x86


-- SM-T285 (Custom ROM 7.1.2) -- armeabi-v7a / armeabi
