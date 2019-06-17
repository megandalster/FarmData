<?php session_start(); ?>
<?php
include '/Applications/MAMP/htdocs/farmdata/authentication.php';
include '/Applications/MAMP/htdocs/farmdata/design.php';
include '/Applications/MAMP/htdocs/farmdata/connection.php';
include '/Applications/MAMP/htdocs/farmdata/stopSubmit.php';
?>
<center>
<h2> Disease Scouting Report </h2>
</center>
<form name='form' class="pure-form pure-form-aligned" id='test'  method='GET' action="diseaseTable.php">
<input type="hidden" name="tab" 
   value="soil:soil_scout:soil_disease:disease_report">

<div class="pure-control-group">
<label for='date'> From: </label>
<?php
include '/Applications/MAMP/htdocs/farmdata/date.php';
?>
</div>

<div class="pure-control-group">
<label for='date2'> To: </label>
<?php
include '/Applications/MAMP/htdocs/farmdata/date_transdate.php';
?>
</div>

<?php
include '/Applications/MAMP/htdocs/farmdata/fieldID.php';
?>

<div class="pure-control-group">
<label for="disease"> Disease Species: </label>
 <select name ="disease" id="disease" class="mobile-select">
 <option value = "%" selected > All</option>
 <?php
 $result=$dbcon->query("Select diseaseName from disease");
 while ($row1 =  $result->fetch(PDO::FETCH_ASSOC)){
 echo "\n<option value= \"$row1[diseaseName]\">$row1[diseaseName]</option>";
 }
 echo '</select>';
 echo '</div>';
 ?>

<div class="pure-control-group">
<label> Crop: </label>
 <select name ="crop" id="crop" class="mobile-select">
 <option value = "%" selected > All</option>
 <?php
 $result=$dbcon->query("select crop from plant");
 while ($row1 = $result->fetch(PDO::FETCH_ASSOC)){
    echo "\n<option value= '".$row1['crop']."'>".$row1['crop']."</option>";
 }
 echo '</select>';
 echo '</div>';
 ?>

<div class="pure-control-group">
<label for="Stage"> Stage: </label>
 <select name ="stage" id="stage" class="mobile-select">
 <option value = "%" selected > All</option>
 <?php
 $result=$dbcon->query("Select stage from stage");
 while ($row1 = $result->fetch(PDO::FETCH_ASSOC)){
 echo "\n<option value= \"$row1[stage]\">$row1[stage]</option>";
 }
 echo '</select>';
 echo '</div>';
 ?>
<br clear="all"/>
<br clear="all"/>
<input type="submit" class="submitbutton pure-button wide" name="submit" value="Submit">
</body>
</html>
