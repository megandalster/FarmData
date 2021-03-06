<?php
include $_SERVER['DOCUMENT_ROOT'].'/farmdata/connection.php';

$fieldName = escapehtml($_GET['fieldName']);
$tableName = escapehtml($_GET['tableName']);

$sql = "";
// Crop
if ($fieldName === "crop") {
	$sql = "SELECT crop FROM plant WHERE active=1";
// FieldID
} else if ($fieldName === "fieldID") {
	$sql = "SELECT fieldID FROM field_GH WHERE active=1";
// Cell
} else if ($fieldName === "cellsFlat") {
	$sql = "SELECT cells FROM flat"; 
// generation
} else if ($fieldName === "gen") {
   if ($tableName === "transferred_to") {
      $sql = "select distinct gen from gh_seeding order by gen";
   } else if ($tableName === "harvested") {
      $sql = "select distinct gen from (select distinct gen from dir_planted union ".
        "select distinct gen from transferred_to) as tmp order by gen";
   } else {
      $sql = "select 0 union select 1 union select 2 union select 3 union select 4 union select 5".
          " union select 6 union select 7 union select 8 union select 9 union select 10".
          " union select 11 union select 12 union select 13 union select 14 union select 15".
          " union select 16 union select 17 union select 18 union select 19 union select 20".
          " union select 21 union select 22 union select 23 union select 24 union select 25".
          " union select 26 union select 27 union select 28 union select 29 union select 30";
   }
}


if ($fieldName === "rowsBed") {
    $array = array(4, 1, 2, 3, 5, 7);
} else if 
	(($fieldName === "seedDate" && $tableName === "transferred_to") ||
	($fieldName === "unit" && $tableName === "harvested") ||
	($fieldName === "fieldID" && $tableName === "harvested")) {
		$array = array();
} else {
	$result = $dbcon->query($sql);
	$array = array();
	$i = 0;
	while ($row = $result->fetch(PDO::FETCH_NUM)) {
		$array[$i] = $row[0];
		$i++;
	}
}

echo json_encode($array);

?>
