<?php session_start(); ?>
<?php
include $_SERVER['DOCUMENT_ROOT'].'/farmdata/Admin/authAdmin.php';
include $_SERVER['DOCUMENT_ROOT'].'/farmdata/design.php';
include $_SERVER['DOCUMENT_ROOT'].'/farmdata/connection.php';
include $_SERVER['DOCUMENT_ROOT'].'/farmdata/stopSubmit.php';
$farm=$_SESSION['db'];
$date = date('Y-m-d-H-i-s');
$file=$farm."-".$date.".sql";
?>
<form name="form" method="post" action="<?php $_PHP_SELF ?>">
<h2>Database Backup</h2>
<input type="hidden" name="filename" value="<?php echo $file;?>">

Pressing the button below will back up your database in file:
<br clear="all"/>
<?php echo $file;?>
<br clear="all"/>
which can be accessed via Admin->View->Files.
It is a good idea to download this file and store it in a safe location.
<br clear="all"/>
<br clear="all"/>
Restoring a database from a backup file requires system administrator 
privileges.  Please contact your system administrator if such a restoration
is needed.
<br clear="all"/>
<br clear="all"/>
<input class="submitbutton pure-button wide" type="submit" name="done" value="Backup Database">
</form>
<?php
if (!empty($_POST['done'])) {
  $user = $_SESSION['dbuser'];
  $pass = $_SESSION['dbpass'];
  $file = 'files/'.$farm.'/'.$_POST['filename'];
  $command = "mysqldump -u ".$user." -p ".$pass." ".$farm." > ".$file." 2>&1";

  exec($command, $out, $err);
  if ($err == 0) {
      echo "<script>alert(\"Database Backup Successful!\");</script>\n";
  } else {
      $msg=str_replace("\n", "", file_get_contents($file));
      $msg .= "command = ". $command;
      echo "<script>alert(\"Error in Database Backup!\\n".
        "Please contact Allen Tucker if you need a backup"."\");</script>\n";
      exec("rm ".$file);
  }
}
?>

