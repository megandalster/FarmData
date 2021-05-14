<?php session_start();?>
<?php
include $_SERVER['DOCUMENT_ROOT'].'/farmdata/authentication.php';
include $_SERVER['DOCUMENT_ROOT'].'/farmdata/design.php';
include $_SERVER['DOCUMENT_ROOT'].'/farmdata/connection.php';
?>

<form name='form' method='GET' class='pure-form pure-form-aligned' action='dir_table.php'>
<input type="hidden" name="tab" value="seeding:direct:direct_report">
<center>
<h2 class="hi">Direct Seeding Report </h2>
</center>
<fieldset>
<div class='pure-control-group'>
<label for='from'>From:</label>
<?php
include $_SERVER['DOCUMENT_ROOT'].'/farmdata/date.php'; 
echo "</div>";
echo "<div class='pure-control-group'>";
echo "<label for='to'>To:</label>";
if ($_SESSION['mobile']) echo "<br clear='all'/>";
include $_SERVER['DOCUMENT_ROOT'].'/farmdata/date_transdate.php';
echo "</div>";
?>
<div class='pure-control-group'>
<label for="crop">Crop:</label>
<select name='crop' class='mobile-select'>
<option value = "%" selected="selected"> All </option>
<?php
$result = $dbcon->query("SELECT distinct  crop from dir_planted");
while ($row1 =  $result->fetch(PDO::FETCH_ASSOC)){
  echo "\n<option value= \"$row1[crop]\">$row1[crop]</option>";
}
?>
</select>
</div>
<div class='pure-control-group'>
<label for="fieldID">Name of Field:</label>
<select name='fieldID' class='mobile-select'>
<option value = "%" selected="selected"> All </option>
<?php
$result = $dbcon->query("Select fieldID from field_GH order by sortOrder");
while ($row1 =  $result->fetch(PDO::FETCH_ASSOC)){
  echo "\n<option value= \"$row1[fieldID]\">$row1[fieldID]</option>";
}
?>
</select>
</div>
<?php
if ($_SESSION['gens']) {
   echo "<div class='pure-control-group'>";
   echo '<label for="genSel">Succession #:</label> ';
   echo '<select name="genSel" class="mobile-select">';
   echo '<option value = "%" selected="selected"> All </option>';
   $result = $dbcon->query("SELECT distinct gen from dir_planted order by gen");
   while ($row1 =  $result->fetch(PDO::FETCH_ASSOC)){
     echo "\n<option value= \"$row1[gen]\">$row1[gen]</option>";
   }
   echo '</select>';
   echo '</div>';
} else {
   echo '<input type="hidden" name="genSel" value="%">';
}
?>
<br clear="all"/>
<br clear="all"/>
<input class='submitbutton pure-button wide' type="submit" name="submit" value="Submit">
</fieldset>
</form>
