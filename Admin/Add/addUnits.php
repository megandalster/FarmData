<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'].'/farmdata/Admin/authAdmin.php';
include $_SERVER['DOCUMENT_ROOT'].'/farmdata/design.php';
include $_SERVER['DOCUMENT_ROOT'].'/farmdata/connection.php';
include $_SERVER['DOCUMENT_ROOT'].'/farmdata/stopSubmit.php';
?>
<body id="add">
<form name='form' class="pure-form pure-form-aligned" method='post' action='<?php $_SERVER['PHP_SELF']; ?>'>
<center>
<h2>Add Harvest Unit to Crop </h2>
</center>

<div class="pure-control-group">
<label for="crop">Crop:</label>
<select name="crop" id="crop" onChange="addInput(); addInput2();" class="mobile-select"> 
<?php
$result=$dbcon->query("Select crop from plant where active=1");
while ($row1 = $result->fetch(PDO::FETCH_ASSOC)){
  echo "\n<option value= \"$row1[crop]\">$row1[crop]</option>";
}
?>
</select>
</div>

<script type="text/javascript"> 
function updateNew() {
   var newUnit = document.getElementById("unit").value;
   var inp = document.getElementById('newunit');
   inp.value = newUnit;
}

function addInput2(){
   var newdiv = document.getElementById('units');
   var crop = encodeURIComponent(document.getElementById("crop").value);
   xmlhttp= new XMLHttpRequest();xmlhttp.open("GET", "unitsU.php?crop="+crop, false);
   xmlhttp.send();
   //console.log(xmlhttp.responseText);
   newdiv.innerHTML = '<div class="pure-control-group" id="units">' +
      '<label for="unit">New Unit:</label>  ' +
      '<select name="unit" id="unit" onchange="updateNew();">' +
      xmlhttp.responseText + '</select></div>';

   var newUnit = document.getElementById("unit").value;
   var inp = document.getElementById('newunit');
   inp.value = newUnit;
}

function addInput(){
   var newdiv = document.getElementById('default');
   var crop = encodeURIComponent(document.getElementById("crop").value);
   xmlhttp= new XMLHttpRequest();xmlhttp.open("GET", "addUpdate.php?crop="+crop, false);
   xmlhttp.send();
   newdiv.innerHTML = '<div class="pure-control-group" id="default">' +
      '<label for="Conversion"> Default Unit:</label> ' +
      '<input readonly type="text" name="default_unit" id="default_unit" ' +
      'value="' + xmlhttp.responseText + '"> </div> ';

   var inp = document.getElementById('default2');

   inp.innerHTML = 
      '<div class="pure-control-group" id="default2">' +
      '<label for="default">Conversion Factor from New Unit:</label> ' +
      'One&nbsp; ' +
      '<input class="textbox3 mobile-input" size = "12" type="textbox" readonly name="defaultunit" id="defaultunit" value="' + 
      xmlhttp.responseText + '">' + 
      '&nbsp;equals&nbsp;' +
      '<input type="textbox" size="5" name="conversion" id="conversion">' +
      '&nbsp; ' +
      '<input size="12" type="textbox" readonly name="newunit" id="newunit">' +
      '(S) </div>';

}
</script>

<div class="pure-control-group" id="default">
<label for="Conversion"> Default Unit:</label> 
<input readonly type="text" name="default_unit" id="default_unit">
</div> 

<div class="pure-control-group" id="units">
<label for="unit">New Unit:</label> 
<select name="unit" id="unit" class="mobile-select">
<option disabled value=0 selected>Unit </option>
</select>
</div>


<div class="pure-control-group" id="default2">
<label for="default">Conversion Factor from New Unit:</label>
One&nbsp;
<input class="textbox3 mobile-input" size = "12" type="textbox" readonly name="defaultunit" id="defaultunit">
&nbsp;equals&nbsp;
<input type="textbox" size="5" name="conversion" id="conversion">
&nbsp;
<input size="12" type="textbox" readonly name="newunit" id="newunit">
(S)
</div>
<br clear="all"/>
<script>
function show_confirm() {
   var cp = document.getElementById("crop").value;
   if (checkEmpty(cp)) {
      alert("Choose a crop!");
      return false;
   }
   var con="Crop: "+ cp + "\n";
   var nu = document.getElementById("unit").value;
   if (checkEmpty(nu)) {
      alert("Choose a new unit!");
      return false;
   }
   con += "New Unit: "+ nu + "\n";
   var conv = document.getElementById("conversion").value;
   if (checkEmpty(conv) || !isFinite(conv)) {
      alert("Enter a conversion factor!");
      return false;
   }
   con += "Conversion Factor: "+ conv + "\n";

   return confirm("Confirm Entry:"+"\n"+con);
}
</script>
<div class="pure-g">
<div class="pure-u-1-2">
<input class="submitbutton pure-button wide" type="submit" name="add" id="submit" value="Add"
  onclick = "return show_confirm();">
</form>
</div>
<div class="pure-u-1-2">
<form method="POST" action = "viewUnits.php?tab=admin:admin_add:admin_addcrop:addunitconv"><input type="submit" class="submitbutton pure-button wide" value = "View Units Table"></form>
</div>

<?php
if (isset($_POST['add'])) {
   $conversion = escapehtml($_POST['conversion']);
   $unit = escapehtml($_POST['unit']);
   $crop = escapehtml($_POST['crop']);
   $default_unit = escapehtml($_POST['default_unit']);
   if ($conversion > 0 && !empty($unit) && !empty($conversion)) {
      $sql="Insert into units(crop,default_unit,unit,conversion) values ('".$crop."','".$default_unit.
         "','".$unit."','".$conversion."')";
      try {
         $stmt = $dbcon->prepare($sql);
         $stmt->execute();
      } catch (PDOException $p) {
         phpAlert('', $p);
         die();
      }
      echo "<script>showAlert(\"Entered data successfully!\");</script> \n";
   } else {
      echo    "<script>alert(\"Enter all data!\\n\");</script> \n";
   }
}
?>

