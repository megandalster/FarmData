<?php
/*
if($_SERVER["HTTPS"] != "on") {
   header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
   exit();
}
*/
// server should keep session data for AT LEAST 8 hours
ini_set('session.gc_maxlifetime', 28800);
// each client should remember their session id for EXACTLY 8 hours
session_set_cookie_params(28800);
session_start(); // ready to go!

include $_SERVER['DOCUMENT_ROOT'].'/farmdata/utilities.php';
$useragent=$_SERVER['HTTP_USER_AGENT'];
$_SESSION['mobile'] = isMobile($useragent);
// $_SESSION['mobile'] = 1;
if($_SESSION['mobile']) {
  echo '<link type="text/css" href="/farmdata/mobileDesign2.css" rel = "stylesheet">';
}else {
  echo '<link type="text/css" href="/farmdata/design.css" rel = "stylesheet">';
}
echo '<link type="text/css" href="/farmdata/tabs.css" rel = "stylesheet">';
?>
<link href="/farmdata/apple-touch-icon.png" rel="apple-touch-icon" />
<link href="/farmdata/apple-touch-icon-76x76.png" rel="apple-touch-icon" sizes="76x76" />
<link href="/farmdata/apple-touch-icon-120x120.png" rel="apple-touch-icon" sizes="120x120" />
<link href="/farmdata/apple-touch-icon-152x152.png" rel="apple-touch-icon" sizes="152x152" />
<link href="/farmdata/apple-touch-icon-180x180.png" rel="apple-touch-icon" sizes="180x180" />
<link href="/farmdata/icon-hires.png" rel="icon" sizes="192x192" />
<body>
<h1>FARMDATA Login</h1> <br>
<form name='form' id='test'  method='POST' action="validate.php">
<label for="username"><b>Username:&nbsp;</b></label>
<input type="text" class = "textbox3" name="username" id="username">
<br clear="all">
<label for="pass"><b>Password:&nbsp;</b></label>
<input type="password" class = "textbox3" name="pass" id="pass">
<br clear="all">
<p>
<input class = "submitbutton" type="submit" value = "Submit">
<script type="text/javascript">
  var u = document.getElementById("username");
  u.focus();
</script>
</form>

<p>

</body>

