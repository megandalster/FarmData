<?php session_start(); ?>
<form name='form' class='pure-form pure-form-aligned' id='test'  method='POST' action="<?php echo $_SERVER['PHP_SELF'];?>?tab=soil:soil_fert:soil_till:till_input" >
<?php
include $_SERVER['DOCUMENT_ROOT'].'/farmdata/authentication.php';
include $_SERVER['DOCUMENT_ROOT'].'/farmdata/design.php';
include $_SERVER['DOCUMENT_ROOT'].'/farmdata/connection.php';
?>
<center>
<h2> Input Tillage Record</h2>
</center>
<div class="pure-control-group">
<label for='date'>Date: </label>
<?php
include $_SERVER['DOCUMENT_ROOT'].'/farmdata/date.php';
?>
</div>
<input type="hidden" name="hid" id="hid">
<script>
function show_confirm() {
   var hid = document.getElementById("hid");
   hid.value=numRows;
   var i = document.getElementById("month");
   var strUser3 = i.options[i.selectedIndex].text;
   var con="Tillage Date: "+strUser3+"-";
   var i = document.getElementById("day");
   var strUser3 = i.options[i.selectedIndex].text;
   con=con+strUser3+"-";
   var i = document.getElementById("year");
   var strUser3 = i.options[i.selectedIndex].text;
   con=con+strUser3+"\n";
   var i = document.getElementById("tractor");
   if(checkEmpty(i.value)) {
        alert("Please Enter tractor");
        return false;
   }
   strUser3 = i.options[i.selectedIndex].text;
   con=con + "Tractor: "+ strUser3+ "\n";
   var i = document.getElementById("implement");
   if(checkEmpty(i.value)) {
        alert("Please Enter implement");
        return false;
   }
   strUser3 = i.options[i.selectedIndex].text;
   con=con+"Implement: "+ strUser3+ "\n";

   var allfields = [];
   for (flds = 1; flds <= numRows; flds++) {
      var fld = document.getElementById("fieldID"+flds).value;
      if(checkEmpty(fld)) {
         alert("Please Enter Field in Row: " + flds);
         return false;
      }
      allfields[flds - 1] = fld;
      con=con+"\nFieldID: "+ fld + "\n";
      var perc = document.getElementById("perc"+flds).value;
      con=con+"Percent of Field Tilled: "+ perc + "\n";
      var pass = document.getElementById("passes"+flds).value;
      if(checkEmpty(pass)) {
         alert("Please Enter Passes in Row: " + flds);
         return false;
      }
      con=con+"Number of Passes: "+ pass + "\n";
      var mins = document.getElementById("minutes"+flds).value;
      if(checkEmpty(mins)) {
         alert("Please Enter Minutes in Row: " + flds);
         return false;
      }

      con=con+"Minutes in Field: "+ mins + "\n";
   }
   allfields.sort();
   for (i = 0; i < allfields.length - 1; i++) {
       if (allfields[i] == allfields[i + 1]) {
          alert("Error: same field entered twice!");
          return false;
       }
   }

   return confirm("Confirm Entry:"+"\n"+con);
}
</script>
<div class="pure-control-group">
<label for="tractor"> Tractor: </label>
<select name ="tractor" id="tractor" class="mobile-select">
<option value = 0 selected disabled> Tractor</option>
<?php 
$result = $dbcon->query("Select tractorName from tractor where active = 1");
while ($row1 =  $result->fetch(PDO::FETCH_ASSOC)){  
echo "\n<option value= \"$row1[tractorName]\">$row1[tractorName]</option>";
}
echo '</select>';
echo '</div>';
?>

<div class="pure-control-group">
<label for="implement"> Implement: </label>
<select name ="implement" id="implement" class="mobile-select">
<option value = 0 selected disabled> Implement </option>

<?php 
$result = $dbcon->query("Select tool_name from tools");
while ($row1 =  $result->fetch(PDO::FETCH_ASSOC)){  
echo "\n<option value= \"$row1[tool_name]\">$row1[tool_name]</option>";
}
echo '</select>';
echo '</div>';
?>

