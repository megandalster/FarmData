<?php session_start(); ?>
<?php
include $_SERVER['DOCUMENT_ROOT'].'/farmdata/authentication.php';
include $_SERVER['DOCUMENT_ROOT'].'/farmdata/design.php';
include $_SERVER['DOCUMENT_ROOT'].'/farmdata/connection.php';
include $_SERVER['DOCUMENT_ROOT'].'/farmdata/stopSubmit.php';
?>
<center>
<h2> Insect Scouting Report </h2>
</center>
<form name='form' class='pure-form pure-form-aligned' id='test'  method='GET' action="pestTable.php">
<input type="hidden" name="tab" value="soil:soil_scout:soil_pest:pest_report">

<div class="pure-control-group">
<label for='date'> From: </label>
<?php
include $_SERVER['DOCUMENT_ROOT'].'/farmdata/date.php';
?>
</div>

<div class="pure-control-group">
<label for='date2'> To: </label>
<?php
include $_SERVER['DOCUMENT_ROOT'].'/farmdata/date_transdate.php';
?>
</div>

<?php
include $_SERVER['DOCUMENT_ROOT'].'/farmdata/fieldID.php';
?>

<div class="pure-control-group">
<label for="crop"> Crop: </label>
 <select name ="crop" id="crop" class="mobile-select">
 <option value = "%" selected > All</option>
 <?php
 $result=$dbcon->query("Select crop from plant");
 while ($row1 =  $result->fetch(PDO::FETCH_ASSOC)){
 echo "\n<option value= \"$row1[crop]\">$row1[crop]</option>";
 }
 echo '</select>';
 echo '</div>';
 ?>

<div class="pure-control-group">
<label for="pest"> Insect: </label>
 <select name ="pest" id="pest" class="mobile-select">
 <option value = "%" selected > All</option>
 <?php
 $result=$dbcon->query("Select pestName from pest");
 while ($row1 = $result->fetch(PDO::FETCH_ASSOC)){
 echo "\n<option value= \"$row1[pestName]\">$row1[pestName]</option>";
 }
 echo '</select>';
 echo '</div>';
 ?>
<br clear="all"/>
<br clear="all"/>

<input type="submit" class="submitbutton pure-button wide" name="submit" value="Submit">
</form>

