<?php 
include $_SERVER['DOCUMENT_ROOT'].'/farmdata/escapehtml.php';
$user = escapehtml($_GET['user']);
try {
   $dbcon = new PDO('mysql:host=localhost;dbname=farmusersdb', 'farmusersdb', 'foodyWr1');
   $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $d) {
   die($d->getMessage());
}
$sql="select admin, active from users where username='".$user."'";
$result = $dbcon->query($sql);

$info = array();
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
   $info['admin'] = $row['admin'];
   $info['active'] = $row['active'];
}
echo json_encode($info); 
?>

