<?php session_start();?>
<?php
include $_SERVER['DOCUMENT_ROOT'].'/farmdata/authentication.php';
include $_SERVER['DOCUMENT_ROOT'].'/farmdata/design.php';
include $_SERVER['DOCUMENT_ROOT'].'/farmdata/connection.php';
include $_SERVER['DOCUMENT_ROOT'].'/farmdata/stopSubmit.php';
?>

<center>
<h2 >Tray Seeding Input Form</h2>
</center>
<form name='form' class='pure-form pure-form-aligned' id='ghform' method='post' action="<?php $_PHP_SELF ?>">
<h6> Please Input Only One Record Per Day for Each Crop.
<?php
if (!$_SESSION['seed_order']) {
   echo ' <br> List all varieties of the seeded crop in the varieties window below. ';
}
?>
</h6>
<fieldset>
<div class='pure-control-group'>
<?php
if (isset($_POST['day']) && isset($_POST['month']) && isset($_POST['year'])) {
   $dDay = $_POST['day'];
   $dMonth = $_POST['month'];
   $dYear = $_POST['year'];
}
echo '<label for="Seed">Date of Seeding:</label>';
include $_SERVER['DOCUMENT_ROOT'].'/farmdata/date.php';
echo "</div>";
?>
<?php
$laborc = false;
$harvesting = false;
$transplanting = false;
// assumes onload not called from this file
include $_SERVER['DOCUMENT_ROOT'].'/farmdata/chooseCrop.php';
?>
<input type="hidden" name="numRows" id="numRows" value=0>

<script type="text/javascript">
var numRows = 0;

function update_seeds() {
   var tot = 0;
   for (var i = 1; i <= numRows; i++) {
      if (document.getElementById("row" + i) != null &&
          document.getElementById("row" + i).innerHTML != "") {
         tot += parseFloat(document.getElementById("seeds" + i).value);
      }
   }
   document.getElementById("num_seeds").value = tot;
}

function addRow() {
   var cb = document.getElementById("cropButton");
   if (cb.value=="0") {
      showError("Error: choose crop first!");
   } else {
      numRows++;
      var nr = document.getElementById("numRows");
      nr.value = numRows;
      var table = document.getElementById("ghTable").getElementsByTagName('tbody')[0];
      var row = table.insertRow(numRows - 1);
      row.id = "row"+numRows;
      row.name = "row"+numRows;
      var cell0 = row.insertCell(0);
      var crop = encodeURIComponent(cb.value);
      xmlhttp= new XMLHttpRequest();
      xmlhttp.open("GET", "get_code.php?crop="+crop, false);
      xmlhttp.send();
      if(xmlhttp.responseText=="\n") {
         cb.value="";
      }
      cell0.innerHTML="<div class='styled-select' id ='codediv" + numRows + "''>  <select name= 'code" +
         numRows + "' id= 'code" + numRows + "' class='mobile-select' style='width:100%'>" +
         xmlhttp.responseText+"</select> </div>";

      var cell1 = row.insertCell(1);
      cell1.innerHTML = "<input onkeypress= 'stopSubmitOnEnter(event);' type = 'text' name='seeds" + 
         numRows + "' id='seeds"+numRows+"' class='textbox mobile-input inside_table' style='width:100%' " 
         + "oninput='update_seeds();' value='0'>";
   }
}

function removeRow() {
   if (numRows > 0) {
      var row = document.getElementById("row" + numRows);
      row.innerHTML = "";
      numRows--;
      update_seeds();
   }
/*
   if (numRows == 0) {
      var cb = document.getElementById("cropButton");
      cb.disabled=false;
   }
*/
   var nr = document.getElementById("numRows");
   nr.value=numRows;
}

function clearTable() {
   while (numRows > 0) {
      removeRow();
   }
}

function addInput() {}
</script>

<div class='pure-control-group'>
<label for="numFlats">Number of flats:</label>
<input onkeypress= 'stopSubmitOnEnter(event)'; type = "text" name="numFlats" id="numFlats" class="textbox2 mobile-input">
</div>

