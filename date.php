<?php
// if ($_SESSION['mobile']) echo "<br clear='all'/>";
?>
<!--
<div  class= "styled-select">
-->
<select name="month" id = "month" class="mobile-month-select">
<?php
if (!$dMonth) {
   $curMonth = strftime("%m");
} else {
   $curMonth = $dMonth;
}
//echo '<option value='.$curMonth.' selected>'.date("F", mktime(0,0,0, strftime("%m"),10)).' </option>';
echo '<option value='.$curMonth.' selected>'.date("F", mktime(0,0,0, $curMonth,10)).' </option>';
for($month = $curMonth - $curMonth+1; $month < 13; $month++) {
        echo "\n<option value =\"$month\">".date("F", mktime(0, 0, 0, $month, 10))."</option>";

}
?>
</select>

<select name="day" id="day" class="mobile-day-select">
<?php
if (!$dDay) {
   $curDay = strftime("%e");
} else {
   $curDay = $dDay;
}
echo '<option value='.$curDay.' selected>'.$curDay.' </option>';
for($day = $curDay - $curDay+1; $day < 32; $day++) {
        echo "\n<option value =\"$day\">$day</option>";
}
?>
</select>

<select name="year" id="year" class="mobile-year-select" onChange="addFieldID()">
<?php
if (!$dYear) {
   $curYear = strftime("%Y");
} else {
   $curYear = $dYear;
}
echo '<option value='.$curYear.' selected>'.$curYear.'</option>';
for($year = $curYear - 7; $year < $curYear+2; $year++) {
        echo "\n<option value =\"$year\">$year</option>";
}
?>
</select>
<!--
</div>
-->
