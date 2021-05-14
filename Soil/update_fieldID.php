<?php
include $_SERVER['DOCUMENT_ROOT'].'/farmdata/connection.php';

//$crop = escapehtml($_GET['crop']);
$sql = "SELECT distinct fieldID from field_GH where active=1 and fieldID not in ".
   "(select fieldID from field_irrigation) order by sortOrder";
$result = $dbcon->query($sql);
while($row = $result->fetch(PDO::FETCH_ASSOC)) {
echo "<option value=\"".$row['fieldID']."\">".$row['fieldID']."</option>";
}
?>

