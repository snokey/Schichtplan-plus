

<html>

<head>
  <meta http-equiv="content-type" content="text/html;charset=utf-8">
  <link rel="stylesheet" type="text/css" href="calendar.css">
</head>

<body>

<?php
include 'calender.php';
$calendar = new Calendar();
 
echo $calendar->show();
?>

</body>

</html>