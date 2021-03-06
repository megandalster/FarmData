<?php session_start(); ?>
<?php
   include $_SERVER['DOCUMENT_ROOT'].'/farmdata/Admin/authAdmin.php';
   include_once $_SERVER['DOCUMENT_ROOT'].'/farmdata/connection.php';
   include $_SERVER['DOCUMENT_ROOT'].'/farmdata/design.php';
?>
<head>
   <!--Load the AJAX API-->
   <script type="text/javascript" src="https://www.google.com/jsapi"></script>
</head>

<body>
   <?php
      // take the parameters from the link
      $year = $_GET['year'];
      $month= $_GET['month'];
      $day = $_GET['day'];
      $tyear = $_GET['tyear'];
      $tmonth= $_GET['tmonth'];
      $tday = $_GET['tday'];
      $crop = escapehtml($_GET['crop']);
      // find all the fields that are harvested with this particular crop and date range
      $sql = "select distinct fieldID from harvested, plant where harvested.crop = plant.crop and ".
         " harvested.unit = plant.units and harvested.crop='".$crop."' and hardate between '".
         $year."-".$month."-".$day."' and '".$tyear."-".$tmonth."-".$tday."' order by fieldID";
      $sqldata = $dbcon->query($sql);
      $header = array("date");
      $count = 1;
      while($row = $sqldata->fetch(PDO::FETCH_ASSOC)){
         $header[$count] = $row['fieldID'];
         $count++;
      }
      // find all the date which a particular crop is harvested.
      $sql = "select distinct hardate from harvested, plant where harvested.crop = plant.crop and ".
         " harvested.unit = plant.units and harvested.crop='".$crop."' and hardate between '".
         $year."-".$month."-".$day."' and '".$tyear."-".$tmonth."-".$tday."' order by hardate";
      $sqldata = $dbcon->query($sql);      
      $dateArray = array();      
      $count = 0;
      while($row = $sqldata->fetch(PDO::FETCH_ASSOC)){
         $dateArray[$count] = $row['hardate'];
         $count++;
      }
      // build the 2d array of data for the graph      
      $array = array();
      for ($count = 0; $count < count($header); $count++) {
         $array[0][$count] = escapeescapehtml($header[$count]);
      }
      // $array[0] = $header; // set header for the table
      echo '<center><h2>Quantity harvested in each field of '.$crop.' between '.$year.'-'.$month.'-'.$day.' and '.$tyear.'-'.$tmonth.'-'.$tday.'</h2></center>';
      $count = 0;
      for ($count; $count < count($dateArray); $count++){
         $sql= "select fieldID, sum(yield) from harvested, plant where harvested.crop = plant.crop and ".
            " harvested.unit = plant.units and harvested.crop='".$crop."' and hardate='".
            $dateArray[$count]."' group by fieldID";
         $sqldata = $dbcon->query($sql);
         $rowdata[0] = substr($dateArray[$count], 2, 2).'/'.substr($dateArray[$count], 5,2).'/'.substr($dateArray[$count],8,2);
         $fill0 = 1;
         for ($fill0; $fill0 <= count($header)-1;$fill0++){
            $rowdata[$fill0] = 0;
         }
         //$rowdata[0] = $dateArray[$count];
         while($row = $sqldata->fetch(PDO::FETCH_ASSOC)){
            $countCheck = 1;
            for ($countCheck; $countCheck <= count($header)-1;$countCheck++){
               if ($row['fieldID']==$header[$countCheck]){
                  $rowdata[$countCheck] = intval($row['sum(yield)']);
               }
            }
         }
         $array[$count+1] = $rowdata;
      }   
//print_r($array);
      // find the unit of the chart
      $sql = $dbcon->query("select units from plant where crop='".$crop."'");
      $row = $sql->fetch(PDO::FETCH_ASSOC);
      echo"<input type='hidden' id='unit' value='".$row['units']."'/>";
      $json = json_encode($array);
   ?>
   <script type="text/javascript">
   // Load the visualization API and the chart package
   google.load('visualization', '1.0', {'packages':['corechart']});
   // Set a callback to run when the google visualization API is loaded.
   google.setOnLoadCallback(drawChart);
   // callback that creates and populates a data table, instantiates the chart, passes in the data and draws it.
function drawChart() {
   if (<?php echo count($array); ?> == 1) {
     var body = document.getElementById('chart_div');
     body.innerHTML = "There is not enough data to display. Please select a wider date range.";
   }
   else {
      // Create the data table.
      var data2 = eval(<?php echo $json;?>);
      console.log(data2);
      var data = new google.visualization.arrayToDataTable(data2);
      // Set chart options
      var options = {'title':'Quantity Harvested in each Field',
                     'hAxis':{title:'Date', titleTextStyle:{color: 'red'}},
                     'vAxis':{title:document.getElementById('unit').value},
                     'isStacked': 'true',
                     'width':1440,
                     'height':800
                     };
   
      // Instantiate and draw our chart, passing in some options.
      var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
      chart.draw(data, options);
   }
}
 
   </script>
   <!--Div that will hold the pie chart-->
  <center><div id="chart_div"></div></center>
</body>
</html>
