<?php session_start();?>
<?php
include $_SERVER['DOCUMENT_ROOT'].'/farmdata/Admin/authAdmin.php';
include $_SERVER['DOCUMENT_ROOT'].'/farmdata/connection.php';
include $_SERVER['DOCUMENT_ROOT'].'/farmdata/design.php';

   echo "<center><h2> Edit/Delete Compost Pile </h2></center>";
   $sqlget = "SELECT pileID, comments, active FROM compost_pile";
   $sqldata = $dbcon->query($sqlget);
   echo "<table class='pure-table pure-table-bordered'>";
   echo "<thead><tr><th>Pile ID</th><th>Comments</th><th>Active</th>".
   "<th>Edit</th></tr></thead>";
   while($row = $sqldata->fetch(PDO::FETCH_ASSOC)) {
      echo "<tr><td>";
      echo $row['pileID'];
      echo "</td><td>";
      echo $row['comments'];
      echo "</td><td>";
      if ($row['active'] == 1) {
         echo "Yes";
      } else {
         echo "No";
      }
      echo "</td>";
      
      echo "<td><form method=\"POST\" action=\"compostPileEdit.php?&pileID=".
         encodeURIComponent($row['pileID']).
        "&tab=admin:admin_delete:deleteother:deletecompostpile&submit=Submit\">";
      echo "<input type=\"submit\" class=\"editbutton pure-button wide\" value=\"Edit\"></form> </td>";
      
      echo "</tr>";
   }
   echo "</table>";
?>
