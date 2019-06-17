<?php session_start(); ?>
<?php
include '/Applications/MAMP/htdocs/farmdata/authentication.php';
include '/Applications/MAMP/htdocs/farmdata/design.php';
include '/Applications/MAMP/htdocs/farmdata/connection.php';
?>
<form name='form' id='test' class='pure-form pure-form-aligned' method='GET' action="compostTable.php">
<input type="hidden" name="tab" value="soil:soil_fert:soil_compost:compost_report">
<center>
<h2 class="hi"> Compost Report </h2>
</center>
<div class="pure-control-group">
<label for='date'> From:</label>
<?php
include '/Applications/MAMP/htdocs/farmdata/date.php';
?>
</div>
<div class="pure-control-group">
<label for='date2'> To:</label>
<?php
include '/Applications/MAMP/htdocs/farmdata/date_transdate.php';
?>
</div>

<div class="pure-control-group">
<label for='pileIDlabel'>Pile ID:</label>
<select class='mobile-select' id='pileID' name='pileID'>
<option value='%'>All</option>
<?php
$result = $dbcon->query("Select pileID from compost_pile");
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
	echo "<option value='".$row['pileID']."'>".$row['pileID']."</option>";
}
?>
</select>
</div>

<?php
	$active = 'active';
	include '/Applications/MAMP/htdocs/farmdata/fieldID.php';
?>

<br clear="all"/>
<input type="submit" class = "genericbutton pure-button wide" name="submit" value="Submit">
</form>

