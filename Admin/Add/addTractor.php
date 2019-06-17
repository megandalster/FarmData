<?php session_start(); ?>
<?php
include '/Applications/MAMP/htdocs/farmdata/Admin/authAdmin.php';
include '/Applications/MAMP/htdocs/farmdata/design.php';
include '/Applications/MAMP/htdocs/farmdata/connection.php';
include '/Applications/MAMP/htdocs/farmdata/stopSubmit.php';
?>
<form name="form" class="pure-form pure-form-aligned" method="post" action="<?php $_PHP_SELF ?>">
<center>
<h2>Add New Tractor</h2>
</center>

<div class="pure-control-group">
<label for="covercrop"> Tractor Name:</label>
<input class="textbox3 mobile-input" onkeypress= 'stopSubmitOnEnter(event)'; type="text" name="name" id="name">
</div>
<br clear="all"/>

<script>
function show_confirm() {
   var i = document.getElementById("name").value;
   if (checkEmpty(i)) {
      alert("Enter Tractor Name");
      return false;
   }
   var con="Tractor Name: "+ i+ "\n";
   return confirm("Confirm Entry: " +"\n"+con);
}
</script>
<input onclick= "return show_confirm()";  class="submitbutton pure-button wide" type="submit" name="done" value="Add">
<?php
$active = 1;
if (!empty($_POST['done'])) {
   if(!empty($_POST['name'])) {
      $name = escapehtml(strtoupper($_POST['name']));
      $sql="Insert into tractor(tractorName,active) values ('".$name."','".$active.
         "') on duplicate key update active=1";
      try {
         $stmt = $dbcon->query($sql);
         $stmt->execute();
      } catch (PDOException $p) {
         phpAlert('', $p);
         die();
      }
      echo "<script>showAlert(\"Added Tractor Successfully!\");</script> \n";
   } else {
      echo "<script>alert(\"Enter all data!\\n\");</script> \n";
   }
}
?>

