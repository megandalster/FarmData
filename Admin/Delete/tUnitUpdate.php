<?php
include '/Applications/MAMP/htdocs/farmdata/connection.php';
$sql="SELECT TRateUnits  FROM tSprayMaterials  where sprayMaterial='".
   escapehtml($_GET['material'])."'";
$result=$dbcon->query($sql);
while ($row=$result->fetch(PDO::FETCH_ASSOC)) {
echo $row['TRateUnits'];

}
?>

