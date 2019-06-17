<?php session_start(); ?>
<?php
include '/Applications/MAMP/htdocs/farmdata/authentication.php';
include '/Applications/MAMP/htdocs/farmdata/design.php';
include '/Applications/MAMP/htdocs/farmdata/connection.php';
include '/Applications/MAMP/htdocs/farmdata/stopSubmit.php';
?>
<head>
   <link rel="stylesheet" href="/farmdata/pure-release-0.5.0/pure-min.css">
</head>
<form name='form' class='pure-form pure-form-aligned' method='post' action="pumpTable.php?tab=soil:soil_irrigation:pump_report">
   <center>
   <h2 class="hi"> Pump Log Report</h2>
   </center>
   <fieldset>
      <div class='pure-control-group'>
         <label for="from">From:</label>
         <?php
         include '/Applications/MAMP/htdocs/farmdata/date.php';
         ?>
      </div>
      <div class='pure-control-group'>
         <label for="to">To: </label>
         <?php
         include '/Applications/MAMP/htdocs/farmdata/date_transdate.php';
         ?>
      </div>

      <br clear="all"/>
         <input type="submit" class="submitbutton pure-button wide" name="submit" value="Submit">
</fieldset>
</form>
