<?php
include $_SERVER['DOCUMENT_ROOT'].'/connection.php';
$crop = escapehtml($_GET['crop']);
$sql="select distinct units from plant where crop='".$crop."'";
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result)) {
   echo $row['units'];
}
?>
