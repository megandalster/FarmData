<?php session_start();?>
<?php

include $_SERVER['DOCUMENT_ROOT'].'/farmdata/Admin/authAdmin.php';
include $_SERVER['DOCUMENT_ROOT'].'/farmdata/connection.php';
include $_SERVER['DOCUMENT_ROOT'].'/farmdata/design.php';
include $_SERVER['DOCUMENT_ROOT'].'/farmdata/Soil/clearForm.php';

$id=$_GET['id'];
$origYear = $_GET['year'];
$origMonth = $_GET['month'];
$origDay = $_GET['day'];
$origFieldID = $_GET['fieldID'];
$tcurYear = $_GET['tyear'];
$tcurMonth = $_GET['tmonth'];
$tcurDay = $_GET['tday'];

$sqlget = "SELECT id,year(sDate) as yr, month(sDate) as mth, day(sDate) as dy, weed, hours,".
   "sDate,fieldID, infestLevel, goneToSeed, comments, filename FROM weedScout where id = ".$id;
$sqldata = $dbcon->query($sqlget);
$row = $sqldata->fetch(PDO::FETCH_ASSOC);
$field = $row['fieldID'];
$weed = $row['weed'];
$infestLevel = $row['infestLevel'];
$com = $row['comments'];
$curYear = $row['yr'];
$curMonth = $row['mth'];
$curDay = $row['dy'];
$goneToSeed = $row['goneToSeed'];
$comments = $row['comment'];
$filename = $row['filename'];
$hours = $row['hours'];
echo "<form name='form' class='pure-form pure-form-aligned' method='post' action=\"".$_SERVER['PHP_SELF'].
   "?tab=soil:soil_scout:soil_weed:weed_report&year=".$origYear.
   "&month=".$origMonth."&day=".$origDay."&tyear=".$tcurYear.
   "&tmonth=".$tcurMonth."&tday=".$tcurDay."&weed=".
   encodeURIComponent($_GET['weed']).
   "&fieldID=".encodeURIComponent($origFieldID)."&id=".$id."\" enctype='multipart/form-data'>";
echo "<center>";
echo "<H2> Edit Weed Record </H2>";
echo "</center>";

echo '<div class="pure-control-group">';
echo '<label>Date:</label> ';
echo '<select name="month" id="month">';
echo '<option value='.$curMonth.' selected>'.date("F", mktime(0,0,0, $curMonth,10)).' </option>';
for($mth = 1; $mth < 13; $mth++) {echo "\n<option value =\"$mth\">".date("F", mktime(0, 0, 0, $mth, 10))."</option>";
}
echo '</select>';
echo '<select name="day" id="day">';
echo '<option value='.$curDay.' selected>'.$curDay.' </option>';
for($day = $curDay - $curDay+1; $day < 32; $day++) {echo "\n<option value =\"$day\">$day</option>";
}
echo '</select>';
echo '<select name="year" id="year">';
echo '<option value='.$curYear.' selected>'.$curYear.'</option>';
for($yr = $curYear - 3; $yr < $curYear+5; $yr++) {echo "\n<option value =\"$yr\">$yr</option>";
}
echo '</select></div>';

echo '<div class="pure-control-group">';
echo '<label>Infest Level:</label> ';
echo '<select name="infestLevel" id="infestLevel">';
echo '<option value="'.$infestLevel.'" selected>'.$infestLevel.' </option>';
echo '<option>0</option> <option>1</option> <option>2</option> <option>3</option>';
echo '</select></div>';

echo '<div class="pure-control-group">';
echo '<label>Weed:</label> ';
echo '<select name="weed" id="weed">';
echo '<option value="'.$weed.'" selected>'.$weed.' </option>';
$sql = 'select weedName from weed';
$sqldata = $dbcon->query($sql);
while ($row = $sqldata->fetch(PDO::FETCH_ASSOC)) {
   echo '<option value="'.$row['weedName'].'">'.$row['weedName'].' </option>';
}
echo '</select></div>';

echo '<div class="pure-control-group">';
echo '<label>Name of Field:</label> ';
echo '<select name="fieldID" id="fieldID">';
echo '<option value="'.$field.'" selected>'.$field.' </option>';
$sql = 'select fieldID from field_GH where active = 1';
$sqldata = $dbcon->query($sql);
while ($row = $sqldata->fetch(PDO::FETCH_ASSOC)) {
   echo '<option value="'.$row['fieldID'].'">'.$row['fieldID'].' </option>';
}
echo '</select></div>';

