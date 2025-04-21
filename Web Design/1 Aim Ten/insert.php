<html>
<head>
<title></title>
</head>

<body>

<?php
$con = mysql_connect("50.63.226.129
","tennisplaya0687","Fe98Bd87Ln8");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }mysql_select_db("tennisplaya0687", $con);$sql="INSERT INTO guestbook (date, name, message)
VALUES
('$_POST[date]','$_POST[name]','$_POST[message]')";if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }
echo "Thankyou! Your message has been added to the Guestbook.";
mysql_close($con)
?>

</body>
</html>