<?php session_start(); ?>
<?php
include $_SERVER['DOCUMENT_ROOT'].'/farmdata/connection.php';
include $_SERVER['DOCUMENT_ROOT'].'/farmdata/authentication.php';
if (!isset($_POST['submit'])) {
  include $_SERVER['DOCUMENT_ROOT'].'/farmdata/design.php';
}

echo "<form name='comment' method='POST' action='addComment.php?year=".
   $_GET['year']."&month=".$_GET['month']."&day=".$_GET['day']."&currentID=".
   $_GET['currentID']."&detail=0'>";
?>

<center>
<h2>Add Comment to Harvest List:</h2>
</center>
<br clear = "all"/>
<textarea  name="comments" rows="20" cols="50" >
</textarea>
<br clear = "all"/>
<br clear = "all"/>
<div class="pure-g">
<div class="pure-u-1"">
<input type='submit' name='submit' value='Update Comments' class='submitbutton pure-button wide' >
</div></div>
<?php
if(isset($_POST['submit'])){
   $comSanitized=escapehtml($_POST['comments']);
   $user=escapehtml($_SESSION['username']);
   $sql="UPDATE harvestList SET comment = concat(comment,'\n".$user.
      " posted: ".$comSanitized."') where id=".$_GET['currentID'];
   try {
      $result = $dbcon->prepare($sql);
      $result->execute();
   } catch (PDOException $p) {
      die($p->getMessage());
   }

   $url = "Location: harvestList.php?tab=harvest:harvestList&year=".$_GET['year']."&month=".$_GET['month'].
      "&day=".$_GET['day']."&currentID=".$_GET['currentID']."&detail=0'";
   header($url);
}

?>
</form>
