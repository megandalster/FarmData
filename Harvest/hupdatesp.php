<?php
include $_SERVER['DOCUMENT_ROOT'].'/farmdata/connection.php';
$sql="Select distinct unit from extUnits";
$result=$dbcon->query($sql);
while ($row=$result->fetch(PDO::FETCH_ASSOC)) {
echo "<option value=\"".$row['unit']."\">".$row['unit']."</option>";
}
?>

