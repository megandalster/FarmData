<?php

include $_SERVER['DOCUMENT_ROOT'].'/farmdata/connection.php';
include $_SERVER['DOCUMENT_ROOT'].'/farmdata/setconfig.php';
include $_SERVER['DOCUMENT_ROOT'].'/farmdata/design.php';
include $_SERVER['DOCUMENT_ROOT'].'/farmdata/authentication.php';

echo '<center>';
if ($_SESSION['mobile']) {
   echo '<br clear="all"/>';
   echo '<P>';
}
?>
<h1> Welcome to FARMDATA Version 1.6! <br> Click one of the tabs to begin. </h1>
<br clear="all"/>
<img src='farmdata.png'>
</center>
</body>


