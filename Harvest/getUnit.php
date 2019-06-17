<?php
include '/Applications/MAMP/htdocs/farmdata/connection.php';
$crop = escapehtml($_GET['crop']);
$farm = escapehtml($_GET['farm']);
if ($farm == 'wahlst_spiralpath') {
  $sql = "select distinct unit as units from extUnits";
} else {
  $sql="Select distinct unit as units from units where crop='".$crop."'";
}
$result=$dbcon->query($sql);
while ($row=$result->fetch(PDO::FETCH_ASSOC)) {
   echo "<option value=\"".$row['units']."\">".$row['units']."</option>";
}
?>

