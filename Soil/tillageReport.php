<?php session_start(); ?>
<form name='form' class='pure-form pure-form-aligned' method='GET' action='tillageTable.php'>
<input type="hidden" name="tab" value='soil:soil_fert:soil_till:till_report'>
<?php 
include '/Applications/MAMP/htdocs/farmdata/authentication.php';
include '/Applications/MAMP/htdocs/farmdata/connection.php';
include '/Applications/MAMP/htdocs/farmdata/design.php';
?>

<center>
<h2 class="hi"> Tillage Report </h2>
</center>

<div class="pure-control-group">
<label for="from">From:</label> 
<?php 
include '/Applications/MAMP/htdocs/farmdata/date.php';
?>
</div>

<div class="pure-control-group">
<label for="to"> To:</label> 
<?php 
include '/Applications/MAMP/htdocs/farmdata/date_transdate.php';
?>
</div>
<?php
	include '/Applications/MAMP/htdocs/farmdata/fieldID.php';
?>
<br clear="all"/>

<input type="submit" class="submitbutton pure-button wide"  name="submit" value="Submit">
</form>
