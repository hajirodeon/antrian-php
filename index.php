<?
sleep(1);
session_start();

require("inc/config.php");
require("inc/fungsi.php");
require("inc/koneksi.php");





//re-direct ke admin
$ke = "admin/index.php";
xloc($ke);
exit();
?>
