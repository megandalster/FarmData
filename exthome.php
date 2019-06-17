<?php

include '/Applications/MAMP/htdocs/farmdata/connection.php';
include '/Applications/MAMP/htdocs/farmdata/setconfig.php';
include '/Applications/MAMP/htdocs/farmdata/design.php';
include '/Applications/MAMP/htdocs/farmdata/authentication.php';

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