<br clear="all"/>
<br clear="all"/>
<table name="fieldTable" id="fieldTable" class="pure-table pure-table-bordered">
<thead><tr><th>FieldID</th><th>Number of Passes</th><th>% of Field Tilled</th><th>Minutes in Field</th><th> Comments?</th></tr></thead>
<tbody></tbody>
</table>
<script type="text/javascript">
var numRows = 0;
function addRow() {
   numRows++;
    var table = document.getElementById("fieldTable").getElementsByTagName('tbody')[0];
    var row = table.insertRow(-1);

   row.id = "row"+numRows;
   row.name = "row"+numRows;
   var cell0 = row.insertCell(0);
   cell0.innerHTML = '<div class="styled-select" id="fieldDiv'+numRows+'"> <select name ="fieldID' + numRows +
     '" id="fieldID' + numRows + '" class="wide">' +
     '<option value = 0 selected disabled> FieldID</option>' +
     '<?php 
     $result = $dbcon->query("Select fieldID from field_GH where active=1 order by sortOrder");
     while ($row1 =  $result->fetch(PDO::FETCH_ASSOC)){  
     echo "<option value = \"".$row1[fieldID]."\">".$row1[fieldID]."</option>";
     }
     ?>'
      + '</select></div>';
   var cell1 = row.insertCell(1);
   cell1.innerHTML = ' <div class="styled-select" id="passesDiv' + numRows + '"> <select name ="passes' +
     numRows + '" id="passes' + numRows + '" class="wide">' +
     '<option value = 0 selected disabled> Passes </option>' +
     '<?php
         $cons=5;
         while ($cons>0) {
            echo "<option value =\"$cons\">$cons</option>";
            $cons--;
         }
      ?>' + 
     '</select></div>';
   var cell2 = row.insertCell(2);
   cell2.innerHTML = '<div class="styled-select" id="percDiv' + numRows + '"> <select name ="perc' + numRows +
     '" id="perc' + numRows+'" class="wide">' +
     '<?php
         $result= 10;
         while ($result <= 100) {
         echo "<option value= \"$result\">$result%</option>";
            $result= $result + 10;
         }
      ?>' +
      '</select></div>';
   var cell3 = row.insertCell(3);
   cell3.innerHTML=' <div class="styled-select" id="minutesDiv'+numRows+'"> <select name ="minutes'+numRows +
     '" id="minutes'+numRows+'" class="wide">' +
     '<option value = 0 disabled selected > Minutes </option>' +
     '<?php
        $cons=1;
        while ($cons<=300) {
           echo "<option value =\"$cons\">$cons</option>";
           $cons= $cons+ 1;
        }
      ?>' +
      '</select></div>';
   var cell4 = row.insertCell(4);
   cell4.innerHTML='<center><div id="comDiv'+numRows + '"><input type="checkbox" id = "com'+numRows+
       '" name = "com'+numRows+'"/ class="pure-checkbox"></div></center>';

}
addRow();
function removeRow() {
   if (numRows > 0) {
      var field=document.getElementById('fieldID' + numRows);
      field.parentNode.removeChild(field);
      var passes=document.getElementById('passes' + numRows);
      passes.parentNode.removeChild(passes);
      var perc=document.getElementById('perc' + numRows);
      perc.parentNode.removeChild(perc);
      var minutes=document.getElementById('minutes' + numRows);
      minutes.parentNode.removeChild(minutes);
      var com=document.getElementById('com' + numRows);
      com.parentNode.removeChild(com);
      var table = document.getElementById("fieldTable");
      table.deleteRow(numRows);
      numRows--;
   }
}
</script>
<br clear="all"/>
<div class="pure-g">
<div class="pure-u-1-2">
<input type="button" id="addField" name="addField" class="genericbutton pure-button wide" onClick="addRow();" 
    value="Add Field">
</div>
<div class="pure-u-1-2">
<input type="button" id="removeField" name="removeField" class="genericbutton pure-button wide" onClick="removeRow();"
    value="Remove Field">
</div>
</div>
<br clear="all"/>
<br clear="all"/>
<div class="pure-control-group">
<label for="comments">Comments:</label>
<textarea name ="comments"
rows="5" cols="30">
</textarea>
</div>
<br clear="all"/>
<br clear="all"/>
<div class="pure-g">
<div class="pure-u-1-2">
<input type="submit" class="submitbutton pure-button wide" name="submit" value="Submit" onclick= "return show_confirm();">
</form>
</div>
<div class="pure-u-1-2">
<form method="POST" action = "tillageReport.php?tab=soil:soil_fert:soil_till:till_report"><input type="submit" class="submitbutton pure-button wide" value = "View Table" onclick="return confirmLeave();"></form>
</div>
</div>
<?php
if(!empty($_POST['submit'])) {
   $numRows = $_POST['hid'];
   $comSanitized=escapehtml($_POST['comments']);
   $tractor=escapehtml($_POST['tractor']);
   $implement=escapehtml($_POST['implement']);
   $sql = "Insert into tillage(tractorName, fieldID,tilldate, tool,num_passes,comment,minutes,".
      " percent_filled) values('".
      $tractor."', :fieldID, '".$_POST['year']."-".$_POST['month']."-".
      $_POST['day']."','".$implement."', :passes, :com, :minutes, :percent);";
   try {
      $stmt = $dbcon->prepare($sql);
      for ($i = 1; $i <= $numRows; $i++) {
         $com = $comSanitized;
         if (empty($_POST['com'.$i])) {
            $com = '';
         }
         $fieldID=escapehtml($_POST['fieldID'.$i]);
         $passes=escapehtml($_POST['passes'.$i]);
         $minutes=escapehtml($_POST['minutes'.$i]);
         $percent=escapehtml($_POST['perc'.$i]);
         $stmt->bindParam(':fieldID', $fieldID, PDO::PARAM_STR);
         $stmt->bindParam(':passes', $passes, PDO::PARAM_INT);
         $stmt->bindParam(':minutes', $minutes, PDO::PARAM_INT);
         $stmt->bindParam(':percent', $percent, PDO::PARAM_INT);
         $stmt->bindParam(':com', $com, PDO::PARAM_STR);
         $stmt->execute();
      /*
            $sql = "Insert into tillage(tractorName, fieldID,tilldate, tool,num_passes,comment,minutes,percent_filled) values('".
            $tractor."','".$fieldID."','".$_POST['year']."-".$_POST['month']."-".
         $_POST['day']."','".$implement."',".$passes.",'".$com."',".
         $minutes.",".$percent.");";
*/
      }
   } catch (PDOException $p) {
      phpAlert('', $p);
      die();
   }
   echo "<script>showAlert(\"Entered data successfully!\");</script> \n";
}
?>