<?php
if ($_SESSION['seed_order']) {
   echo '<br clear = "all"/>';
   echo '<table id="ghTable" class="pure-table pure-table-bordered" name="ghTable">';
   echo '<thead><tr><th>Seed&nbsp;Code</th><th>Seeds&nbsp;Planted</th></tr></thead>';
   echo '<tbody></tbody></table>';
   echo '<br clear = "all"/>';
   echo '<div class="pure-g">';
   echo '<div class="pure-u-1-2">';
   echo '<input type="button" id="addVariety" name="addVariety" class="genericbutton pure-button wide" onClick="addRow();"';
   echo ' value="Add Variety">';
   echo '</div>';
   echo '<div class="pure-u-1-2">';
   echo '<input type="button" id="removeVariety" name="removeVariety" class="genericbutton pure-button wide" ';
   echo 'onClick="removeRow();" value="Remove Variety">';
   echo '</div>';
   echo '</div>';
   echo '<p>';
}
echo "<div class='pure-control-group'>";
echo '<label for="numSeeds">';
if ($_SESSION['seed_order']) {
   echo 'Total ';
}
/*
echo 'Seeds Planted:</label> ';
echo '<input value=0 type="int" onkeypress="stopSubmitOnEnter(event);" name ="num_seeds" ';
if ($_SESSION['seed_order']) {
   echo ' readonly ';
}
echo ' class="textbox2 mobile-input" id="num_seeds" value="0">';
echo '</input></div>';
*/
if (!$_SESSION['seed_order']) {
   echo '<div class="pure-control-group">';
   echo '<label for="vars">Varieties:</label>';
   echo '<textarea  name="vars"rows="5" cols="30">';
   echo '</textarea>';
   echo '</div>';
   //echo '</div>';
}
echo '<p>';
include $_SERVER['DOCUMENT_ROOT'].'/farmdata/Seeding/getGen.php';
?>
<div class='pure-control-group'>
<label for="comments">Comments:</label>
<textarea  name="comments"rows="5" cols="30">
</textarea>
</div>
<br clear="all"/>
<script>
function show_confirm() {
   var crp = document.getElementById("cropButton").value;
   if(checkEmpty(crp) || crp == "Crop") {
      showError("Please Select a Crop");
      return false;
   }

   var con="Crop: "+ crp + "<br>";
   var mth = document.getElementById("month").value;        
   con += "Date of Seeding: " + mth + "-";
   var dy = document.getElementById("day").value;
   con += dy + "-";
   var yr = document.getElementById("year").value;
   con += yr + "<br>";
   var numF = document.getElementById("numFlats").value;
   if (checkEmpty(numF) || numF<=0 || !isFinite(numF)) {
      showError("Enter a valid number of trays!");
      return false;
   }
   
   var msg = "Confirm Entry:"+"<br>"+con;
console.log(msg);
   showConfirm(msg, 'ghform');
 }
</script>
</fieldset>
<div class="pure-g">
<div class="pure-u-1-2">
<input class="submitbutton pure-button wide" type="button" value="Submit" onclick= "show_confirm();">
</form>
</div>
</div>
<?php
//if(isset($_POST['submit'])) {
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   $crop = escapehtml($_POST['crop']);
   $comSanitized=escapehtml($_POST['comments']);
   $seedInfo = true;
   if ($_SESSION['seed_order']) {
      $sql = "select seedsGram, seedsRowFt from seedInfo where crop = '".$crop."'";
      $res = $dbcon->query($sql);
      if ($row = $res->fetch(PDO::FETCH_ASSOC)) {
         $seedsGram = $row['seedsGram'];
         $seedsRowFt = $row['seedsRowFt'];
      } else {
         $seedInfo = false;
      }
      $varsSanitized="";
      $numRows = $_POST['numRows'];
      $dec = "update seedInventory set inInventory = inInventory - :grams where crop = :crop and ".
             "code = :code";
      try {
      $stmt = $dbcon->prepare($dec);
      for ($i = 1; $i <= $numRows; $i++) {
         if (isset($_POST['code'.$i])) {
             $code = escapehtml($_POST['code'.$i]);
             $sds = $_POST['seeds'.$i];
             if ($varsSanitized != "") {
                $varsSanitized .= "<br>";
             }
             $var = "select variety from seedInventory where code ='".$code."' and crop = '".$crop."'";
             $vr = $dbcon->query($var);
             if ($vrow = $vr->fetch(PDO::FETCH_ASSOC)) {
                $variety = $vrow['variety'];
             } else {
                $variety = "No Variety";
             }
             $varsSanitized .="Seed Code: ".$code." (".$variety.") - ".$sds." seeds";
             if ($seedInfo && $code != "N/A") {
                $grams = $sds / $seedsGram;
                   $stmt->bindParam(':grams', $grams, PDO::PARAM_STR);
                   $stmt->bindParam(':crop', $crop, PDO::PARAM_STR);
                   $stmt->bindParam(':code', $code, PDO::PARAM_STR);
                   $stmt->execute();
             }
         }
      }
      } catch (PDOException $p) {
         phpAlert('Error updating seed inventory', $p);
         die();
      }
   } else {
      $varsSanitized=escapehtml($_POST['vars']);
   }
   include $_SERVER['DOCUMENT_ROOT'].'/farmdata/Seeding/setGen.php';
   $seeds = 0; //escapehtml($_POST['num_seeds']);
   $numFlats = escapehtml($_POST['numFlats']);
   $flatSize = 0; // escapehtml($_POST['flatSize']);
   $user = escapehtml($_SESSION['username']);
   $sql="INSERT INTO gh_seeding(username,crop,seedDate,numseeds_planted,flats,cellsFlat,varieties,gen,".
      " comments) VALUES ('".
      $user."','".$crop."','".$_POST['year']."-".$_POST['month']."-".
      $_POST['day']."',".$seeds.",".$numFlats.", ".$flatSize.", '".
      $varsSanitized."', ".$gen.", '".$comSanitized."')";
  try {
      $stmt = $dbcon->prepare($sql);
      $stmt->execute();
   } catch (PDOException $p) {
      phpAlert('Could not enter seeding data.  If this is a duplicate entry error, ask your FARMDATA '.
        'administrator to correct the record', $p);
      die();
   }
   echo "<script>showAlert(\"Entered data successfully!\");</script> \n";
//   }
   $stmt = null;
}
?>
