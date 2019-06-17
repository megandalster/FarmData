<?php session_start(); ?>
<form name='form' class='pure-form pure-form-aligned' method='GET' action='fertTable.php'>
<input type="hidden" name="tab" value='soil:soil_fert:soil_fertilizer:dry_fertilizer:dry_fertilizer_report'>
<?php 
include '/Applications/MAMP/htdocs/farmdata/authentication.php';
include_once '/Applications/MAMP/htdocs/farmdata/connection.php';
include '/Applications/MAMP/htdocs/farmdata/design.php';
?>

<center>
<h2 class="hi"> Dry Fertilizer Report </h2>
</center>
<div class="pure-control-group">
<label for="from">From:</label>
<?php 
include '/Applications/MAMP/htdocs/farmdata/date.php';
echo "</div>";
echo '<div class="pure-control-group">';
echo '<label for="to"> To: </label> ';
include '/Applications/MAMP/htdocs/farmdata/date_transdate.php';
echo "</div>";

include '/Applications/MAMP/htdocs/farmdata/fieldID.php';
?>

<div class="pure-control-group">
<label for="cropDiv"> Crop:  </label>
<select id= "crop" name="crop" class="mobile-select">
<option value="%" selected> All </option>
<?php
$result = $dbcon->query("SELECT crop from plant");
while ($row =  $result->fetch(PDO::FETCH_ASSOC)){
  echo "<option value= '".$row['crop']."'>".$row['crop']."</option>";
}
?>
</select>
</div>

<div class="pure-control-group">
<label for="material"> Material:</label>
<select name="material" id="material" class="mobile-select">
<option value = "%" selected> All </option>
<?php
$result = $dbcon->query("SELECT fertilizerName from fertilizerReference");
while ($row =  $result->fetch(PDO::FETCH_ASSOC)){
  echo "\n<option value= \"$row[fertilizerName]\">$row[fertilizerName]</option>";
}
?>
</select>
</div>

<br clear="all"/>
<br clear="all"/>
<input type="submit" class="submitbutton pure-button wide" name="submit" value="Submit">
</form>
