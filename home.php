<?php session_start(); ?>
<?php
include $_SERVER['DOCUMENT_ROOT'].'/farmdata/connection.php';
include $_SERVER['DOCUMENT_ROOT'].'/farmdata/authentication.php';
include $_SERVER['DOCUMENT_ROOT'].'/farmdata/setconfig.php';
// include $_SERVER['DOCUMENT_ROOT'].'/farmdata/navigation.php';
include $_SERVER['DOCUMENT_ROOT'].'/farmdata/design.php';
include $_SERVER['DOCUMENT_ROOT'].'/farmdata/footer.php';
?>
<center>
<?php 
if (!$_SESSION['mobile']) {
   echo '<p>';
   echo '<h1> Welcome to the College Farm! <br clear="all"/> Select One of the Tabs Above. </h1>';
} else {
   echo '<br clear="all"/>';
   echo '<p>';
   echo '<font size=4> Welcome to the College Farm! <br clear="all"/> Select One of the Tabs Above. </font>';
}
?>
<p>
<?php
if ($_SESSION['mobile']) {
   //echo "<img src='farmdata.png' style='padding-top:20px;' width='100%'>";
   echo "<img src='farmdata.png' width='30%'>";
} else { 
   echo "<img src='farmdata.png' width='25%'>"; 
}
?>
<!--
<?php if (!$_SESSION['mobile']) echo "<img src='FOTS.jpg'>"; ?>
-->
</center>
</body>
