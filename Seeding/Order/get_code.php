<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/farmdata/connection.php';
$crop = escapehtml($_GET['crop']);
$sYear = $_GET['sYear'];
$org = $_GET['org'];
if ($_GET['isCover'] == "true") {
   $isCover = true;
} else {
   $isCover = false;
}
include 'make_code.php';
echo $code;
?>

