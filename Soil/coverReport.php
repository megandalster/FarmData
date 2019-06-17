<?php session_start(); ?>
<form name='form' class='pure-form pure-form-aligned' method='GET' action='coverTable.php'>
<input type="hidden" name="tab" value="soil:soil_fert:soil_cover:soil_coverseed:coverseed_report">
<?php 
include '/Applications/MAMP/htdocs/farmdata/authentication.php';
include '/Applications/MAMP/htdocs/farmdata/connection.php';
include '/Applications/MAMP/htdocs/farmdata/design.php';
echo "<center>";
echo '<h2 class="hi"> Cover Crop Seeding Report </h2>';
echo "</center>";
echo "<fieldset>";
echo '<div class="pure-control-group">';
echo '<label for="from">From:&nbsp;</label> ';
include '/Applications/MAMP/htdocs/farmdata/date.php';
echo "</div>";
echo '<div class="pure-control-group">';
echo '<label for="to"> To:&nbsp;</label> ';
include '/Applications/MAMP/htdocs/farmdata/date_transdate.php';
echo "</div>";
?>
<?php
$active = 'active';
include '/Applications/MAMP/htdocs/farmdata/fieldID.php';
echo "</fieldset>";
?>
<br clear="all">
<input type="submit" class="submitbutton pure-button wide" name="submit" value="Submit">
</form>

