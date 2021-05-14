<?php 
include $_SERVER['DOCUMENT_ROOT'].'/farmdata/connection.php';
$sql="Select * from field_GH where fieldID = '".escapehtml($_GET['fieldID'])."' order by sortOrder";
$result = $dbcon->query($sql);
$arr = array();
$row = $result->fetch(PDO::FETCH_ASSOC);
if ($row) {
  $arr = array($row['size'], $row['numberOfBeds'], $row['length'], $row['active'], $row['sortOrder']);
}
echo json_encode($arr);
?>