echo '<div class="pure-control-group">';
echo '<label>Gone To Seed:</label> ';
echo '<select name="g2seed" id="g2seed">';
echo '<option value ="'.$goneToSeed.'">'.$goneToSeed.'</option> <option>0</option> <option>25</option> <option>50</option> <option>75</option> <option>100</option> </select></div>';

echo '<div class="pure-control-group">';
echo '<label>Current Picture: </label>';
if ($filename == "") {
   echo "None";
   echo "</div>";
} else {
   $pos = strrpos($filename, "/");
   echo "<input readonly class='textbox2 mobile-input' type='text' value='";
   echo substr($filename, $pos + 1);
   echo "'/>";
   echo "</div>";
   echo "\n\n";
   echo '<div class="pure-control-group">';
   echo "\n";
   echo '<label for="del">Delete: </label>';
   echo "\n";
   echo '<input type="checkbox" id="del" name="del">';
   echo "\n";
   echo '</div>';
   echo "\n";
}
?>

<div class="pure-control-group" id="filediv">
<label for="file">Upload New Picture (optional): </label>
<input type="file" name="fileIn" id="file">
</div>

<div class="pure-control-group">
<label for="clear">Max File Size: 2 MB </label>
<input type="button" value="Clear Picture" onclick="clearForm();">
</div>

<?php
if ($_SESSION['labor']) {
   echo '<div class="pure-control-group">';
   echo "\n";
   echo '<label>Hours:</label>';
   echo "\n";
   echo '<input type="text" class="textbox2" name="hours" id="hours" value="'.$hours.'">';
   echo "\n";
   echo '</div>';
   echo "\n";
}

echo '<div class="pure-control-group">';
echo '<label>Comments:</label> ';
echo "<textarea rows=\"5\" cols=\"30\" name = \"comments\" id = \"comments\" >";
echo $com;
echo "</textarea>";
echo "</div>";
echo '<br clear="all"/>';
echo '<br clear="all"/>';
echo "<input type='submit' name='submit' value='Update Record' class = 'submitbutton pure-button wide'>";
echo "</form>";
if ($_POST['submit']) {
   $comSanitized = escapehtml($_POST['comments']);
   $weed = escapehtml($_POST['weed']);
   $infestLevel = escapehtml($_POST['infestLevel']);
   $fld = escapehtml($_POST['fieldID']);
   $goneToSeed = escapehtml($_POST['g2seed']);
   $year = escapehtml($_POST['year']);
   $month = escapehtml($_POST['month']);
   $day = escapehtml($_POST['day']);
   $hours = 0;
   if ($_SESSION['labor']) {
      $hours = escapehtml($_POST['hours']);
      if ($hours == "") {
         $hours = 0;
      }
   }
   $sql = "update weedScout set infestLevel='".$infestLevel."', fieldID='".$fld."', sDate='".$year."-".
     $month."-".$day."', weed='".$weed."',goneToSeed=".$goneToSeed.",comments='".
     $comSanitized."', hours=".$hours." where id=".$id;
   try {
      $stmt = $dbcon->prepare($sql);
      $stmt->execute();
   } catch (PDOException $p) {
      phpAlert('', $p);
      die();
   }

   include $_SERVER['DOCUMENT_ROOT'].'/farmdata/Soil/imageEdit.php';

   if ($newfile != "") {
      $sql = "update weedScout set filename=";
      if ($newfile == "null") {
         $sql .= "null";
      } else {
         $sql .= "'".$newfile."'";
      }
      $sql .= " where id=".$id;
      try {
         $stmt = $dbcon->prepare($sql);
         $stmt->execute();
      } catch (PDOException $p) {
         phpAlert('', $p);
         die();
      }
   }

   echo "<script>showAlert(\"Entered data successfully!\");</script> \n";
   echo '<meta http-equiv="refresh" content="0;URL=weedTable.php?year='.$origYear.
     '&month='.$origMonth.'&day='.$origDay.'&tyear='.$tcurYear.
     '&tmonth='.$tcurMonth.'&tday='.$tcurDay."&fieldID=".
     encodeURIComponent($_GET['fieldID']).
     "&weed=".encodeURIComponent($_GET['weed']).
     "&tab=soil:soil_scout:soil_weed:weed_report\">";
}
?>
